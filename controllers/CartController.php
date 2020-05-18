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
        
        $productsInCart = false;
        
        // Get data from cart
        $productsInCart = Cart::getProducts();
        
        if ($productsInCart) {
            $productsIds = array_keys($productsInCart);
            $products = Product::getProductsByIds($productsIds);
            
            $totalPrice = Cart::getTotalPrice($products);
        }
        
        require_once(ROOT . '/views/cart/index.php');
        return true;
    }
    
    /**
     * Sync request
     * @param type $id
     * @return boolean
     */
    public function actionAdd($id)
    {
        // Add product in cart
        Cart::addProduct($id);
        
        $referrer = $_SERVER['HTTP_REFERER'];
        header("Location: $referrer");
        
        return true;
    }
    
    public function actionAddAjax($id)
    {
        // Add a product in cart
        echo Cart::addProduct($id);
        return true;
    }
}

