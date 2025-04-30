<?php

class ShopCategory extends CWidget
{
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
