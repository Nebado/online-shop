<?php

class Order
{
    
    public static function save($userName, $userPhone, $userComment, $userId, $products)
    {
        
        $db = Db::getConnection();
        
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
    
    public static function updateOrderById($id, $options)
    {
        // Connect to DB
        $db = Db::getConnection();
        
        $sql = "UPDATE product_order SET "
                . "user_name = :userName,"
                . "user_phone = :userPhone,"
                . "user_comment = :userComment,"
                . "user_id = :userId,"
                . "status = :status "
                . "WHERE id = :id";
        
        // Get and return results (to use prepare request)
        $result = $db->prepare($sql);
        $result->bindParam(":id", $id, PDO::PARAM_INT);
        $result->bindParam(":userName", $options['userName'], PDO::PARAM_STR);
        $result->bindParam(":userPhone", $options['userPhone'], PDO::PARAM_STR);
        $result->bindParam(":userComment", $options['userComment'], PDO::PARAM_STR);
        $result->bindParam(":userId", $options['userId'], PDO::PARAM_INT);
        $result->bindParam(":status", $options['status'], PDO::PARAM_INT);
        $result->execute();
    }
    
    public static function getOrdersList()
    {
        // Conect to DB
        $db = Db::getConnection();
        
        $orders = array();
        
        $sql = "SELECT id, user_name, date, status FROM product_order";
        $result = $db->query($sql);
        
        $i = 0;
        while ($row = $result->fetch()) {
            $orders[$i]['id'] = $row['id'];
            $orders[$i]['user_name'] = $row['user_name'];
            $orders[$i]['date'] = $row['date'];
            $orders[$i]['status'] = $row['status'];
            $i++;
        }
        
        return $orders;
    }
    
    public static function getOrderById($id)
    {
        // Connect to DB
        $db = Db::getConnection();
        
        $sql = "SELECT * FROM product_order WHERE id = :id";
        
        // Get and returns results (use prepare request)
        $result = $db->prepare($sql);
        $result->bindParam(":id", $id, PDO::PARAM_INT);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        
        return $result->fetch();
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
}

