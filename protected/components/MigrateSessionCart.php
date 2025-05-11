<?php

class MigrateSessionCart {
    public static function migrateGuestCartToUser()
    {
        if (Yii::app()->user->isGuest || !isset(Yii::app()->session['cart'])) {
            return;
        }

        $userId = Yii::app()->user->id;

        // Find the corresponding customer record for the logged-in user
        $customer = Customer::model()->findByAttributes(['user_id' => $userId]);
        if (!$customer) {
            Yii::log("No customer profile found for user ID: $userId", CLogger::LEVEL_WARNING);
            Yii::app()->user->setFlash('error', 'No customer profile found. Please contact support.');
            return;
        }

        $customerId = $customer->id;
        $sessionCart = Yii::app()->session['cart'];
        Yii::log(print_r($sessionCart, true), CLogger::LEVEL_INFO);
        foreach ($sessionCart as $productId => $quantity) {
            $existingCart = Cart::model()->findByAttributes([
                'customer_id' => $customerId,
                'product_id' => $productId
            ]);

            $existingQty = $existingCart ? $existingCart->quantity : 0;

            if (!CartHelper::isQuantityAvailable($productId, $quantity, $existingQty)) {
                continue;
            }

            if ($existingCart) {
                $existingCart->quantity += $quantity;
                $existingCart->updated_at = new CDbExpression('NOW()');
                $existingCart->save();
                Yii::log(print_r($existingCart->getErrors(), true), CLogger::LEVEL_INFO);
            } else {
                $cart = new Cart();
                $cart->customer_id = $customerId;
                $cart->product_id = $productId;
                $cart->quantity = $quantity;
                $cart->created_at = new CDbExpression('NOW()');
                $cart->updated_at = new CDbExpression('NOW()');
                $cart->save();
                Yii::log(print_r($cart->getErrors(), true), CLogger::LEVEL_INFO);

            }
        }

        unset(Yii::app()->session['cart']);
    }
}

