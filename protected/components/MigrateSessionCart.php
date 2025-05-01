<?php

class MigrateSessionCart {
    public static function migrateGuestCartToUser()
    {
        if (Yii::app()->user->isGuest || !isset(Yii::app()->session['cart'])) {
            return;
        }

        $userId = Yii::app()->user->id;
        $sessionCart = Yii::app()->session['cart'];

        foreach ($sessionCart as $productId => $quantity) {
            $existingCart = Cart::model()->findByAttributes([
                'customer_id' => $userId,
                'product_id' => $productId
            ]);

            if ($existingCart) {
                $existingCart->quantity += $quantity;
                $existingCart->updated_at = new CDbExpression('NOW()');
                $existingCart->save();
            } else {
                $cart = new Cart();
                $cart->customer_id = $userId;
                $cart->product_id = $productId;
                $cart->quantity = $quantity;
                $cart->created_at = new CDbExpression('NOW()');
                $cart->updated_at = new CDbExpression('NOW()');
                $cart->save();
            }
        }

        unset(Yii::app()->session['cart']); // Clear session cart
    }
}

