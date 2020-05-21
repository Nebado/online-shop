<?php

/**
 * Controller AdminCategoryController
 * Manage categories in Admin Panel
 */
class AdminCategoryController extends AdminBase
{
    /**
     * Action for page "Manage categories"
     */
    public function actionIndex()
    {
        // Check access
        self::checkAdmin();
        
        // Get list of categories
        $categoriesList = Category::getCategoriesListAdmin();
        
        $subcategoriesList = Category::getSubCategoriesListAdmin();
        
        // Connect to view
        require_once(ROOT . '/views/admin_category/index.php');
        return true;
    }
    
    public function actionCreate()
    {
        // Check access
        self::checkAdmin();
        
        // Processing Form
        if (isset($_POST['submit'])) {
            // If form is send
            // Get data from form
            $name = $_POST['name'];
            $sortOrder = $_POST['sortOrder'];
            $status = $_POST['status'];
            
            // Flag of errors in form
            $errors = false;
            
            // Validate
            if (!isset($name) || empty($name)) {
                $errors[] = "Input fields";
            }
            
            if ($errors == false) {
                // If not errors
                // Add new category
                Category::createCategory($name, $sortOrder, $status);
                
                // Redirect user on page manage categories
                header("Location: /admin/category");
            }
        }
        
        // Connect to view
        require_once(ROOT . '/views/admin_category/create.php');
        return true;
    }
    
    public function actionUpdate($id)
    {
        // Check access
        self::checkAdmin();
        
        // Get data about current category
        $category = Category::getCategoryById($id);
        
        // Processing Form
        if (isset($_POST['submit'])) {
            // If form is send
            // Get data from form
            $name = $_POST['name'];
            $sortOrder = $_POST['sortOrder'];
            $status = $_POST['status'];
            
            // Save changes
            Category::updateCategoryById($id, $name, $sortOrder, $status);
            
            // Redirect user on page manage categories
            header("Location: /admin/category");
        }
        
        // Connect to view
        require_once(ROOT . '/views/admin_category/update.php');
        return true;
    }
    
    public function actionDelete($id)
    {
        // Check access
        self::checkAdmin();
        
        // Processing Form
        if (isset($_POST['submit'])) {
            // If form is send
            // Delete product
            Category::deleteCategoryById($id);
            
            // Redirect user on page manage of categories
            header("Location: /admin/category");
        }
        
        // Connect to view
        require_once(ROOT . '/views/admin_category/delete.php');
        return true;
    }
}

