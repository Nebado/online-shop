<?php

namespace App\controllers;
use App\components\AdminBase; 

/**
 * AdminController Controller
 * Home page in admin panel
 */
class AdminController extends AdminBase
{
    /**
     * Action for the admin panel start page
     */
    public function actionIndex()
    {
        // Access check
        self::checkAdmin();
        
        // Connect the view
        require_once(ROOT . '/views/admin/index.php');
        return true;
    }
}

