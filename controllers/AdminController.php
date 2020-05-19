<?php

/**
 * Controller AdminController
 * Home page in Admin Panel
 */
class AdminController extends AdminBase
{
    /**
     * Action for start page "Admin Panel"
     * @return boolean
     */
    public function actionIndex()
    {
        // Check access
        self::checkAdmin();
        
        // Connect to view
        require_once(ROOT . '/views/admin/index.php');
        return true;
    }
}

