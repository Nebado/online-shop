<?php

/**
 * Cart class
 * Component for working with a basket
 */
class Cart
{
    /**
     * Adding an item to the cart (session)
     * @param int $ id <p> product id </p>
     * @return integer <p> Number of items in the cart </p>
     */
    public static function addProduct($id)
    {
        // Cast $id to integer type
        $id = intval($id);
        
        // Empty array for products in the cart
        $productsInCart = array();
        
        // If the cart already has products (they are stored in the session)
        if (isset($_SESSION['products'])) {
            // Then fill our array with products
            $productsInCart = $_SESSION['products'];
        }
        
        // Check if there is already such a product in the cart
        if (array_key_exists($id, $productsInCart)) {
            // If such a product is in the cart, 
            // but has been added again, increase the quantity by 1
            $productsInCart[$id] ++;
        } else {
            // If not, add the id of the new product to the cart with quantity 1
            $productsInCart[$id] = 1;
        }
        
        // Write an array with the products in the session
        $_SESSION['products'] = $productsInCart;
        
        // Return the number of products in the cart
        return self::countItems();
    }
    
    /**
     * Removes the item with the specified id from the cart
     * @param integer $id <p>product id</p>
     */
    public static function deleteProduct($id)
    {
        // Get an array with id's and the number of products in the cart
        $productsInCart = $_SESSION['products'];
        
        // Remove the element with the specified id from the array
        unset($productsInCart[$id]);
        
        // Write an array of products with the deleted item in the session
        $_SESSION['products'] = $productsInCart;
    }
    
    /**
     * Removes the one item with the specified id from the cart (reduce quantity)
     * @param integer $id <p>product id</p>
     */
    public static function deleteOneProduct($id)
    {
        // Get an array with id's and the number of products in the cart
        $productsInCart = $_SESSION['products'];
        
        // Reduce the amount of a particular product
        $productsInCart[$id]--;
        
        // Write an array of products with the reduced item in the session
        return $_SESSION['products'] = $productsInCart;
    }
    
    /**
     * Counting the number of products in the cart (in session)
     * @return int <p>Number of items in the cart</p>
     */
    public static function countItems()
    {
        // Checking the availability of products in the cart
        if (isset($_SESSION['products'])) {
            // If there is an array of products
            // Count and return their quantity
            $count = 0;
            foreach ($_SESSION['products'] as $id => $quantity) {
                $count = $count + $quantity;
            }
            return $count;
        } else {
            // If there are no products, return 0
            return 0;
        }
    }
    
    /**
     * Returns an array with identifiers and the number of items in the cart<br/>
     * If there are no products, returns false;
     * @return mixed: boolean or array
     */
    public static function getProducts()
    {
        if (isset($_SESSION['products'])) {
            return $_SESSION['products'];
        }
        return false;
    }
    
    /**
     * Get the total price of the transferred products
     * @param array $products<p>Array with product information</p>
     * @return integer <p>Total Price</p>
     */
    public static function getTotalPrice($products)
    {
        // Get an array with id and the number of products in the cart
        $productsInCart = self::getProducts();
        
        // Calculate the total price
        $total = 0;
        if ($productsInCart) {
            // If the cart is not empty
            // Pass through the array of products passed to the method
            foreach ($products as $item) {
                // Find the total price: price of products * quantity of products
                $total += $item['price'] * $productsInCart[$item['id']];
            }
            return $total;
        }
        return 0;
    }
    
    /**
     * Get the total price in order of the transferred products
     * @param array $products<p>Array with product information</p>
     * @param integer $quantity<p>Quantity of particular product</p>
     * @return integer <p>Total Price</p>
     */
    public static function getTotalPriceInOrder($products, $quantity)
    {
        // Calculate the total price
        $total = 0;
        
        // Pass through the array of products passed to the method
        foreach ($products as $item) {
            $total += $item['price'] * $quantity[$item['id']];
        }
        
        return $total;
    }
    
    /**
     * Get the total price of the transferred products for all pages
     * @return integer <p>Total Price</p>
     */
    public static function getPrice()
    {
        // Get an array with id and the number of products in the cart
        $productsInCart = self::getProducts();

        // Calculate the total price
        if ($productsInCart) {
            // If the cart is not empty
            // Get id's in the cart
            $productsIds = array_keys($productsInCart);
            
            // Get information about products by id's
            $products = Product::getProductsByIds($productsIds);
            
            // Calculate the total price with method getTotalPrice
            $totalPrice = Cart::getTotalPrice($products);
            
            return $totalPrice;
        }
    }
    
    /**
     * Clear the cart
     */
    public static function clear()
    {
        if (isset($_SESSION['products'])) {
            unset($_SESSION['products']);
        }
    }
}

