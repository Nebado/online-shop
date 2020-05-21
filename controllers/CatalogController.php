<?php

class CatalogController
{
    
    public function actionCategory($categoryId, $page = 1)
    {
        // Add categories list
        $categories = Category::getCategoriesList();
        
        /* --- 001 Problem --- */
        /* --- I don't receive id subcategory within Category --- */
        $subCategories = Category::getSubCategoriesList(1);
        
        // Get count items in current category
        $total = Product::getCountItemsInCategory($categoryId);
        
        $pagination = new Pagination($total, $page, Product::SHOW_BY_DEFAULT, 'page-');
        // Get products in categories
        // Type array
        $catProducts = Product::getProductsListInCategory(6, $categoryId, $page);
        
        $totalPrice = Cart::getPrice();
        $totalQuantity = Cart::countItems();
        
        require_once(ROOT . '/views/catalog/category.php');
        return true;
    }
    
    public function actionSubCategory($categoryId, $subCategoryId, $page = 1)
    {
        // Add categories list
        $categories = Category::getCategoriesList();
        /* --- 001 Problem --- */
        /* --- I don't receive id subcategory within Category --- */
        $subCategories = Category::getSubCategoriesList(1);
        
        // Get count items in current category
        $total = Product::getCountItemsInSubCategory($subCategoryId);
        
        $pagination = new Pagination($total, $page, Product::SHOW_BY_DEFAULT, 'page-');
        
        $subProducts = Product::getProductsListInSubCategory($categoryId, $subCategoryId, $page);
        
        $totalPrice = Cart::getPrice();
        $totalQuantity = Cart::countItems();
        
        require_once(ROOT . '/views/catalog/subcategory.php');
        return true;
    }
}

