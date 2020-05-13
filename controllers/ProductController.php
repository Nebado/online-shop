<?php

class ProductController
{  
    public function actionView($productId)
    {
        // Add categories list
        $categories = Category::getCategoriesList();
        
        /* --- 001 Problem --- */
        /* --- I don't receive id subcategory within Category --- */
        $subCategories = Category::getSubCategoriesList(1);
        
        // Returns product by id
        $product = Product::getProductById($productId);
        
        require_once(ROOT . '/views/product/view.php');
        return true;
    }
}

