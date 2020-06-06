<?php

/**
 * SiteController controller
 */
class SiteController
{
    /**
     * Action for the main page
     */
    public function actionIndex()
    {
        // Get username by id
        if (isset($_SESSION['user'])) {
            $userId = $_SESSION['user'];
            $user = User::getUserById($userId);
            $userName = $user['first_name'];
        }
        // List of the categories for the left menu
        $categories = Category::getCategoriesList();

        // List of the subcategories for the left menu
        $subCategories = Category::getSubCategoriesList(1);

        // List of the latest products
        $latestProducts = Product::getLatestProducts();

        // List of the featured products
        $sliderProducts = Product::getFeaturedProducts();
        // Count items in Featured Products
        $totalFeaturedProducts = Product::getTotalProductsInFeaturedProducts();

        $totalPrice = Cart::getPrice();
        $totalQuantity = Cart::countItems();

        // Connect the view
        require_once(ROOT . '/views/site/index.php');
        return true;
    }

    /**
     * Action for the Contact page
     */
    public function actionContact()
    {
        // Variables for the form
        $userEmail = false;
        $userText = false;
        $result = false;

        // Form processing
        if (isset($_POST['submit'])) {
            // If the form is submitted
            // Get the form data from the form
            $userEmail = $_POST['email'];
            $userText = $_POST['message'];

            // Flag of errors
            $errors = false;

            // Validation the fields
            if (!User::checkEmail($userEmail)) {
                $errors[] = 'Wrong email';
            }

            if ($errors == false) {
                // If there are no errors
                // Send a mail to the admin
                $adminEmail = 'admin@gmail.com';
                $message = "Text: {$userText}. From {$userEmail}";
                $subject = "Subject: ";
                $result = mail($adminEmail, $subject, $message);
                $result = true;
            }
        }

        // Connect the view
        require_once(ROOT . '/views/site/contact.php');
        return true;
    }

    public function actionSoon()
    {

        // Connect the view
        require_once(ROOT . '/views/site/soon.php');
        return true;
    }
}
