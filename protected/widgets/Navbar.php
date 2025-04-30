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
}