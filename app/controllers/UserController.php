<?php

namespace App\controllers;
use App\models\User;
use App\models\Category;
use App\components\Cart;

/**
 * UserController controller
 */
class UserController
{
    
    /**
     * Action for the Registration page
     */
    public function actionRegister()
    {
        $totalPrice = Cart::getPrice();
        $totalQuantity = Cart::countItems();
        
        // List of the categories for the left menu
        $categories = Category::getCategoriesList();
        
        // List of the subcategories for the left menu
        $subCategories = Category::getSubCategoriesList(1);
        
        // Variables for the form
        $firstName = false;
        $lastName = false;
        $email = false;
        $password = false;
        $birth = false;
        $company = false;
        $address = false;
        $city = false;
        $state = false;
        $postcode = false;
        $country = false;
        $phone = false;
        
        $result = false;
        
        if (isset($_POST['submit'])) {
            $firstName  = $_POST['firstName'];
            $lastName   = $_POST['lastName'];
            $email      = $_POST['email'];
            $password   = $_POST['password'];
            $birth      = $_POST['birth'];
            $company    = $_POST['company'];
            $address    = $_POST['address'];
            $city       = $_POST['city'];
            $state      = $_POST['state'];
            $postcode   = $_POST['postcode'];
            $country    = $_POST['country'];
            $info       = $_POST['info'];
            $phone      = $_POST['phone'];
            
            // Flag of errors
            $errors = false;

            // Validation the fields
            if (!User::checkFirstName($firstName)) {
                $errors[] = 'First name must be at least 2 characters';
            }
            if (!User::checkLastName($lastName)) {
                $errors[] = 'Last name must be at least 2 characters';
            }
            if (!User::checkEmail($email)) {
                $errors[] = 'Email is wrong';
            }
            if (User::checkEmailExists($email)) {
                $errors[] = 'Email is exists';
            }
            if (!User::checkPassword($password)) {
                $errors[] = 'Password must be at least 6 characters';
            }
            if (!User::checkPhone($phone)) {
                $errors[] = 'Phone must be at least 10 characters';
            }
            
            if ($errors == false) {
                // If there are no errors
                // Registrate a new user
                $result = User::register($firstName, $lastName, $email,
                                         $password, $birth, $company, $address, $city, 
                                         $state, $postcode, $country, $info, $phone);
            }            
        }
        
        // Connect the view
        require_once(ROOT . '/views/user/register.php');
        return true;
    }
    
    /**
     * Action for the Login page
     */
    public function actionLogin()
    {
        $totalPrice = Cart::getPrice();
        $totalQuantity = Cart::countItems();
        
        // List of the categories for the left menu
        $categories = Category::getCategoriesList();
        
        // List of the subcategories for the left menu
        $subCategories = Category::getSubCategoriesList(1);
        
        // Variables for form
        $email = false;
        $password = false;
        $result = false;
        
        if (isset($_POST['submit'])) {
            // If there are no errors
            // Get the form data from the form
            $email = $_POST['email'];
            $password = $_POST['password'];
            
            // Flag of errors
            $errors = false;
            
            // Validation fields
            if (!User::checkEmail($email)) {
                $errors[] = 'Email is wrong';
            }
            
            if (!User::checkPassword($password)) {
                $errors[] = 'Password must be at least 6 characters';
            }
            
            // Check if user exists
            $userId = User::checkUserData($email, $password);
            
            if ($userId == false) {
                // If the data is incorrect - show the error
                $errors[] = 'Incorrect login details';
            } else {
                // If the data is correct, remember the user (session)
                User::auth($userId);
                
                // We redirect the user to the closed part - home page
                header("Location: /");
            }
        }        
        
        require_once(ROOT . '/views/user/login.php');
        return true;
    }
    
    /**
            * Delete user data from the session
            */
    public function actionLogout()
    {
        // Start the session
        session_start();
        
        // Delete user information from the session
        unset($_SESSION['user']);
        
        // Redirect the user to the main page
        header("Location: /");
    }

    /**
     * Reset password 
     */
    public function actionReset()
    {

       $result = false;
       $email = false;

       // Form processing
       if (isset($_POST['submit'])) {
           $email = $_POST['email'];

           // Flag of error
           $errors = false;

           // Validate errors
           if (!User::checkEmail($email)) {
               $errors[] = 'Wrong email';
           }

           if ($errors == false) {
               $newPass = User::resetPassword($email);

               if ($newPass == true) {
                   // Send a mail to the user with new password
                   $adminEmail = 'admin@gmail.com';
                   $message = "Text: {$newPass}. From {$adminEmail}";
                   $subject = "Subject: Reset Password";
                   //$result = mail($email, $subject, $message);
                   $result = true;
               }
           }

       }

       // Connect to view
       require_once(ROOT . '/views/user/forgetpass.php');
       return true;
    }
    
}
