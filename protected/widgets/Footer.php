<?php

class Footer extends CWidget
{
    public function getViewPath($checkTheme = false)
    {
        return Yii::getPathOfAlias('application.components.views');
    }
    
    public function run()
    {
        $this->render('footer');
    }
}