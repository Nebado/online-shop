<?php

namespace App\controllers;
use App\models\Category;
use App\components\AdminBase;

/**
 * AdminCategoryController controller
 * Management of product categories in the admin panel
 */
class AdminSubCategoryController extends AdminBase
{    
    /**
     * Action for the Add Category page
     */    
    public function actionCreate()
    {
        // Access check
        self::checkAdmin();
        
        // Form processing
        if (isset($_POST['submit'])) {
            // If the form is submitted
            // Get the data from the form
            $name = $_POST['name'];
            $categoryId = $_POST['categoryId'];
            $sortOrder = $_POST['sortOrder'];
            $status = $_POST['status'];
            
            // Flag of errors in the form
            $errors = false;
            
            // If necessary, you can validate the values as needed.
            if (!isset($name) || empty($name)) {
                $errors[] = "Fill in the fields";
            }
            
            if ($errors == false) {
                // If there are no errors
                // Add a new category
                Category::createSubCategory($name, $categoryId, $sortOrder, $status);
                
                // Redirect the user to the category management page
                header("Location: /admin/category");
            }
        }

        // Connect the view
        require_once(ROOT . '/views/admin_subcategory/create.php');
        return true;
    }
    
    /**
     * Action for the Edit Category page
     */
    public function actionUpdate($id)
    {
        // Access check
        self::checkAdmin();
        
        // Get data about a specific category
        $subcategory = Category::getSubCategoryById($id);
        
        // Form processing
        if (isset($_POST['submit'])) {
            // If form is submitted
            // Get the data from the form
            $name = $_POST['name'];
            $sortOrder = $_POST['sortOrder'];
            $categoryId = $_POST['categoryId'];
            $status = $_POST['status'];
            
            // Save changes
            Category::updateSubCategoryById($id, $name, $sortOrder, $categoryId, $status);
            
            // Redirect the user to the category management page
            header("Location: /admin/category");
        }
        
        // Connect the view
        require_once(ROOT . '/views/admin_subcategory/update.php');
        return true;
    }
    
    /**
     * Action for the Delete Category page
     */
    public function actionDelete($id)
    {
        // Access check
        self::checkAdmin();
        
        // Form processing
        if (isset($_POST['submit'])) {
            // If form is submitted
            // Delete the category
            Category::deleteSubCategoryById($id);
            
            // Redirect the user to the category management page
            header("Location: /admin/category");
        }
        
        // Connect the view
        require_once(ROOT . '/views/admin_subcategory/delete.php');
        return true;
    }
}

