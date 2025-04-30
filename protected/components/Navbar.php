<?php

class Navbar extends CWidget
{
    public function run()
    {
        $this->render('navbar');
    }

    public function getRoutes()
    {
        return require(Yii::getPathOfAlias('application.data.navRoutes') . '.php');
    }
}