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
        return require(Yii::getPathOfAlias('application.data.navRoutes') . '.php');
    }

    public function getCart()
    {
        if (!Yii::app()->user->isGuest) {
            // Logged-in user: fetch from database
            return Cart::model()->findAllByAttributes([
                'customer_id' => Yii::app()->user->id,
            ]);
        }

        // Guest user: fetch from session
        return Yii::app()->session['cart'] ?? [];
    }
}