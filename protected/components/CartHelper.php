<?php

class CartHelper
{
    /**
     * Validates if requested quantity does not exceed product stock.
     */
    public static function isQuantityAvailable($productId, $requestedQty, $existingQty = 0)
    {
        $product = Product::model()->findByPk($productId);
        if (!$product) return false;

        return ($existingQty + $requestedQty) <= (int) $product->stock;
    }
}
