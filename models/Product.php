<?php

class Product
{
    const SHOW_BY_DEFAULT = 6;
    
    /**
     * Returns an array with latest products
     * @type array
     */
    public static function getLatestProductsList()
    {
        $db = Db::getConnection();
        $products = array();
        
        $query = 'SELECT id, name, title, price, image, is_new FROM product '
                . 'WHERE status="1" '
                . 'ORDER BY id DESC '
                . 'LIMIT '.self::SHOW_BY_DEFAULT;
        
        $result = $db->query($query);
        
        $i = 0;
        while ($row = $result->fetch()) {
            $products[$i]['id'] = $row['id'];
            $products[$i]['name'] = $row['name'];
            $products[$i]['title'] = $row['title'];
            $products[$i]['price'] = $row['price'];
            $products[$i]['image'] = $row['image'];
            $products[$i]['is_new'] = $row['is_new'];
            $i++;
        }
        return $products;
    }
    
    /**
     * Returns an array with featured products
     * @type array
     */
    public static function getFeaturedProductsList()
    {
        $db = Db::getConnection();
        $products = array();
        
        $query = 'SELECT id, name, title, price, image, is_new FROM product '
                . 'WHERE status="1" AND is_featured="1" '
                . 'ORDER BY id DESC '
                . 'LIMIT '. 4;
        
        $result = $db->query($query);
        
        $i = 0;
        while ($row = $result->fetch()) {
            $products[$i]['id'] = $row['id'];
            $products[$i]['name'] = $row['name'];
            $products[$i]['title'] = $row['title'];
            $products[$i]['price'] = $row['price'];
            $products[$i]['image'] = $row['image'];
            $products[$i]['is_new'] = $row['is_new'];
            $i++;
        }
        return $products;
    }
    
    /**
     * Returns an array with products in current category
     * @type array
     */
    public static function getProductsListInCategory($count = self::SHOW_BY_DEFAULT, $categoryId, $page = 1)
    {
        $categoryId = intval($categoryId);
        $page = intval($page);
        $offset = ($page - 1) * $count;
        
        if ($categoryId) {
            $db = Db::getConnection();
            
            $products = array();
            
            $sql = "SELECT id, name, code, price, title, category_id, sub_category_id,"
                    . "availability, is_featured, description, is_new, image FROM product "
                    . "WHERE status='1' AND category_id=:categoryId "
                    . "ORDER BY id DESC "
                    . "LIMIT ".$count
                    . " OFFSET ".$offset;
            $result = $db->prepare($sql);
            $result->bindParam(":categoryId", $categoryId, PDO::PARAM_INT);
            $result->execute();
            
            $i = 0;
            while ($row = $result->fetch()) {
                $products[$i]['id'] = $row['id'];
                $products[$i]['name'] = $row['name'];
                $products[$i]['code'] = $row['code'];
                $products[$i]['price'] = $row['price'];
                $products[$i]['title'] = $row['title'];
                $products[$i]['description'] = $row['description'];
                $products[$i]['category_id'] = $row['category_id'];
                $products[$i]['sub_category_id'] = $row['sub_category_id'];
                $products[$i]['availability'] = $row['availability'];
                $products[$i]['is_featured'] = $row['is_featured'];
                $products[$i]['is_new'] = $row['is_new'];
                $products[$i]['image'] = $row['image'];
                $i++;
            }
            
            return $products;
        }
    }
    
    /**
     * Returns an array with products in current subcategory
     * @type array
     */
    public static function getProductsListInSubCategory($categoryId, $subCategoryId, $page = 1)
    {   
        $subCategoryId = intval($subCategoryId);
        $page = intval($page);
        $offset = ($page - 1) * self::SHOW_BY_DEFAULT;
        
        if ($subCategoryId) {
            
            $db = Db::getConnection();
            $products = array();
            
            $sql = "SELECT id, name, code, price, title, category_id, sub_category_id,"
                    . "availability, is_featured, description, is_new, image FROM product "
                    . "WHERE status='1' AND category_id=:categoryId AND sub_category_id=:subCategoryId "
                    . "ORDER BY id DESC "
                    . "LIMIT ".self::SHOW_BY_DEFAULT
                    . " OFFSET ".$offset;
            
            $result = $db->prepare($sql);
            $result->bindParam(":categoryId", $categoryId, PDO::PARAM_INT);
            $result->bindParam(":subCategoryId", $subCategoryId, PDO::PARAM_INT);
            $result->execute();
            
            $i = 0;
            while ($row = $result->fetch()) {
                $products[$i]['id'] = $row['id'];
                $products[$i]['name'] = $row['name'];
                $products[$i]['code'] = $row['code'];
                $products[$i]['price'] = $row['price'];
                $products[$i]['title'] = $row['title'];
                $products[$i]['description'] = $row['description'];
                $products[$i]['category_id'] = $row['category_id'];
                $products[$i]['sub_category_id'] = $row['sub_category_id'];
                $products[$i]['availability'] = $row['availability'];
                $products[$i]['is_featured'] = $row['is_featured'];
                $products[$i]['is_new'] = $row['is_new'];
                $products[$i]['image'] = $row['image'];
                $i++;
            }
            
            return $products;
        }
    }
    
    public static function getProductById($productId)
    {
        if ($productId) {
            $db = Db::getConnection();
            
            $sql = "SELECT * FROM product WHERE id = :productId";
            $result = $db->prepare($sql);
            $result->bindParam(":productId", $productId, PDO::PARAM_INT);
            $result->execute();
            
            return $result->fetch();
        }
    }
    
    /**
     * Returns count of items in category
     * @param type $categoryId
     * @return type integer
     */
    public static function getCountItemsInCategory($categoryId)
    {
        if ($categoryId) {
            $db = Db::getConnection();
            
            $sql = "SELECT COUNT(id) count FROM product "
                    . "WHERE status='1' AND category_id = :categoryId ";
            
            $result = $db->prepare($sql);
            $result->bindParam(":categoryId", $categoryId, PDO::PARAM_INT);
            $result->execute();
            
            if ($row = $result->fetch()) {
                return $row['count'];
            }
        }
    }
    
    /**
     * Returns count of items in subcategory
     * @param type $subCategoryId
     * @return type integer
     */
    public static function getCountItemsInSubCategory($subCategoryId)
    {
        if ($subCategoryId) {
            $db = Db::getConnection();
            
            $sql = "SELECT COUNT(id) count FROM product "
                    . "WHERE status='1' AND sub_category_id = :subCategoryId ";
            
            $result = $db->prepare($sql);
            $result->bindParam(":subCategoryId", $subCategoryId, PDO::PARAM_INT);
            $result->execute();
            
            if ($row = $result->fetch()) {
                return $row['count'];
            }
        }
    }
    
    /**
     * Returns count of items in featured products
     * @return type integer
     */
    public static function getCountItemsInFeaturedProducts()
    {
        $db = Db::getConnection();

        $sql = "SELECT COUNT(id) count FROM product "
                . "WHERE status='1' AND is_featured='1'";

        $result = $db->query($sql);

        if ($row = $result->fetch()) {
            return $row['count'];
        }
    }
    
    public static function getProductsByIds($idsArray)
    {
        $products = array();
        
        $db = Db::getConnection();
        
        $idsString = implode(',', $idsArray);
        
        $sql = "SELECT * FROM product WHERE status = '1' AND id IN ($idsString)";
        
        $result = $db->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        
        $i = 0;
        while($row = $result->fetch()) {
            $products[$i]['id'] = $row['id'];
            $products[$i]['name'] = $row['name'];
            $products[$i]['code'] = $row['code'];
            $products[$i]['price'] = $row['price'];
            $products[$i]['title'] = $row['title'];
            $products[$i]['image'] = $row['image'];
            $i++;
        }
        
        return $products;
    }
    
    /**
     * Return list of products
     * @return array of products
     */
    public static function getProductsList()
    {
        // Connect to DB
        $db = Db::getConnection();
        
        // Get and return results
        $result = $db->query('SELECT id, name, price, code FROM product ORDER BY id ASC');
        $productsList = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $productsList[$i]['id'] = $row['id'];
            $productsList[$i]['name'] = $row['name'];
            $productsList[$i]['price'] = $row['price'];
            $productsList[$i]['code'] = $row['code'];
            $i++;
        }
        return $productsList;
    }
    
    /**
     * Delete product by id
     * @param integer $id
     * @return boolen
     */
    public static function deleteProductById($id)
    {
        // Connect to DB
        $db = Db::getConnection();
        
        // Request string from DB
        $sql = 'DELETE FROM product WHERE id = :id';
        
        // Get and return results. Use prepare request
        $result = $db->prepare($sql);
        $result->bindParam(":id", $id, PDO::PARAM_INT);
        return $result->execute();
    }
    
    public static function createProduct($options)
    {
        // Connect to DB
        $db = Db::getConnection();
        
        // Request string to DB
        $sql = 'INSERT INTO product '
                . '(name, code, price, category_id, sub_category_id, brand, availability, '
                . 'description, is_new, is_featured, status) '
                . 'VALUES '
                . '(:name, :code, :price, :category_id, :subcategory_id, :brand, :availability,'
                . ':description, :is_new, :is_featured, :status)';
        
        // Get and return results. To use prepare request
        $result = $db->prepare($sql);
        $result->bindParam(":name", $options['name'], PDO::PARAM_STR);
        $result->bindParam(":code", $options['code'], PDO::PARAM_STR);
        $result->bindParam(":price", $options['price'], PDO::PARAM_STR);
        $result->bindParam(":category_id", $options['category_id'], PDO::PARAM_INT);
        $result->bindParam(":subcategory_id", $options['subcategory_id'], PDO::PARAM_INT);
        $result->bindParam(":brand", $options['brand'], PDO::PARAM_STR);
        $result->bindParam(":availability", $options['availability'], PDO::PARAM_INT);
        $result->bindParam(":description", $options['description'], PDO::PARAM_STR);
        $result->bindParam(":is_new", $options['is_new'], PDO::PARAM_INT);
        $result->bindParam(":is_featured", $options['is_featured'], PDO::PARAM_INT);
        $result->bindParam(":status", $options['status'], PDO::PARAM_INT);
        if ($result->execute()) {
            return $db->lastInsertId();
        }
        return 0;
    }
    
    public static function updateProductById($id, $options)
    {
        // Connect to DB
        $db = Db::getConnection();
        
        // Request string to DB
        $sql = "UPDATE product
            SET
                name            = :name,
                code            = :code,
                price           = :price,
                category_id     = :category_id,
                sub_category_id  = :subcategory_id,
                brand           = :brand,
                availability    = :availability,
                description     = :description,
                is_new          = :is_new,
                is_featured     = :is_featured,
                status          = :status
            WHERE id = :id";
        
        // Get and return results. To use prepare request
        $result = $db->prepare($sql);
        $result->bindParam(":id", $id, PDO::PARAM_INT);
        $result->bindParam(":name", $options['name'], PDO::PARAM_STR);
        $result->bindParam(":code", $options['code'], PDO::PARAM_STR);
        $result->bindParam(":price", $options['price'], PDO::PARAM_STR);
        $result->bindParam(":category_id", $options['category_id'], PDO::PARAM_INT);
        $result->bindParam(":subcategory_id", $options['subcategory_id'], PDO::PARAM_INT);
        $result->bindParam(":brand", $options['brand'], PDO::PARAM_STR);
        $result->bindParam(":availability", $options['availability'], PDO::PARAM_INT);
        $result->bindParam(":description", $options['description'], PDO::PARAM_STR);
        $result->bindParam(":is_new", $options['is_new'], PDO::PARAM_INT);
        $result->bindParam(":is_featured", $options['is_featured'], PDO::PARAM_INT);
        $result->bindParam(":status", $options['status'], PDO::PARAM_INT);
        return $result->execute();
    }
    
    public static function getProductsListInOrder($id)
    {
        // Get information about order
        $order = Order::getOrderById($id);
        
        $productsJson = $order['products'];
        $productsObject = json_decode($productsJson);
        $productsArray = [];
        
        foreach ($productsObject as $id => $quantity) {
            $productsArray[$id] = $quantity;
        }
        
        $productsIds = array_keys($productsArray);
        $products = Product::getProductsByIds($productsIds);
        
        return $products;
    }
}