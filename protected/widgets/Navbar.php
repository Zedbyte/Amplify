<?php

class Navbar extends CWidget
{
    public function getViewPath($checkTheme = false)
    {
        return Yii::getPathOfAlias('application.components.views');
    }

    public function run()
    {
        $this->render('navbar');
    }

    public function getRoutes()
    {
        $routes = require(Yii::getPathOfAlias('application.data.navRoutes') . '.php');

        // Filter out any null or malformed entries
        return array_filter($routes, function ($item) {
            return is_array($item) && isset($item['route'], $item['label']);
        });
    }

    public function getCart()
    {
        if (!Yii::app()->user->isGuest) {
            $customer = Customer::model()->findByAttributes(['user_id' => Yii::app()->user->id]);

            if (!$customer) {
                Yii::log("No customer found for user ID: " . Yii::app()->user->id, CLogger::LEVEL_WARNING);
                return [];
            }

            return Cart::model()->findAllByAttributes([
                'customer_id' => $customer->id,
            ]);
        }

        // Guest user: fetch from session
        return Yii::app()->session['cart'] ?? [];
    }
}