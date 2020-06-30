<?php

namespace App\controllers;
use App\models\Category;
use App\models\Product;
use App\models\User;
use App\components\Cart;

/**
 * CartController controller
 * Cart
 */
class CartController {

    /**
     * Action for the Cart page
     */
    public function actionIndex() {
        
        // List of categories for the left menu
        $categories = Category::getCategoriesList();

        // List of subcategories for the left menu
        $subCategories = Category::getSubCategoriesList(1);

        // Get the identifiers and the number of products in the cart
        $productsInCart = Cart::getProducts();

        if ($productsInCart) {
            // If there are products in the cart, get full information about the products for the list
            // Get an array with product identifiers only
            $productsIds = array_keys($productsInCart);
            
            // Get an array with full information about the necessary products.
            $products = Product::getProductsByIds($productsIds);

            // Get the total price of products
            $totalPrice = Cart::getTotalPrice($products);
        }

        $totalPrice = 0;
        $totalQuantity = Cart::countItems();

        // Connect the view
        require_once(ROOT . '/views/cart/index.php');
        return true;
    }

    /**
     * Action to add a product to the cart with a synchronous request <br/>
     * (for example, not used)
     * @param integer $ id <p> product id </p>
     */
    public function actionAdd($id) {
        // Add product to cart
        Cart::addProduct($id);

        // Return the user to the page from which he came
        $referrer = $_SERVER['HTTP_REFERER'];
        header("Location: $referrer");
    }

    /**
     * Action to add an item to the cart using an asynchronous request (ajax)
     * @param integer $ id <p> product id </p>
     */
    public function actionAddAjax($id) {
        // Add the product to the cart and print the result: the number of products in the cart
        echo Cart::addProduct($id);
        return true;
    }
    
    /**
     * Action to delete a product to the cart
     * @param integer $ id <p> product id </p>
     */
    public function actionDelete($id)
    {
        // Delete the specified item from the cart
        Cart::deleteOneProduct($id);
        
        // Return the user to the cart
        header("Location: /cart/");
    }
    
    /**
     * Action to delete a product to the cart
     * @param integer $ id <p> product id </p>
     */
    public function actionDeleteProduct($id)
    {
        // Delete the specified item from the cart
        Cart::deleteProduct($id);
        
        // Return the user to the cart
        header("Location: /cart/");
    }

    /**
     * Action for the Checkout page
     */
    public function actionCheckout() 
    {
        // Get data from the cart
        $productsInCart = Cart::getProducts();
        
        // If there are no products, we send users to search for products on the main page
        if ($productsInCart == false) {
            header("Location: /");
        }
        
        // List of categories for the left menu
        $categories = Category::getCategoriesList();

        // List of subcategories for the left menu
        $subCategories = Category::getSubCategoriesList(1);
        
        // Find the total price
        
        $productsIds = array_keys($productsInCart);
        $products = Product::getProductsByIds($productsIds);
        $totalPrice = Cart::getTotalPrice($products);
        
        // Number of products
        $totalQuantity = Cart::countItems();
        
        // Form Fields
        $userName = false;
        $userPhone = false;
        $userComment = false;
        
        // Successful Checkout Status
        $result = false;

        // Check if the user is a guest
        if (!User::isGuest()) {
            // If the user is not a guest
            // Get user information from the database
            $userId = User::checkLogged();
            $user = User::getUserById($userId);
            $userName = $user['first_name'];
        } else {
            // If guest, form fields will remain empty
            $userId = false;
        }
        
        // Form processing
        if (isset($_POST['submit'])) {
            // If the form is submitted
            // Get the form data from the form
            $userName = $_POST['userName'];
            $userPhone = $_POST['userPhone'];
            $userComment = $_POST['userComment'];

            // Flag of errors
            $errors = false;
            
            // Validation the fields
            if (!User::checkFirstName($userName))
                $errors[] = 'Wrong name';
            if (!User::checkPhone($userPhone))
                $errors[] = 'Wrong phone';
            
            
            if ($errors == false) {
                // If there are no errors
                // Save the order in the database
                $result = Order::save($userName, $userPhone, $userComment, $userId, $productsInCart);

                if ($result) {
                    // If the order is successfully saved
                    // Notify the administrator about a new order by mail
                    $adminEmail = 'admin@php.com';
                    $message = '<a href="http://yourhost.com/admin/orders">List of orders</a>';
                    $subject = 'New order';
                    mail($adminEmail, $subject, $message);

                    // Clear the cart
                    Cart::clear();
                }
            }
        }

        // Connect the view
        require_once(ROOT . '/views/cart/checkout.php');
        return true;
    }

}
