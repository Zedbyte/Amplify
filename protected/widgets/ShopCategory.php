<?php

class ShopCategory extends CWidget
{
    public $limit = null; // default is no limit

    public function getViewPath($checkTheme = false)
    {
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
        $criteria = new CDbCriteria();

        if ($this->limit !== null) {
            $criteria->limit = $this->limit;
        }

        return Category::model()->findAll($criteria);
    }
}
