<?php

namespace App\models;
use App\components\Db;
use PDO;

/**
 * Order class - model for working with orders
 */
class Order
{
    /**
     * Saving order
     * @param string $userName <p>Name</p>
     * @param string $userPhone <p>Phone</p>
     * @param string $userComment <p>Comment</p>
     * @param integer $userId <p>user id</p>
     * @param array $products <p>Array of goods</p>
     * @return boolean <p>Method execution result</p>
     */
    public static function save($userName, $userPhone, $userComment, $userId, $products)
    {
        // DB Connection
        $db = Db::getConnection();
        
        // DB query text
        $sql = "INSERT INTO product_order (user_name, user_phone, user_comment, user_id, products) "
                . "VALUES (:user_name, :user_phone, :user_comment, :user_id, :products)";
        
        $products = json_encode($products);
        
        $result = $db->prepare($sql);
        $result->bindParam(":user_name", $userName, PDO::PARAM_STR);
        $result->bindParam(":user_phone", $userPhone, PDO::PARAM_STR);
        $result->bindParam(":user_comment", $userComment, PDO::PARAM_STR);
        $result->bindParam(":user_id", $userId, PDO::PARAM_INT);
        $result->bindParam(":products", $products, PDO::PARAM_STR);
        
        return $result->execute();
    }
    
    /**
     * Edits an order with a given id
     * @param integer $id <p>product id</p>
     * @param string $userName <p>Client Name</p>
     * @param string $userPhone <p>Customer Phone</p>
     * @param string $userComment <p>Customer Comment</p>
     * @param string $date <p>Date of issue</p>
     * @param integer $status <p>Status <i>(on "1", off "0")</i></p>
     * @return boolean <p>Method execution result</p>
     */
    public static function updateOrderById($id, $options)
    {
        // DB connection
        $db = Db::getConnection();
        
        // DB query text
        $sql = "UPDATE product_order SET "
                . "user_name = :userName,"
                . "user_phone = :userPhone,"
                . "user_comment = :userComment,"
                . "user_id = :userId,"
                . "status = :status "
                . "WHERE id = :id";
        
        // Getting and returning the results. Prepare Request Used.
        $result = $db->prepare($sql);
        $result->bindParam(":id", $id, PDO::PARAM_INT);
        $result->bindParam(":userName", $options['userName'], PDO::PARAM_STR);
        $result->bindParam(":userPhone", $options['userPhone'], PDO::PARAM_STR);
        $result->bindParam(":userComment", $options['userComment'], PDO::PARAM_STR);
        $result->bindParam(":userId", $options['userId'], PDO::PARAM_INT);
        $result->bindParam(":status", $options['status'], PDO::PARAM_INT);
        $result->execute();
    }
    
    /**
     * Returns a list of orders
     * @return array <p>Order List</p>
     */
    public static function getOrdersList()
    {
        // DB Connection
        $db = Db::getConnection();
        
        // DB query
        $sql = "SELECT id, user_name, date, status FROM product_order";
        
        // Getting and returning results
        $result = $db->query($sql);
        $ordersList = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $ordersList[$i]['id'] = $row['id'];
            $ordersList[$i]['user_name'] = $row['user_name'];
            $ordersList[$i]['date'] = $row['date'];
            $ordersList[$i]['status'] = $row['status'];
            $i++;
        }
        
        return $ordersList;
    }
    
    /**
     * Returns the order with the specified id
     * @param integer $id <p> id </p>
     * @return array <p>Array with order information</p>
     */
    public static function getOrderById($id)
    {
        // DB connection
        $db = Db::getConnection();
        
        // DB query
        $sql = "SELECT * FROM product_order WHERE id = :id";
        
        // Get and returns results (use prepare request)
        $result = $db->prepare($sql);
        $result->bindParam(":id", $id, PDO::PARAM_INT);
        
        // Indicate that we want to get data in the form of an array
        $result->setFetchMode(PDO::FETCH_ASSOC);
        
        // Execute the request
        $result->execute();
        
        // Return data
        return $result->fetch();
    }
    
    /**
     * Deletes an order with the given id
     * @param integer $id <p>order id</p>
     * @return boolean <p>Method execution result</p>
     */
    public static function deleteOrderById($id)
    {
        // DB connection
        $db = Db::getConnection();
        
        // DB query
        $sql = 'DELETE FROM product_order WHERE id = :id';
        
        // Getting and returning the results
        $result = $db->prepare($sql);
        $result->bindParam(":id", $id, PDO::PARAM_INT);
        $result->execute();
    }
    
    public static function getQuantityInOrder($id)
    {
        // Get information about order
        $order = self::getOrderById($id);
        
        $productsJson = $order['products'];
        $productsObject = json_decode($productsJson);
        $productsArray = [];
        
        foreach ($productsObject as $id => $quantity) {
            $productsArray[$id] = $quantity;
        }
        
        return $productsArray;
    }
    
    /**
     * Returns a text explanation of the status for the order: <br/>
     * <i> 1 - New order, 2 - In processing, 3 - Delivered, 4 - Closed </i>
     * @param integer $status <p> Status </p>
     * @return string <p> Text explanation </p>
     */
    public static function getStatusText($status)
    {
        switch ($status) {
            case '1':
                return 'New order';
                break;
            case '2':
                return 'In processing';
                break;
            case '3':
                return 'Delivered';
                break;
            case '4':
                return 'Closed';
                break;
        }
    }
}

