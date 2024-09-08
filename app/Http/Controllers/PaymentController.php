<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Exception;

class PaymentController extends Controller
{
    public function showCheckoutForm()
    {
        return view('checkout');
    }

     public function success()
    {
        return view('success-form');
    }

    public function createPaymentIntent(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $amount = 1000; // $10 in cents
        $currency = 'usd';

        // Get the selected payment method from the request
        $paymentMethod = $request->input('payment_method');

        try {
            // Create PaymentIntent with the selected payment method
            $paymentIntent = PaymentIntent::create([
                'amount' => $amount,
                'currency' => $currency,
                'payment_method_types' => [$paymentMethod],
            ]);

            // Return the PaymentIntent client secret
            return response()->json([
                'clientSecret' => $paymentIntent->client_secret,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function confirmPayment(Request $request)
    {
        $paymentIntentId = $request->input('paymentIntentId');

        try {
            // Confirm the payment
            $paymentIntent = PaymentIntent::retrieve($paymentIntentId);
            $paymentIntent->confirm();

            if ($paymentIntent->status == 'succeeded') {
                // Payment successful
                return response()->json(['success' => true]);
            } else {
                // Payment failed
                return response()->json(['error' => 'Payment failed']);
            }
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
