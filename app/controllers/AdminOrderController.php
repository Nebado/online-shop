<?php

namespace App\controllers;
use App\models\Product;
use App\models\Order;
use App\components\AdminBase;
use App\components\Cart;

/**
 * AdminOrderController controller
 * Management of orders in the admin panel
 */
class AdminOrderController extends AdminBase
{
    /**
     * Action for the Order Management page
     */
    public function actionIndex()
    {
        // Access check
        self::checkAdmin();
        
        // Get a list of orders
        $ordersList = Order::getOrdersList();
        
        // Connect the view
        require_once(ROOT . '/views/admin_order/index.php');
        return true;
    }
    
    public function actionView($id)
    {
        // Access check
        self::checkAdmin();
        
        // Get information about order
        $order = Order::getOrderById($id);
        
        // Get information about products in order by id
        $products = Product::getProductsListInOrder($id);
        
        // Get quantity in order
        $quantity = Order::getQuantityInOrder($id);
        
        // Get total price in order
        $totalPrice = Cart::getTotalPriceInOrder($products, $quantity);
        
        // Connect to view
        require_once(ROOT . '/views/admin_order/view.php');
        return true;
    }
    
    /**
     * Action for the Order Edit page
     */
    public function actionUpdate($id)
    {
        // Access check
        self::checkAdmin();
        
        // Get data on a specific order
        $order = Order::getOrderById($id);
        
        // Get products on a specific order
        $products = Product::getProductsListInOrder($id);
        
        // Form processing
        if (isset($_POST['submit'])) {
            // If form is submitted
            // Get the data from the form
            $options['userName'] = $_POST['userName'];
            $options['userPhone'] = $_POST['userPhone'];
            $options['userComment'] = $_POST['userComment'];
            $options['userId'] = $_POST['userId'];
            $options['status'] = $_POST['status'];
            
            // Save changes
            Order::updateOrderById($id, $options);
            
            // Redirect the user to the order management page
            header("Location: /admin/order");
        }
        
        // Connect the view
        require_once(ROOT . '/views/admin_order/update.php');
        return true;
    }
    
    public function actionDelete($id)
    {
        // Access check
        self::checkAdmin();
        
        // Form processing
        if (isset($_POST['submit'])) {
            // If form is submitted
            // Delete the order
            Order::deleteOrderById($id);
            
            // Redirect the user to the order management page
            header("Location: /admin/order");
        }
        
        // Connect the view
        require_once(ROOT . '/views/admin_order/delete.php');
        return true;
    }
}

