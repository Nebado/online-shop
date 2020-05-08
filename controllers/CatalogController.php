<?php

class CatalogController
{
    
    public function actionCategory($categoryId)
    {
        // Add categories list
        $categories = Category::getCategoriesList();
        
        /* --- 001 Problem --- */
        /* --- I don't receive id subcategory within Category --- */
        $subCategories = Category::getSubCategoriesList(1);
        
        // Get products in categories
        // Type array
        $catProducts = Product::getProductsListInCategory(6, $categoryId);
        
        require_once(ROOT . '/views/catalog/category.php');
        return true;
    }
    
    public function actionSubCategory($categoryId, $subCategoryId)
    {
        // Add categories list
        $categories = Category::getCategoriesList();
        /* --- 001 Problem --- */
        /* --- I don't receive id subcategory within Category --- */
        $subCategories = Category::getSubCategoriesList(1);
        
        // Get products in subcategories
        // Type array
        $subProducts = Product::getProductsListInSubCategory(6, $categoryId, $subCategoryId);
        
        require_once(ROOT . '/views/catalog/subcategory.php');
        
        return true;
    }
}

