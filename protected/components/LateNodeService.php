<?php

// Not Used
class LateNodeService
{
    public static function sendEmail($to, $subject, $body)
    {
        $endpoint = 'https://api.latenode.com/send-email'; // adjust if different

        $payload = [
            'to' => $to,
            'subject' => $subject,
            'body' => $body,
        ];

        $ch = curl_init($endpoint);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        $error = curl_error($ch);
        curl_close($ch);

        if ($error) {
            Yii::log("LateNode Error: $error", CLogger::LEVEL_ERROR);
        } else {
            Yii::log("LateNode response: $response", CLogger::LEVEL_INFO);
        }

        return $response;
    }

    public static function sendOrderConfirmation($order)
    {
        $customer = $order->customer; // assumes $order->customer is defined in relations
        $user = $customer->user;      // assumes $customer->user is defined in relations
    
        if (!$user || empty($user->email)) {
            Yii::log("Email sending failed: No user or email associated with order ID {$order->id}", CLogger::LEVEL_ERROR);
            return false;
        }
    
        $subject = "Order #{$order->id} Confirmed";
        $body = "Hello {$user->first_name} {$user->last_naame}, your order has been confirmed.\nTotal: ₱" . number_format($order->total_price, 2);
    
        return self::sendEmail($user->email, $subject, $body);
    }
    
}
