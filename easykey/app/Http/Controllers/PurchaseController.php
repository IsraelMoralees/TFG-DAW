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
    /**
     * Checkout sólo para un videojuego individual.
     */
    public function checkout(Videojuego $videojuego)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        // 1) Comprueba si existe alguna key sin vender para este juego
        $key = Key::where('videojuego_id', $videojuego->id)
                  ->where('sold', false)
                  ->first();

        if (! $key) {
            // Si no hay keys, redirige de vuelta con mensaje de error “Sin stock”
            return redirect()
                   ->route('catalogo.show', $videojuego)
                   ->with('error', 'Sin stock disponible para este juego.');
        }

        // 2) Marcamos la key como vendida (reservamos)
        $key->sold = true;
        $key->save();

        // 3) Preparamos la línea de Stripe
        $lineItem = [
            'price_data' => [
                'currency'     => 'eur',
                'unit_amount'  => intval($videojuego->precio * 100),
                'product_data' => ['name' => $videojuego->titulo],
            ],
            'quantity' => 1,
        ];

        // 4) Creamos la sesión de Stripe con esa key
        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items'           => [$lineItem],
            'mode'                 => 'payment',
            'metadata'             => [
                'key_id' => $key->id,
            ],
            'success_url' => route('purchase.single.success')
                             . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url'  => route('cart.cancel'),
        ]);

        return redirect($session->url);
    }

    /**
     * Callback de éxito para compra individual.
     */
    public function singleSuccess(Request $request)
    {
        Stripe::setApiKey(config('services.stripe.secret'));
        $session = Session::retrieve($request->query('session_id'));

        if ($session->payment_status !== 'paid') {
            abort(403, 'Pago no confirmado.');
        }

        // Obtenemos el ID de la key que pusimos en metadata
        $keyId = $session->metadata->key_id;
        $key   = Key::findOrFail($keyId);

        // Ya la marcamos como “sold” en checkout(), pero confirmamos nuevamente
        if (! $key->sold) {
            $key->sold = true;
            $key->save();
        }

        // Registramos la compra en la base de datos
        Purchase::create([
            'user_id'       => Auth::id(),
            'videojuego_id' => $key->videojuego_id,
            'key_id'        => $key->id,
            'purchased_at'  => now(),
        ]);

        return redirect()
            ->route('purchase.index')
            ->with('success', '¡Compra completada con éxito!');
    }

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
        $metadataKeys = [];

        foreach ($cart as $videojuegoId => $qty) {
            $juego = Videojuego::findOrFail($videojuegoId);

            for ($i = 0; $i < $qty; $i++) {
                // 1) Sacamos la key libre
                $key = Key::where('videojuego_id', $videojuegoId)
                          ->where('sold', false)
                          ->firstOrFail();

                // 2) Marcamos la key como vendida (reservamos)
                $key->sold = true;
                $key->save();

                // 3) La metemos en metadata
                $metadataKeys[] = $key->id;

                // 4) Añadimos la línea a Stripe
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
            'success_url' => route('purchase.cart.success')
                             . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url'  => route('cart.cancel'),
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

        // Recuperamos todas las claves vendidas (metadata 'key_ids')
        $keyIds = explode(',', $session->metadata->key_ids);

        foreach ($keyIds as $keyId) {
            $key = Key::findOrFail($keyId);

            // Creación de la compra SIN envolverla en un "if (! $key->sold)"
            Purchase::create([
                'user_id'       => Auth::id(),
                'videojuego_id' => $key->videojuego_id,
                'key_id'        => $key->id,
                'purchased_at'  => now(),
            ]);
        }

        // Vaciamos carrito
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
