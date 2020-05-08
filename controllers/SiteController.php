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

        // Connect view
        require_once(ROOT . '/views/site/index.php');
        return true; 
    }
}
