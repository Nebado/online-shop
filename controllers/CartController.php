<?php

class CartController {

    public function actionIndex() {
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
            $totalQuantity = Cart::countItems();
        }

        require_once(ROOT . '/views/cart/index.php');
        return true;
    }

    /**
     * Sync request
     * @param type $id
     * @return boolean
     */
    public function actionAdd($id) {
        // Add product in cart
        Cart::addProduct($id);

        $referrer = $_SERVER['HTTP_REFERER'];
        header("Location: $referrer");

        return true;
    }
    
    public function actionDelete($id)
    {
        Cart::deleteOneProduct($id);
        header("Location: /cart/");
    }
    
    public function actionDeleteProduct($id)
    {
        Cart::deleteProduct($id);
        header("Location: /cart/");
    }

    public function actionAddAjax($id) {
        // Add a product in cart
        echo Cart::addProduct($id);
        return true;
    }

    public function actionCheckout() {
        
        // Add categories list
        $categories = Category::getCategoriesList();

        /* --- 001 Problem --- */
        /* --- I don't receive id subcategory within Category --- */
        $subCategories = Category::getSubCategoriesList(1);
        
        $result = false;

        if (isset($_POST['submit'])) {
            $userName = $_POST['userName'];
            $userPhone = $_POST['userPhone'];
            $userComment = $_POST['userComment'];

            // Validate errors
            $errors = false;
            if (!User::checkFirstName($userName))
                $errors[] = 'Wrong name';
            if (!User::checkPhone($userPhone))
                $errors[] = 'Wrong phone';

            // Is form correct? - Yes
            if ($errors == false) {
                $productsInCart = Cart::getProducts();
                if (User::isGuest()) {
                    $userId = false;
                } else {
                    $userId = User::checkLogged();
                }

                // Save order in DB
                $result = Order::save($userName, $userPhone, $userComment, $userId, $productsInCart);

                if ($result) {
                    // Notice admin abour new order
                    $adminEmail = 'admin@php.com';
                    $message = 'http://yourhost.com/admin/orders';
                    $subject = 'New order';
                    mail($adminEmail, $subject, $message);

                    // Clear cart
                    Cart::clear();
                }
            } else {
                // Is form correct? - No
                // Total
                $productsInCart = Cart::getProducts();
                $productsIds = array_keys($productsInCart);
                $products = Product::getProductsByIds($productsIds);
                $totalPrice = Cart::getTotalPrice($products);
                $totalQuantity = Cart::countItems();
            }
        } else {
            // Form is not send

            $productsInCart = Cart::getProducts();

            if ($productsInCart == false) {
                // Cart is empty

                header("Location: /");
            } else {
                // Cart is not empty
                // Total
                $productsIds = array_keys($productsInCart);
                $products = Product::getProductsByIds($productsIds);
                $totalPrice = Cart::getTotalPrice($products);
                $totalQuantity = Cart::countItems();

                $userName = false;
                $userPhone = false;
                $userComment = false;

                if (User::isGuest()) {
                    // No
                } else {
                    $userId = User::checkLogged();
                    $user = User::getUserById($userId);

                    $userName = $user['name'];
                }
            }
        }

        require_once(ROOT . '/views/cart/checkout.php');

        return true;
    }

}
