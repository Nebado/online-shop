<?php

class UserController
{
    
    public function actionRegister()
    {
        // Add categories list
        $categories = Category::getCategoriesList();
        /* --- 001 Problem --- */
        /* --- I don't receive id subcategory within Category --- */
        $subCategories = Category::getSubCategoriesList(1);
        
        // Registration
        $firstName = '';
        $lastName = '';
        $email = '';
        $password = '';
        $birth = '';
        $company = '';
        $address = '';
        $city = '';
        $state = '';
        $postcode = '';
        $country = '';
        $phone = '';
        
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
        
            // Validate errors
            $errors = [];

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
                // Receive user id when he is registered
                $userId = User::register($firstName, $lastName, $email,
                        $password, $birth, $company, $address, $city, 
                        $state, $postcode, $country, $info, $phone);

                if ($userId) {
                    User::auth($userId);
                    header("Location: /");
                }
                $result = true;
            }            
        }
        
        require_once(ROOT . '/views/register/register.php');
        return true;
    }
    
    public function actionLogin()
    {
        // Add categories list
        $categories = Category::getCategoriesList();
        
        /* --- 001 Problem --- */
        /* --- I don't receive id subcategory within Category --- */
        $subCategories = Category::getSubCategoriesList(1);
        
        // Login
        $email = '';
        $password = '';
        $result = false;
        
        if (isset($_POST['submit'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];
            
            $errors = [];
            
            // Validate errors
            if (!User::checkEmail($email)) {
                $errors[] = 'Email is wrong';
            }
            
            if (!User::checkPassword($password)) {
                $errors[] = 'Password must be at least 6 characters';
            }
            
            if (!$errors) {
                $userId = User::login($email, $password);
                if ($userId) {
                    User::auth($userId);
                    header("Location: /");
                }
            }
        }        
        
        require_once(ROOT . '/views/login/login.php');
        return true;
    }
    
    public function actionLogout()
    {
        if ($_SESSION['user']) {
            unset($_SESSION['user']);
            header("Location: /");
        }
        return true;
    }
}
