<?php

class OrderHelper
{
    public static function createPayment(Order $order)
    {
        $payment = new Payment();
        $payment->payment_date = new CDbExpression('NOW()');
        $payment->payment_method = 'Card';
        $payment->amount = $order->total_price;
        $payment->customer_id = $order->customer_id;
        $payment->status = 1;
        $payment->created_at = new CDbExpression('NOW()');
        $payment->updated_at = new CDbExpression('NOW()');

        if ($payment->save()) {
            $order->status = 1; // Mark order as paid (accepted)
            $order->payment_id = $payment->id;
            if ($order->save()) {
                Yii::log('Order saved successfully: ' . $order->id, CLogger::LEVEL_INFO);
                Yii::log('Payment created successfully: ' . $payment->id, CLogger::LEVEL_INFO);
            } else {
                // Log detailed validation errors
                $errors = print_r($order->getErrors(), true);
                Yii::log('Failed to save order: ' . $errors, CLogger::LEVEL_ERROR);
            }

            // Deduct stock for each item
            foreach ($order->orderItems as $item) {
                $product = Product::model()->findByPk($item->product_id);
                if ($product) {
                    $product->stock = max(0, $product->stock - $item->quantity);
                    $product->save();
                }
            }


            return $payment;
        }

        Yii::log('Failed to create payment: ' . print_r($payment->getErrors(), true), CLogger::LEVEL_ERROR);
        return null;
    }

    public static function createShipment(Order $order)
    {
        // Avoid duplicate shipments
        if ($order->shipment_id) {
            return Shipment::model()->findByPk($order->shipment_id);
        }

        // Load the customer
        $customer = Customer::model()->findByPk($order->customer_id);
        if (!$customer) {
            Yii::log('Customer not found for shipment creation.', CLogger::LEVEL_ERROR);
            return null;
        }

        $shipment = new Shipment();
        $shipment->shipment_date = new CDbExpression('NOW()');
        $shipment->address = $customer->address ?: 'N/A';
        $shipment->city = 'N/A';
        $shipment->state = 'N/A';
        $shipment->country = 'N/A';
        $shipment->zip_code = 'N/A';
        $shipment->status = 0; //pending
        $shipment->customer_id = $order->customer_id;
        $shipment->created_at = new CDbExpression('NOW()');
        $shipment->updated_at = new CDbExpression('NOW()');

        if ($shipment->save()) {
            $order->shipment_id = $shipment->id;
            $order->save();
            return $shipment;
        }

        Yii::log('Failed to create shipment: ' . print_r($shipment->getErrors(), true), CLogger::LEVEL_ERROR);
        return null;
    }
}
