<?php

class AboutUs extends CWidget
{
    public function getViewPath($checkTheme = false)
    {
        // Tell Yii that views are stored here now
        return Yii::getPathOfAlias('application.components.home');
    }

    public function run()
    {
        $this->render('aboutUs');
    }
}