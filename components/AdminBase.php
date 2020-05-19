<?php

/**
 * Abstract class AdminBase contains common logic for controller, which 
 * to use in Admin Panel
 */
abstract class AdminBase
{
    /**
     * Method, which check user is has admin
     * @return boolean
     */
    public static function checkAdmin()
    {
        // Check auth for user. If not, he will be redirect
        $userId = User::checkLogged();
        
        // Get information about current user
        $user = User::getUserById($userId);
        
        // If role of current user "admin", enter him in admin panel
        if ($user['role'] == 'admin') {
            return true;
        }
        
        // Else exit work with message about access denied
        die('Access denied');
    }
}

