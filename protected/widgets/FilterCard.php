<?php

class FilterCard extends CWidget
{
    public function getViewPath($checkTheme = false)
    {
        return Yii::getPathOfAlias('application.components.product');
    }

    public function run()
    {
        $this->render('filterCard', [
            'brands' => $this->getBrands(),
            'enablePriceRange' => true,
            'enableStockFilter' => true,
        ]);
    }

    // public function getCategories()
    // {
    //     return Category::model()->findAllByAttributes(['status' => 1]);
    // }

    public function getBrands()
    {
        return Brand::model()->findAllByAttributes(['status' => 1]);
    }
}
