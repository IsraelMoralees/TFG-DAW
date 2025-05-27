<?php
namespace App\Http\Controllers;

use App\Models\Videojuego;
use App\Models\Key;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session as CartSession;

class PurchaseController extends Controller
{
    // …

    /**
     * Checkout de todo el carrito.
     */
    public function checkoutCart(Request $request)
{
    Stripe::setApiKey(config('services.stripe.secret'));

    // Recupera el carrito: [videojuego_id => cantidad, ...]
    $cart = CartSession::get('cart', []);
    if (empty($cart)) {
        return redirect()->route('cart.index')
                         ->with('error', 'Tu carrito está vacío.');
    }

    $lineItems    = [];
    $metadataKeys = []; // inicializamos el array

    foreach ($cart as $videojuegoId => $qty) {
        $juego = Videojuego::findOrFail($videojuegoId);

        for ($i = 0; $i < $qty; $i++) {
            // 1) sacamos la key libre
            $key = Key::where('videojuego_id', $videojuegoId)
                      ->where('sold', false)
                      ->firstOrFail();

            // 2) marcamos YA como vendida (reservamos)
            $key->sold = true;
            $key->save();

            // 3) la metemos en metadata
            $metadataKeys[] = $key->id;

            // 4) añadimos la línea a Stripe
            $lineItems[] = [
                'price_data' => [
                    'currency'     => 'eur',
                    'unit_amount'  => intval($juego->precio * 100),
                    'product_data' => ['name' => $juego->titulo],
                ],
                'quantity' => 1,
            ];
        }
    }

    // Creamos la sesión de Stripe con todas las keys reservadas
    $session = Session::create([
        'payment_method_types' => ['card'],
        'line_items'           => $lineItems,
        'mode'                 => 'payment',
        'metadata'             => [
            'key_ids' => implode(',', $metadataKeys),
        ],
        'success_url'          => route('purchase.cart.success')
                                   . '?session_id={CHECKOUT_SESSION_ID}',
        'cancel_url'           => route('cart.cancel'),
    ]);

    return redirect($session->url);
}


    /**
     * Callback de éxito para el carrito completo.
     */
    public function cartSuccess(Request $request)
    {
        Stripe::setApiKey(config('services.stripe.secret'));
        $session = Session::retrieve($request->query('session_id'));

        if ($session->payment_status !== 'paid') {
            abort(403, 'Pago no confirmado.');
        }

        // 3) Recuperamos todas las claves vendidas
        $keyIds = explode(',', $session->metadata->key_ids);

        foreach ($keyIds as $keyId) {
            $key = Key::findOrFail($keyId);

            if (! $key->sold) {
                $key->sold = true;
                $key->save();

                Purchase::create([
                    'user_id'       => Auth::id(),
                    'videojuego_id' => $key->videojuego_id,
                    'key_id'        => $key->id,
                    'purchased_at'  => now(),
                ]);
            }
        }

        // 4) Vaciamos carrito
        CartSession::forget('cart');

        return redirect()
            ->route('purchase.index')
            ->with('success', 'Compra del carrito completada con éxito.');
    }

    /**
     * Historial de compras.
     */
    public function index()
    {
        $purchases = Auth::user()
            ->purchases()
            ->with('videojuego', 'key')
            ->latest()
            ->get();

        return view('purchases.index', compact('purchases'));
    }
}
