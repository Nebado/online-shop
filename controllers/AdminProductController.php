<?php

/**
 * Controller AdminProductController
 * Manage products in Admin Panel
 */
class AdminProductController extends AdminBase
{
    /**
     * Action for page "Manage products"
     */
    public function actionIndex()
    {
        // Check access
        self::checkAdmin();
        
        // Get list of products
        $productsList = Product::getProductsList();
        
        // Connect to view
        require_once(ROOT . '/views/admin_product/index.php');
        return true;
    }
    
    public function actionCreate()
    {
        // Check access
        self::checkAdmin();
        
        // Get list of categories for pop list
        $categoriesList = Category::getCategoriesListAdmin();
        
        // Get list of subcategories for pop list
        $subCategoriesList = Category::getSubCategoriesListAdmin();
        
        // Processing Form
        if (isset($_POST['submit'])) {
            // If form is send
            // Get data from form
            $options['name'] = $_POST['name'];
            $options['code'] = $_POST['code'];
            $options['price'] = $_POST['price'];
            $options['category_id'] = $_POST['category_id'];
            $options['subcategory_id'] = $_POST['subcategory_id'];
            $options['brand'] = $_POST['brand'];
            $options['availability'] = $_POST['availability'];
            $options['description'] = $_POST['description'];
            $options['is_new'] = $_POST['is_new'];
            $options['is_featured'] = $_POST['is_featured'];
            $options['status'] = $_POST['status'];
            
            // Flag of errors in form
            $errors = false;
            
            // Validate
            if (!isset($options['name']) || empty($options['name'])) {
                $errors[] = "Input fields";
            }
            
            if ($errors == false) {
                // If not errors
                // Add new product
                $id = Product::createProduct($options);
                
                // If record is added
                if ($id) {
                    // Check uploading trough form image
                    if (is_uploaded_file($_FILES['image']['tmp_name'])) {
                        move_uploaded_file($_FILES['image']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . "/upload/images/");
                    };
                    
                    header("Location: /admin/product");
                }
            }
        }
        
        // Connect to view
        require_once(ROOT . '/views/admin_product/create.php');
        return true;
    }
    
    public function actionUpdate($id)
    {
        // Check access
        self::checkAdmin();
        
        // Get list of categories for pop list
        $categoriesList = Category::getCategoriesListAdmin();
        
        // Get list of subcategories for pop list
        $subCategoriesList = Category::getSubCategoriesListAdmin();
        
        $product = Product::getProductById($id);
        
        // Processing Form
        if (isset($_POST['submit'])) {
            // If form is send
            // Get data from form
            $options['name'] = $_POST['name'];
            $options['code'] = $_POST['code'];
            $options['price'] = $_POST['price'];
            $options['category_id'] = $_POST['category_id'];
            $options['subcategory_id'] = $_POST['subcategory_id'];
            $options['brand'] = $_POST['brand'];
            $options['availability'] = $_POST['availability'];
            $options['description'] = $_POST['description'];
            $options['is_new'] = $_POST['is_new'];
            $options['is_featured'] = $_POST['is_featured'];
            $options['status'] = $_POST['status'];
            
            // Save changes
            if (Product::updateProductById($id, $options)) {
                // If record is saved
                if (is_uploaded_file($_FILES['image']['tmp_name'])) {
                    move_uploaded_file($_FILES['image']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . "/upload/images/");
                }
            }
            
            // Redirect user on page manage products
            header("Location: /admin/product");
        }
        
        // Connect to view
        require_once(ROOT . '/views/admin_product/update.php');
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
            Product::deleteProductById($id);
            
            // Redirect user on page manage of products
            header("Location: /admin/product");
        }
        
        // Connect to view
        require_once(ROOT . '/views/admin_product/delete.php');
        return true;
    }
}

