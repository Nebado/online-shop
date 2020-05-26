<?php

/**
 * AdminCategoryController controller
 * Management of product categories in the admin panel
 */
class AdminCategoryController extends AdminBase
{
    /**
     * Action for the Category Management page
     */
    public function actionIndex()
    {
        // Access check
        self::checkAdmin();
        
        // Get a list of categories
        $categoriesList = Category::getCategoriesListAdmin();
        
        $subcategoriesList = Category::getSubCategoriesListAdmin();
        
        // Connect the view
        require_once(ROOT . '/views/admin_category/index.php');
        return true;
    }
    
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
                Category::createCategory($name, $sortOrder, $status);
                
                // Redirect the user to the category management page
                header("Location: /admin/category");
            }
        }

        // Connect the view
        require_once(ROOT . '/views/admin_category/create.php');
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
        $category = Category::getCategoryById($id);
        
        // Form processing
        if (isset($_POST['submit'])) {
            // If form is submitted
            // Get the data from the form
            $name = $_POST['name'];
            $sortOrder = $_POST['sortOrder'];
            $status = $_POST['status'];
            
            // Save changes
            Category::updateCategoryById($id, $name, $sortOrder, $status);
            
            // Redirect the user to the category management page
            header("Location: /admin/category");
        }
        
        // Connect the view
        require_once(ROOT . '/views/admin_category/update.php');
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
            Category::deleteCategoryById($id);
            
            // Redirect the user to the category management page
            header("Location: /admin/category");
        }
        
        // Connect the view
        require_once(ROOT . '/views/admin_category/delete.php');
        return true;
    }
}

