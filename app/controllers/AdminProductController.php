<?php

namespace App\controllers;
use App\models\Category;
use App\models\Product;
use App\components\AdminBase;

/**
 * AdminProductController Controller
 * Product management in admin panel
 */
class AdminProductController extends AdminBase
{
    /**
     * Action for the product management page
     */
    public function actionIndex()
    {
        // Access check
        self::checkAdmin();
        
        // Get a list of products
        $productsList = Product::getProductsList();
        
        // Connect the view
        require_once(ROOT . '/views/admin_product/index.php');
        return true;
    }
    
    public function actionCreate()
    {
        // Access check
        self::checkAdmin();
        
        // Get a list of categories for the drop-down list
        $categoriesList = Category::getCategoriesListAdmin();
        
        // Get a list of subcategories for the drop-down list
        $subCategoriesList = Category::getSubCategoriesListAdmin();
        
        // Form processing
        if (isset($_POST['submit'])) {
            // If form is submitted
            // Get the data from the form
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
            
            // Flag of errors in the form
            $errors = false;
            
            // If necessary, you can validate the values as needed.
            if (!isset($options['name']) || empty($options['name'])) {
                $errors[] = "Input fields";
            }
            
            if ($errors == false) {
                // If there are not errors
                // Add a new product
                $id = Product::createProduct($options);
                
                // If a record is added
                if ($id) {
                    // Check if the image was loaded through the form
                    if (is_uploaded_file($_FILES['image']['tmp_name'])) {
                        // If it loaded, move it to the desired folder, give a new name
                        move_uploaded_file($_FILES['image']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . "/upload/images/products/{$id}.jpg");
                    };
                    
                    // Redirect the user to the product management page
                    header("Location: /admin/product");
                }
            }
        }
        
        // Connect the view
        require_once(ROOT . '/views/admin_product/create.php');
        return true;
    }
    
    /**
     * Action for the Edit Product page
     */
    public function actionUpdate($id)
    {
        // Access check
        self::checkAdmin();
        
        // Get a list of categories for the drop-down list
        $categoriesList = Category::getCategoriesListAdmin();
        
        // Get list of subcategories for the drop-down list
        $subCategoriesList = Category::getSubCategoriesListAdmin();
        
        // Get data on a specific order
        $product = Product::getProductById($id);
        
        // Form processing
        if (isset($_POST['submit'])) {
            // If form is submitted
            // Get the data from the form
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
                
                // If a record is saved
                // Check if the image was loaded through the form
                if (is_uploaded_file($_FILES['image']['tmp_name'])) {
                    // If it loaded, move it to the desired folder, give a new name
                    move_uploaded_file($_FILES['image']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . "/upload/images/products/{$id}.jpg");
                }
            }           
            
            // Redirect the user to the product managment page
            header("Location: /admin/product");
        }
        
        // Connect the view
        require_once(ROOT . '/views/admin_product/update.php');
        return true;
    }
    
    /**
     * Action for the Delete Product page
     */
    public function actionDelete($id)
    {
        // Access check
        self::checkAdmin();
        
        // Form processing
        if (isset($_POST['submit'])) {
            // If form is submitted
            // Delete the product
            Product::deleteProductById($id);
            
            // Redirect the user to the product management page
            header("Location: /admin/product");
        }
        
        // Connect the view
        require_once(ROOT . '/views/admin_product/delete.php');
        return true;
    }
}

