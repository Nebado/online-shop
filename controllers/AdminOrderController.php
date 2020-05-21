<?php

/**
 * Controller AdminOrderController
 * Manage orders in Admin Panel
 */
class AdminOrderController extends AdminBase
{
    /**
     * Action for page "Manage orders"
     */
    public function actionIndex()
    {
        // Check access
        self::checkAdmin();
        
        // Get list of orders
        $ordersList = Order::getOrdersList();
        
        // Connect to view
        require_once(ROOT . '/views/admin_order/index.php');
        return true;
    }
    
    public function actionView($id)
    {
        // Check access
        self::checkAdmin();
        
        // Get information about order
        $order = Order::getOrderById($id);
        
        $products = Product::getProductsListInOrder($id);
        $quantity = Order::getQuantityInOrder($id);
        
        $totalPrice = Cart::getTotalPriceInOrder($products, $quantity);
        
        // Connect to view
        require_once(ROOT . '/views/admin_order/view.php');
        return true;
    }
    
    public function actionUpdate($id)
    {
        // Check access
        self::checkAdmin();
        
        // Get information about order
        $order = Order::getOrderById($id);
        
        $products = Product::getProductsListInOrder($id);
        
        // Processing Form
        if (isset($_POST['submit'])) {
            // If form is send
            // Get data from form
            $options['userName'] = $_POST['userName'];
            $options['userPhone'] = $_POST['userPhone'];
            $options['userComment'] = $_POST['userComment'];
            $options['userId'] = $_POST['userId'];
            $options['status'] = $_POST['status'];
            
            // Save changes
            Order::updateOrderById($id, $options);
            
            // Redirect user on page manage products
            header("Location: /admin/order");
        }
        
        // Connect to view
        require_once(ROOT . '/views/admin_order/update.php');
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
            Order::deleteOrderById($id);
            
            // Redirect user on page manage of products
            header("Location: /admin/order");
        }
        
        // Connect to view
        require_once(ROOT . '/views/admin_order/delete.php');
        return true;
    }
}

