<?php

class Cart
{
    /**
     * 
     * @param type $id
     */
    public static function addProduct($id)
    {
        $id = intval($id);
        
        // Empty array for products in cart
        $productsInCart = array();
        
        // If in cart has products (they store in session)
        if (isset($_SESSION['products'])) {
            $productsInCart = $_SESSION['products'];
        }
        
        // If a good has in cart, but he has been added again, increase count
        if (array_key_exists($id, $productsInCart)) {
            $productsInCart[$id] ++;
        } else {
            // Add a new product in cart
            $productsInCart[$id] = 1;
        }
        
        $_SESSION['products'] = $productsInCart;
        
        return self::countItems();
    }
    
    /**
     * Count of products in cart
     * @return int
     */
    public static function countItems()
    {
        if (isset($_SESSION['products'])) {
            $count = 0;
            foreach ($_SESSION['products'] as $id => $quantity) {
                $count = $count + $quantity;
            }
            return $count;
        } else {
            return 0;
        }
    }
    
    public static function getProducts()
    {
        if (isset($_SESSION['products'])) {
            return $_SESSION['products'];
        }
        return false;
    }
    
    public static function getTotalPrice($products)
    {
        $productsInCart = self::getProducts();
        
        if ($productsInCart) {
            $total = 0;
            foreach ($products as $item) {
                $total += $item['price'] * $productsInCart[$item['id']];
            }
        }
        
        return $total;
    }
}

