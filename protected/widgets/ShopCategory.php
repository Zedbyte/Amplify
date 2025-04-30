<?php

class ShopCategory extends CWidget
{
    public function getViewPath($checkTheme = false)
    {
        // Tell Yii that views are stored here now
        return Yii::getPathOfAlias('application.components.home');
    }

    public function run()
    {
        $this->render('shopCategories', [
            'categories' => $this->getCategories(),
        ]);
    }

    public function getCategories()
    {
        // Fetch from tbl_category; adjust criteria as needed
        return Category::model()->findAll();
    }
}
