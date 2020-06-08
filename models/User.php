<?php

/**
    * Class User - a model for working with users
    */
class User
{
    /**
     * User registration
     * @param string $firstName
     * @param string $lastName
     * @param string $email
     * @param string $password
     * @param string $birth
     * @param string $company
     * @param string $address
     * @param string $city
     * @param string $state
     * @param integer $postcode
     * @param string $country
     * @param string $info
     * @param string $phone
     * @return boolean
     */
    public static function register($firstName, $lastName, $email, $password, $birth, $company, $address, $city, $state, $postcode, $country, $info, $phone)
    {       
        // DB connection
        $db = Db::getConnection();
        
        // DB query text
        $sql = "INSERT INTO user (first_name, last_name, email, password, birth, company, "
             . "address, city, state, postcode, country, additional_info, phone) "
             . "VALUES (:firstName, :lastName, :email, :password, :birth, :company, "
             . ":address, :city, :state, :postcode, :country, :info, :phone)";
        
        // Getting and returning results. Prepare Request Used.
        $result = $db->prepare($sql);
        $result->bindParam(":firstName", $firstName, PDO::PARAM_STR);
        $result->bindParam(":lastName", $lastName, PDO::PARAM_STR);
        $result->bindParam(":email", $email, PDO::PARAM_STR);
        $result->bindParam(":password", $password, PDO::PARAM_STR);
        $result->bindParam(":birth", $birth, PDO::PARAM_STR);
        $result->bindParam(":company", $company, PDO::PARAM_STR);
        $result->bindParam(":address", $address, PDO::PARAM_STR);
        $result->bindParam(":city", $city, PDO::PARAM_STR);
        $result->bindParam(":state", $state, PDO::PARAM_STR);
        $result->bindParam(":postcode", $postcode, PDO::PARAM_INT);
        $result->bindParam(":country", $country, PDO::PARAM_STR);
        $result->bindParam(":info", $info, PDO::PARAM_STR);
        $result->bindParam(":phone", $phone, PDO::PARAM_STR);
        return $result->execute();
    }
    
    /**
     * User update
     * @param string $firstName
     * @param string $lastName
     * @param string $email
     * @param string $password
     * @param string $birth
     * @param string $company
     * @param string $address
     * @param string $city
     * @param string $state
     * @param integer $postcode
     * @param string $country
     * @param string $info
     * @param string $phone
     * @return boolean
     */
    public static function update($id, $firstName, $lastName, $email, $password, $birth, $company, $address, $city, $state, $postcode, $country, $info, $phone)
    {        
        // DB connection
        $db = Db::getConnection();
        
        // DB query text
        $sql = 'UPDATE user SET 
                first_name      = :firstName,
                last_name       = :lastName,
                email           = :email,
                password        = :password,
                birth           = :birth,
                company         = :company,
                address         = :address,
                city            = :city,
                state           = :state,
                postcode        = :postcode,
                country         = :country,
                additional_info = :info,
                phone = :phone WHERE id = :id';
        
        // Getting and returning results. Prepare Request Used.
        $result = $db->prepare($sql);
        $result->bindParam(":id", $id, PDO::PARAM_INT);
        $result->bindParam(":firstName", $firstName, PDO::PARAM_STR);
        $result->bindParam(":lastName", $lastName, PDO::PARAM_STR);
        $result->bindParam(":email", $email, PDO::PARAM_STR);
        $result->bindParam(":password", $password, PDO::PARAM_STR);
        $result->bindParam(":birth", $birth, PDO::PARAM_STR);
        $result->bindParam(":company", $company, PDO::PARAM_STR);
        $result->bindParam(":address", $address, PDO::PARAM_STR);
        $result->bindParam(":city", $city, PDO::PARAM_STR);
        $result->bindParam(":state", $state, PDO::PARAM_STR);
        $result->bindParam(":postcode", $postcode, PDO::PARAM_INT);
        $result->bindParam(":country", $country, PDO::PARAM_STR);
        $result->bindParam(":info", $info, PDO::PARAM_STR);
        $result->bindParam(":phone", $phone, PDO::PARAM_STR);
        return $result->execute();
    }
    
    /**
            * Check if the user exists with the given $email and $password
            * @param string $email <p>E-mail</p>
            * @param string $password <p>Password</p>
            * @return mixed: integer user id or false
            */
    public static function checkUserData($email, $password)
    {
        // DB connection
        $db = Db::getConnection();
        
        // DB query text
        $sql = 'SELECT * FROM user WHERE email = :email AND password = :password';
        
        // Getting and returning results. Prepare Request Used.
        $result = $db->prepare($sql);
        $result->bindParam(":email", $email, PDO::PARAM_STR);
        $result->bindParam(":password", $password, PDO::PARAM_STR);
        $result->execute();
        
        // Turn to the record
        $user = $result->fetch();
        
        if ($user) {
            // If the record exists, return user ID
            return $user['id'];
        }
        return false;
    }
    
    /**
            * Remember user
            * @param integer $userId <p>user id</p>
            */
    public static function auth($userId)
    {
        // write the user ID in the session
        $_SESSION['user'] = $userId;
    }
    
    /**
            * Returns the user ID if authorized. <br/>
            * Otherwise redirects to login page
            * @return string <p>User ID</p>
            */
    public static function checkLogged()
    {
        // If there is a session, return the user ID
        if (isset($_SESSION['user'])) {
            return $_SESSION['user'];
        }
        
        header("Location: /login");
    }
    
    /**
            * Checks if the user is a guest
            * @return boolean <p>Method execution result</p>
            */
    public static function isGuest()
    {
        if (isset($_SESSION['user'])) {
            return false;
        }
        return true;
    }
    
    /**
            * Checks the first name: no less than 2 characters
            * @param string $firstName <p>First Name</p>
            * @return boolean <p>Method execution result</p>
            */
    public static function checkFirstName($firstName)
    {
        if (strlen($firstName) >= 2) {
            return true;
        }
        return false;
    }
    
    /**
            * Checks the last name: no less than 2 characters
            * @param string $lastName <p>Last Name</p>
            * @return boolean <p>Method execution result</p>
            */
    public static function checkLastName($lastName)
    {
        if (strlen($lastName) >= 2) {
            return true;
        }
        return false;
    }
    
    /**
            * Checks email
            * @param string $email <p>E-mail</p>
            * @return boolean <p>Method execution result</p>
            */
    public static function checkEmail($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }
    
    /**
            * Checks if another user is busy with email
            * @param type $email <p>Email</p>
            * @return boolean <p>Method execution result</p>
            */
    public static function checkEmailExists($email)
    {
        // DB connection
        $db = Db::getConnection();
        
        // DB query text
        $sql = 'SELECT COUNT(*) FROM user WHERE email = :email';
        
        // Getting and returning results. Prepare Request Used.
        $result = $db->prepare($sql);
        $result->bindParam(":email", $email, PDO::PARAM_STR);
        $result->execute();
        
        if ($result->fetchColumn())
            return true;
        return false;
    }
    
    /**
            * Checks the password: no less than 6 characters
            * @param string $password <p>Password</p>
            * @return boolean <p>Method execution result</p>
            */
    public static function checkPassword($password)
    {
        if (strlen($password) >= 6) {
            return true;
        }
        return false;
    }
    
    /**
            * Checks the phone: no less than 10 characters
            * @param string $phone <p>Phone</p>
            * @return boolean <p>Method execution result</p>
            */
    public static function checkPhone($phone)
    {
        if (strlen($phone) >= 10) {
            return true;
        }
        return false;
    }
    
    /**
            * Returns the user with the specified id
            * @param integer $id <p>user id</p>
            * @return array <p>An array with user information</p>
            */
    public static function getUserById($id)
    {
        // DB connection        
        $db = Db::getConnection();
        
        // DB query text
        $sql = "SELECT * FROM user WHERE id = :id";
        
        // Getting and returning results. Prepare Request Used.
        $result = $db->prepare($sql);
        $result->bindParam(":id", $id, PDO::PARAM_INT);
        
        // Indicate, that want to get data in the form of an array
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();

        return $result->fetch();
    }

    /**
            * Returns the new password
            * @param string $email <p>email</p>
            * @return string <p>New password</p>
            */
    public static function resetPassword($email)
    {
        // DB connection        
        $db = Db::getConnection();

        // New password
        $password = rand(123456, 987654);
        
        // DB query text
        $sql = "UPDATE user SET password = :password WHERE email = :email";
        
        // Getting and returning results. Prepare Request Used.
        $result = $db->prepare($sql);
        $result->bindParam(":email", $email, PDO::PARAM_STR);
        $result->bindParam(":password", $password, PDO::PARAM_INT);
        
        if ($result->execute()) {
            return $password;
        }
    }
}

