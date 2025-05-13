<?php

use Stripe\Stripe;
use Stripe\Checkout\Session;

class StripeService
{
    public static function createCheckoutSession($order)
    {
        $userId = Yii::app()->user->id;
        $user = User::model()->findByPk($userId);

        $autoloadPath = dirname(Yii::app()->basePath) . '/vendor/autoload.php';
        if (file_exists($autoloadPath)) {
            require_once($autoloadPath);
        } else {
            throw new CHttpException(500, 'Stripe SDK not found. Please run composer install.');
        }

        Stripe::setApiKey(Yii::app()->params['stripe.secretKey']);

        $lineItems = [];

        foreach ($order->orderItems as $item) {
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'php',
                    'unit_amount' => intval($item->price * 100),
                    'product_data' => [
                        'name' => $item->product->name,
                    ],
                ],
                'quantity' => $item->quantity,
            ];
        }

        return Session::create([
            'payment_method_types' => ['card'],
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => Yii::app()->params['stripe.successUrl'] . '?order_id=' . $order->id . '&session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => Yii::app()->params['stripe.cancelUrl'],
            'metadata' => [
                'order_id' => $order->id,
            ],
            'customer_email' => $user->email,
            'payment_intent_data' => [
                'shipping' => [
                    'name' => $user->first_name . ' ' . $user->last_name,
                    'address' => [
                        'line1' => '123 Test St.',
                        'country' => 'PH', 
                    ],
                ],
            ],
        ]);
    }
}
