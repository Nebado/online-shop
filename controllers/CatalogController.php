<?php

/**
 * CatalogController controller
 * Catalog
 */
class CatalogController
{
    /**
     * Action for the Product Category page
     */
    public function actionCategory($categoryId, $page = 1)
    {
        // List of categories for the left menu
        $categories = Category::getCategoriesList();
        
        // List of subcategories for the left menu
        $subCategories = Category::getSubCategoriesList(1);
        
        // List of products in the category
        $categoryProducts = Product::getProductsListByCategory($categoryId, $page);
        
        // Total number of products (required for page navigation)
        $total = Product::getTotalProductsInCategory($categoryId);
        
        // Create a Pagination Object - Pagination
        $pagination = new Pagination($total, $page, Product::SHOW_BY_DEFAULT, 'page-');      
        
        $totalPrice = Cart::getPrice();
        $totalQuantity = Cart::countItems();
        
        // Connect the view
        require_once(ROOT . '/views/catalog/category.php');
        return true;
    }
    
    public function actionSubCategory($categoryId, $subCategoryId, $page = 1)
    {
        // List of categories for the left menu
        $categories = Category::getCategoriesList();
        
        // List of subcategories for the left menu
        $subCategories = Category::getSubCategoriesList($categoryId);
        
        // List of products in the subcategory
        $subCategoryProducts = Product::getProductsListBySubCategory($categoryId, $subCategoryId, $page);
        
        // Total number of products (required for page navigation)
        $total = Product::getTotalProductsInSubCategory($subCategoryId);
        
        // Create a Pagination Object - Pagination
        $pagination = new Pagination($total, $page, Product::SHOW_BY_DEFAULT, 'page-');
        
        $totalPrice = Cart::getPrice();
        $totalQuantity = Cart::countItems();
        
        require_once(ROOT . '/views/catalog/subcategory.php');
        return true;
    }
}

