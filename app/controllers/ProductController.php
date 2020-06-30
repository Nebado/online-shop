<?php

namespace App\controllers;
use App\models\Category;
use App\models\Product;
use App\components\Cart;

/**
 * ProductController
 * Product
 */
class ProductController
{  
    /**
     * Action for product view page
     * @param integer $productId <p> product id </p>
     */
    public function actionView($productId)
    {
        // List of categories for the left menu
        $categories = Category::getCategoriesList();
        
        // List of subcategories for the left menu
        $subCategories = Category::getSubCategoriesList(1);
        
        // Get product info by id
        $product = Product::getProductById($productId);
        
        $totalPrice = Cart::getPrice();
        $totalQuantity = Cart::countItems();
        
        // Connect the view
        require_once(ROOT . '/views/product/view.php');
        return true;
    }
}

