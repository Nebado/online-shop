<?php

namespace App\controllers;
use App\models\User;
use App\components\Cart;

/**
 * CabinetController controller
 * Management of personal information in the cabinet
 */
class CabinetController
{
    /**
     * Action for the index page for personal infromation
     */
    public function actionIndex()
    {
        // Chess access
        $userId = User::checkLogged();
        if ($userId == true) {
            $user = User::getUserById($userId);
            $userName = $user['first_name'];
        } else {
            // If there are not access then redirect in page login
            header ("Location: /login");
        }
                
        require_once(ROOT . '/views/cabinet/index.php');
        return true;
    }
    
    /**
     * Action for the edit page for the user
     */
    public function actionEdit()
    {
        $userId = User::checkLogged();
        if ($userId == true) {
            $user = User::getUserById($userId);
        } else {
            header ("Location: /login");
        }

        // Variables for the form
        $firstName = $user['first_name'];
        $lastName = $user['last_name'];
        $email = $user['email'];
        $password = $user['password'];
        $birth = $user['birth'];
        $company = $user['company'];
        $address = $user['address'];
        $city = $user['city'];
        $state = $user['state'];
        $postcode = $user['postcode'];
        $country = $user['country'];
        $phone = $user['phone'];
        
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
            if (!User::checkPassword($password)) {
                $errors[] = 'Password must be at least 6 characters';
            }
            if (!User::checkPhone($phone)) {
                $errors[] = 'Phone must be at least 10 characters';
            }
            
            if ($errors == false) {
                // If there are no errors
                // Registrate a new user
                $result = User::update($userId, $firstName, $lastName, $email,
                        $password, $birth, $company, $address, $city, 
                        $state, $postcode, $country, $info, $phone);
            }            
        }
        
        require_once(ROOT . '/views/cabinet/edit.php');
        return true;
    }
}

