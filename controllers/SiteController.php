<?php

class SiteController
{
    
    public function actionIndex()
    {
        // Add categories list
        $categories = Category::getCategoriesList();
        
        /* --- 001 Problem --- */
        /* --- I don't receive id subcategory within Category --- */
        $subCategories = Category::getSubCategoriesList(1);
        
        // Return array with latest products
        $latestProducts = Product::getLatestProductsList();
        
        // Return array with featured products
        $featuredProducts = Product::getFeaturedProductsList();
        // Count items in Featured Products
        $count = Product::getCountItemsInFeaturedProducts();

        // Connect view
        require_once(ROOT . '/views/site/index.php');
        return true; 
    }
}
