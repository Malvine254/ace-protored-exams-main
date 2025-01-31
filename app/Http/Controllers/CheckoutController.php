<?php

namespace App\Http\Controllers;

use App\Facades\Cart;
use App\Mail\AdminNotifications;
use App\Mail\OrderCreatedMail;
use App\Mail\OrderSuccessEmail;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class CheckoutController extends Controller
{
    public function showPaymentForm()
    {
        $total_amount = $this->calculateTotal(Cart::get()['products'], 'price');
        $products = Cart::get()['products'];

        return view('checkout', ['total_amount' => $total_amount, 'products' => $products]);
    }

    public function processPayment(Request $request)
    {

        $products = Cart::get()['products'];
        $email = $request->input('email');
        $name = $request->input('name');
        $phone = $request->input('phone');
        $payment_method = $request->input('payment_method');

        $order_products_list = array_map(function ($p) {
            return [
                'product_id' => $p->id,
                'name' => $p->name,
                'description' => $p->description,
                'download_link' => $p->download_link,
                'price' => $p->price,
                'images' => [
                    config('app.url') . $p->images[0] ?? ""
                ],
                'quantity'    => 1 //always make quantity as 1
            ];
        }, $products);

        $order = Order::create([
            'products' => $order_products_list,
            'payment_method' => 'stripe',
            'status' => 'pending',
            'source' => 'website',
            'customer_name' => $name,
            'customer_email' => $email,
            'customer_phone' => $phone,
            'total_amount' => $this->calculateTotal($products, 'price')
        ]);

        if ($payment_method === 'stripe') {
            $payment_link = $this->stripePayment($order, $products, $email);

            return redirect($payment_link);
        }

        if ($payment_method === 'paypal') {
            // $payment_link = $this->paypalPayment($order, $products, $email);

            return redirect(route('payment.paypal', ['id' => $order->id]));
        }
    }

    public function completePaypalPayment($id)
    {
        $order = Order::find($id);

        return view('payment.paypal-checkout', ['order' => $order]);
    }

    private function stripePayment(Order $order, $products, $email)
    {
        $line_items = array_map(function ($p) {
            return [
                'price_data'  => [
                    'product_data' => [
                        'name' => $p->name,
                        'description' => $this->shortenString($p->description),
                        'images' => [
                            config('app.url') . $p->images[0] ?? ""
                        ]
                    ],
                    'unit_amount'  => ($p->price / $p->amount) * 100,
                    'currency'     => 'USD',
                ],
                'quantity'    => 1 //always make quantity as 1
            ];
        }, $products);

        try {
            $stripe = new \Stripe\StripeClient(config('services.stripe.secret'));

            $redirectUrl = route('order.success', ['id' => $order->id]) . '?session_id={CHECKOUT_SESSION_ID}';
            $response =  $stripe->checkout->sessions->create([
                'success_url' => $redirectUrl,
                'payment_method_types' => ['link', 'card'],
                'customer_email' => $email,
                'line_items' => $line_items,
                'mode' => 'payment',
                'allow_promotion_codes' => false
            ]);

            $order->update([
                'stripe_id' => $response['id'],
                'stripe_checkout_url' => $response['url']
            ]);

            // Send Order email
            try {
                Mail::to($email)->send(new OrderCreatedMail($order));
            } catch (\Exception $e) {
                // Payment failed; store an error message in the session
                Log::error('Error:' . $e->getMessage());
            }

            return $response['url'];
        } catch (\Exception $e) {
            // Payment failed; store an error message in the session
            Log::error('Error:' . $e->getMessage());

            return route('payment.failure');
        }
    }

    public function paypalPayment(Request $request)
    {
        $orderId = $request->input('order_id');
        $order = Order::findOrFail($orderId);

        $line_items = array_map(function ($p) {
            return [
                'unit_amount'  => [
                    'value'  => $p['price'],
                    'currency_code'     => 'USD',
                ],
                'name' => $p['name'],
                'description' => $this->shortenString($p['description']),
                'image_url' => $p['images'][0] ?? "",
                'url' => config('app.url') . '/products' . '/product-name-' . $p['product_id'],
                'quantity'    => 1 //always make quantity as 1
            ];
        }, $order->products);

        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('payment.paypal.success', ['id' => $order->id]),
                "cancel_url" => route('payment.failure'),
            ],
            "purchase_units" => [
                0 => [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => $order->total_amount,
                        'breakdown' => [
                            'item_total' => [
                                'value'  => $order->total_amount,
                                'currency_code' => 'USD',
                            ]
                        ]
                    ],
                    "items" => $line_items
                ]
            ]
        ]);

        if (isset($response['id']) && $response['id'] != null) {
            $order->update(['paypal_order_id' => $response['id']]);

            // Send Order email
            try {
                Mail::to($order->customer_email)->send(new OrderCreatedMail($order));
            } catch (\Exception $e) {
                // Payment failed; store an error message in the session
                Log::error('Error:' . $e->getMessage());
            }

            return response()->json(['id' => $response['id']]);
        } else {
            Log::error('Error:', ['response' => $response]);

            return response()->json(['error' => 'Unable to create PayPal order'], 500);
        }
    }

    public function paypalCheckoutSuccess(Request $request)
    {
        $orderId = $request->input('order_id');
        $order = Order::findOrFail($orderId);

        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($order->paypal_order_id);
        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            $this->completeOrder($order);

            return route('order.complete');
        } else {

            Log::error('Error:', ['response' => $response]);

            return route('payment.failure');
        }
    }


    public function stripeCheckoutSuccess(Request $request)
    {
        $stripe = new \Stripe\StripeClient(config('services.stripe.secret'));

        $session = $stripe->checkout->sessions->retrieve($request->session_id);

        // On success
        return view('payment.success', ['session_data' => $session]);
    }

    private function calculateTotal($array, $field)
    {
        $sum = 0;
        foreach ($array as $item) {
            if (isset($item[$field])) {
                $sum += $item[$field];
            }
        }
        return $sum;
    }

    private function completeOrder(Order $order)
    {
        // update order
        $order->update(['status' => 'paid', 'paid_at' => now()]);

        // send email
        if (!$order->email_sent) {
            try {
                Mail::to(config('constants.admin_notifications_email'))->send(new AdminNotifications($order));
                Mail::to($order->customer_email)->send(new OrderSuccessEmail($order));

                $order->update(['email_sent' => true]);
            } catch (\Exception $e) {
                // Payment failed; store an error message in the session
                Log::error('Error: Failed to send email ' . $e->getMessage());
            }
        }
    }

    private function shortenString($string, $maxLength = 100, $suffix = '...')
    {
        // Strip HTML tags
        $plainText = strip_tags($string);

        // Check if the string needs truncation
        if (mb_strlen($plainText) > $maxLength) {
            return mb_substr($plainText, 0, $maxLength) . $suffix;
        }

        return $plainText;
    }
}
