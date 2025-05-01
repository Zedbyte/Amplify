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
            'categories' => $this->getCategories(),
        ]);
    }

    public function getCategories()
    {
        return Category::model()->findAllByAttributes(['status' => 1]);
    }
}
