<?php

/**
 * The abstract AdminBase class contains common logic for controllers that
 * used in admin panel
 */
abstract class AdminBase
{
    /**
     * A method that checks the user whether he is an administrator
     * @return boolean
     */
    public static function checkAdmin()
    {
        // Check if the user is authorized. If not, it will be redirected
        $userId = User::checkLogged();
        
        // Get information about the current user
        $user = User::getUserById($userId);
        
        // If the role of the current user is "admin", let him into the admin panel
        if ($user['role'] == 'admin') {
            return true;
        }
        
        // Otherwise, complete the work with the private access message
        die('Access denied');
    }
}

