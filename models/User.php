<?php

class User
{
    /**
     * Add a new user
     * @param type $firstName
     * @param type $lastName
     * @param type $email
     * @param type $password
     * @param type $birth
     * @param type $company
     * @param type $address
     * @param type $city
     * @param type $state
     * @param type $postcode
     * @param type $country
     * @param type $info
     * @param type $phone
     * @return boolean, integer
     */
    public static function register($firstName, $lastName, $email, $password, $birth, $company, $address, $city, $state, $postcode, $country, $info, $phone)
    {
        $stateStr = json_encode($state);
        $countryStr = json_encode($country);
        
        $db = Db::getConnection();
                
        $sql = "INSERT INTO user (first_name, last_name, email, password, birth, company, "
                . "address, city, state, postcode, country, additional_info, phone) "
                . "VALUES (:firstName, :lastName, :email, :password, :birth, :company, "
                . ":address, :city, :state, :postcode, :country, :info, :phone)";
        $result = $db->prepare($sql);
        $result->bindParam(":firstName", $firstName, PDO::PARAM_STR);
        $result->bindParam(":lastName", $lastName, PDO::PARAM_STR);
        $result->bindParam(":email", $email, PDO::PARAM_STR);
        $result->bindParam(":password", $password, PDO::PARAM_STR);
        $result->bindParam(":birth", $birth, PDO::PARAM_STR);
        $result->bindParam(":company", $company, PDO::PARAM_STR);
        $result->bindParam(":address", $address, PDO::PARAM_STR);
        $result->bindParam(":city", $city, PDO::PARAM_STR);
        $result->bindParam(":state", $stateStr, PDO::PARAM_STR);
        $result->bindParam(":postcode", $postcode, PDO::PARAM_INT);
        $result->bindParam(":country", $countryStr, PDO::PARAM_STR);
        $result->bindParam(":info", $info, PDO::PARAM_STR);
        $result->bindParam(":phone", $phone, PDO::PARAM_STR);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        
        if ($result->execute()) {
            return $id = $db->lastInsertId();
        }
        return true;
    }
    
    /**
     * Login user
     * @param type $email
     * @param type $password
     * @return boolean
     */
    public static function login($email, $password) {
        $db = Db::getConnection();
        
        $sql = "SELECT id FROM user WHERE email = :email AND password = :password";
        $result = $db->prepare($sql);
        $result->bindParam(":email", $email, PDO::PARAM_STR);
        $result->bindParam(":password", $password, PDO::PARAM_STR);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        
        if ($row = $result->fetch()) {
            return $row['id'];
        }
        return true;
    }
    
    /**
     * Remember user
     * @param integer $userId
     */
    public static function auth($userId)
    {
        // Write in user id in session
        $_SESSION['user'] = $userId;
    }
    
    /**
     * Return user id, if he is auth
     * else redirect to login page
     * @return string
     */
    public static function checkLogged()
    {
        if (isset($_SESSION['user'])) {
            return $_SESSION['user'];
        }
            header("Location: /login/");
    }
    
    /**
     * Check user has a guest
     * @return boolean
     */
    public static function isGuest()
    {
        if (isset($_SESSION['user'])) {
            return false;
        }
        return true;
    }
    
    /**
     * Check firstName at least 2 char
     * @param type $firstName
     * @return boolean
     */
    public static function checkFirstName($firstName)
    {
        if (strlen($firstName) >= 2) {
            return true;
        }
        return false;
    }
    
     /**
     * Check lastName at least 2 char
     * @param type $lastName
     * @return boolean
     */
    public static function checkLastName($lastName)
    {
        if (strlen($lastName) >= 2) {
            return true;
        }
        return false;
    }
    
    /**
     * Check email for validation
     * @param type $email
     * @return boolean
     */
    public static function checkEmail($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }
    
    /**
     * Check email on exists
     * @param type $email
     * @return boolean
     */
    public static function checkEmailExists($email)
    {
        $db = Db::getConnection();
        
        $sql = "SELECT id FROM user WHERE email = :email";
        $result = $db->prepare($sql);
        $result->bindParam(":email", $email, PDO::PARAM_STR);
        $result->execute();
        
        if ($result->fetch()) {
            return true;
        }
        return false;
    }
    
    /**
     * Check password at least 6 char
     * @param type $password
     * @return boolean
     */
    public static function checkPassword($password)
    {
        if (strlen($password) >= 6) {
            return true;
        }
        return false;
    }
    
    /**
     * Check phone at least 10 char
     * @param type $phone
     * @return boolean
     */
    public static function checkPhone($phone)
    {
        if (strlen($phone) >= 10) {
            return true;
        }
        return false;
    }
    
    /**
     * Return array with information about user
     * @param integer $id
     * @return array
     */
    public static function getUserById($id)
    {
        $id = intval($id);
        
        $db = Db::getConnection();
        $sql = "SELECT * FROM user WHERE id = :id";
        
        $result = $db->prepare($sql);
        $result->bindParam(":id", $id, PDO::PARAM_INT);
        $result->execute();

        while ($row = $result->fetch()) {
            $user['first_name'] = $row['first_name'];
            $user['last_name'] = $row['last_name'];
            $user['email'] = $row['email'];
            $user['role'] = $row['role'];
        }
        
        return $user;
    }
}

