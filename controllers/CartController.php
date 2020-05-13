<?php

class CartController
{
    
    public function actionIndex()
    {
        // Add categories list
        $categories = Category::getCategoriesList();
        
        /* --- 001 Problem --- */
        /* --- I don't receive id subcategory within Category --- */
        $subCategories = Category::getSubCategoriesList(1);
        
        require_once(ROOT . '/views/cart/index.php');
        return true;
    }
}

