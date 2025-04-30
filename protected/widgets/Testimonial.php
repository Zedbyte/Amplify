<?php

class Testimonial extends CWidget
{
    public function getViewPath($checkTheme = false)
    {
        return Yii::getPathOfAlias('application.components.home');
    }

    public function run()
    {
        $this->render('testimonial', 
            [
                'testimonials' => require(Yii::getPathOfAlias('application.data.testimonialsData') . '.php')
            ]
        );
    }
}