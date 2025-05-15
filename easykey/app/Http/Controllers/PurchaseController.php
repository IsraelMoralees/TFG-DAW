<?php

namespace App\Http\Controllers;

use App\Models\Videojuego;
use App\Models\Key;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Illuminate\Support\Facades\Auth;


class PurchaseController extends Controller
{
    public function checkout(Videojuego $videojuego)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        $key = Key::where('videojuego_id', $videojuego->id)
            ->where('sold', false)
            ->firstOrFail();

        // Genera sólo la URL base al controlador de éxito, sin session_id todavía
        $baseSuccessUrl = route('purchase.success', [
            'videojuego' => $videojuego->id,
        ]);

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency'     => 'eur',
                    'unit_amount'  => intval($videojuego->precio * 100),
                    'product_data' => ['name' => $videojuego->titulo],
                ],
                'quantity' => 1,
            ]],
            'mode'        => 'payment',
            'metadata'    => ['key_id' => $key->id],
            'success_url' => $baseSuccessUrl.'?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url'  => route('catalogo.show', $videojuego),
        ]);

        return redirect($session->url);
    }


    public function success(Request $request, Videojuego $videojuego)
    {
        Stripe::setApiKey(config('services.stripe.secret'));
        $session = Session::retrieve($request->query('session_id'));

        if ($session->payment_status !== 'paid') {
            abort(403, 'Pago no confirmado.');
        }

        $key = Key::findOrFail($session->metadata->key_id);

        if (! $key->sold) {
            $key->sold = true;
            $key->save();

            Purchase::create([
                'user_id'       => Auth::id(),
                'videojuego_id' => $videojuego->id,
                'key_id'        => $key->id,
                'purchased_at'  => now(),
            ]);
        }

        return redirect()
            ->route('purchase.index')
            ->with('success', "Compra completada. Tu clave: {$key->key_code}");
    }

    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $purchases = $user
            ->purchases()
            ->with('videojuego', 'key')
            ->latest()
            ->get();

        return view('purchases.index', compact('purchases'));
    }
}
