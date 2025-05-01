<?php

class ShopCategory extends CWidget
{
    public $limit = null;
    public $imageHeightClass = 'h-[300px]'; // default value

    public function getViewPath($checkTheme = false)
    {
        return Yii::getPathOfAlias('application.components.home');
    }

    public function run()
    {
        $this->render('shopCategories', [
            'categories' => $this->getCategories(),
            'imageHeightClass' => $this->imageHeightClass,
        ]);
    }

    public function getCategories()
    {
        $criteria = new CDbCriteria;
        if ($this->limit !== null) {
            $criteria->limit = $this->limit;
        }

        return Category::model()->findAll($criteria);
    }
}
