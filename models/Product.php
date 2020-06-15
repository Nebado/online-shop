<?php

 /**
  * Product class - model for working with products
  */
class Product
{
    // Number of items displayed by default
    const SHOW_BY_DEFAULT = 6;
    
    /**
     * Returns an array of latest items
     * @Param type $count [optional] <p>Number</ p>
     * @param type $page [optional] <p>Current page number</p>
     * @return array <p>Array of products</p>
     */
    public static function getLatestProducts($count = self::SHOW_BY_DEFAULT)
    {
        // DB connection
        $db = Db::getConnection();
        
        // DB query text
        $sql = 'SELECT id, name, price, is_new FROM product '
                . 'WHERE status="1" ORDER BY id DESC '
                . 'LIMIT :count';
        
        // Prepare Request Used
        $result = $db->prepare($sql);
        $result->bindParam(':count', $count, PDO::PARAM_INT);
        
        // Indicate that we want to get data in the form of an array
        $result->setFetchMode(PDO::FETCH_ASSOC);
        
        // Command execution
        $result->execute();
        
        // Getting and returning results
        $i = 0;
        $productsList = array();
        while ($row = $result->fetch()) {
            $productsList[$i]['id'] = $row['id'];
            $productsList[$i]['name'] = $row['name'];
            $productsList[$i]['price'] = $row['price'];
            $productsList[$i]['is_new'] = $row['is_new'];
            $i++;
        }
        return $productsList;
    }
    
    /**
     * Returns an array with featured products
     * @type array
     */
    public static function getFeaturedProducts()
    {
        // DB connection
        $db = Db::getConnection();
        
        // DB query text
        $sql = 'SELECT id, name, price, is_new FROM product '
                . 'WHERE status="1" AND is_featured="1" '
                . 'ORDER BY id DESC';
        
        $result = $db->query($sql);
        
        // Getting and returning results
        $i = 0;
        $productsList = array();
        while ($row = $result->fetch()) {
            $productsList[$i]['id'] = $row['id'];
            $productsList[$i]['name'] = $row['name'];
            $productsList[$i]['price'] = $row['price'];
            $productsList[$i]['is_new'] = $row['is_new'];
            $i++;
        }
        return $productsList;
    }
    
    /**
     * Returns a list of products in the specified category
     * @param type $categoryId <p>category id</p>
     * @param type $page [optional] <p>Page Number</p>
     * @return type <p>Array of goods</p>
     */
    public static function getProductsListByCategory($categoryId, $page = 1)
    {
        $limit = Product::SHOW_BY_DEFAULT;
        // Offset(for request)
        $offset = ($page - 1) * self::SHOW_BY_DEFAULT;
        
        // DB connection
        $db = Db::getConnection();
        
        // DB query text
        $sql = "SELECT id, name, price, is_new, availability, title FROM product "
                . "WHERE status = '1' AND category_id = :category_id "
                . "ORDER BY id ASC LIMIT :limit OFFSET :offset";
        
        // Prepare Request Used
        $result = $db->prepare($sql);
        $result->bindParam(':category_id', $categoryId, PDO::PARAM_INT);
        $result->bindParam(':limit', $limit, PDO::PARAM_INT);
        $result->bindParam(':offset', $offset, PDO::PARAM_INT);
        
        // Command execution
        $result->execute();

        // Getting and returning results
        $i = 0;
        $products = array();
        while ($row = $result->fetch()) {
            $products[$i]['id'] = $row['id'];
            $products[$i]['name'] = $row['name'];
            $products[$i]['price'] = $row['price'];
            $products[$i]['is_new'] = $row['is_new'];
            $products[$i]['title'] = $row['title'];
            $products[$i]['availability'] = $row['availability'];
            $i++;
        }
        return $products;
    }
    
    /**
     * Returns an array with products in current subcategory
     * @type array
     */
    public static function getProductsListBySubCategory($categoryId, $subCategoryId, $page = 1)
    {   
        $limit = Product::SHOW_BY_DEFAULT;
        // Offset(for request)
        $offset = ($page - 1) * self::SHOW_BY_DEFAULT;
        
        // DB connection
        $db = Db::getConnection();
        
        // DB query text
        $sql = "SELECT id, name, price, is_new FROM product "
                . "WHERE status='1' AND category_id = :category_id AND sub_category_id = :sub_category_id "
                . "ORDER BY id ASC LIMIT :limit OFFSET :offset";

        // Prepare Request Used
        $result = $db->prepare($sql);
        $result->bindParam(':category_id', $categoryId, PDO::PARAM_INT);
        $result->bindParam(':sub_category_id', $subCategoryId, PDO::PARAM_INT);
        $result->bindParam(':limit', $limit, PDO::PARAM_INT);
        $result->bindParam(':offset', $offset, PDO::PARAM_INT);
        
        // Command execution
        $result->execute();

        // Getting and returning results
        $i = 0;
        $products = array();
        while ($row = $result->fetch()) {
            $products[$i]['id'] = $row['id'];
            $products[$i]['name'] = $row['name'];
            $products[$i]['price'] = $row['price'];
            $products[$i]['is_new'] = $row['is_new'];
            $i++;
        }
        return $products;
    }
    
    /**
     * Returns the product with the specified id
     * @param integer $id <p>product id</p>
     * @return array <p>Array with product information</p>
     */
    public static function getProductById($id)
    {
        // DB connection
        $db = Db::getConnection();
        
        // DB query text
        $sql = "SELECT * FROM product WHERE id = :id";
        
        // Prepare Request Used
        $result = $db->prepare($sql);
        $result->bindParam(":id", $id, PDO::PARAM_INT);
        
        // Command execution
        $result->execute();
        
        // Getting and returning results
        return $result->fetch();
    }
    
    /**
     * Return the number of products in the specified category
     * @param integer $ categoryId
     * @return integer
     */
    public static function getTotalProductsInCategory($categoryId)
    {
        // DB connection
        $db = Db::getConnection();

        // DB request text
        $sql = 'SELECT count(id) AS count FROM product WHERE status="1" AND category_id = :category_id';

        // Prepare Request Used
        $result = $db->prepare($sql);
        $result->bindParam(":category_id", $categoryId, PDO::PARAM_INT);
        
        // Command execution
        $result->execute();

        // Return value count - quantity
        $row = $result->fetch();
        return $row['count'];
    }
    
    /**
     * Return the number of products in the specified subcategory
     * @param integer $ subcategoryId
     * @return integer
     */
    public static function getTotalProductsInSubCategory($subcategoryId)
    {
        // DB connection
        $db = Db::getConnection();

        // DB request text
        $sql = 'SELECT count(id) AS count FROM product WHERE status="1" AND sub_category_id = :sub_category_id';

        // Prepare Request Used
        $result = $db->prepare($sql);
        $result->bindParam(":sub_category_id", $subcategoryId, PDO::PARAM_INT);
        
        // Command execution
        $result->execute();

        // Return value count - quantity
        $row = $result->fetch();
        return $row['count'];
    }
    
    /**
     * Returns count of items in featured products
     * @return type integer
     */
    public static function getTotalProductsInFeaturedProducts()
    {
        // DB connection
        $db = Db::getConnection();

        // DB query text
        $sql = 'SELECT count(id) AS count FROM product WHERE status="1" AND is_featured="1"';

        // Query execution
        $result = $db->query($sql);

        // Return value count - quantity
        $row = $result->fetch();
        return $row['count'];
    }
    
    /**
     * Returns a list of products with the specified identifiers
     * @param array $idsArray <p>An array with identifiers</p>
     * @return array <p>Array with a list of products</p>
     */
    public static function getProductsByIds($idsArray)
    {
        // DB connection
        $db = Db::getConnection();
        
        // Turn the array into a string to form a condition in the request
        $idsString = implode(',', $idsArray);
        
        // DB query text
        $sql = "SELECT * FROM product WHERE status = '1' AND id IN ($idsString)";
        
        $result = $db->query($sql);
        
        // Indicate, that we want to get data in the form of an array
        $result->setFetchMode(PDO::FETCH_ASSOC);
        
        // Getting and returning resultss
        $i = 0;
        $products = array();
        while($row = $result->fetch()) {
            $products[$i]['id'] = $row['id'];
            $products[$i]['name'] = $row['name'];
            $products[$i]['code'] = $row['code'];
            $products[$i]['price'] = $row['price'];
            $i++;
        }
        return $products;
    }
    
    /**
     * Returns a list of products
     * @return array <p>Array of products</p>
     */
    public static function getProductsList()
    {
        // DB connection
        $db = Db::getConnection();
        
        // Getting and returning results
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
     * Deletes a product with the specified id
     * @param integer $id <p>product id</p>
     * @return boolean <p>Method execution result</p>
     */
    public static function deleteProductById($id)
    {
        // DB connection
        $db = Db::getConnection();
        
        // DB query text
        $sql = 'DELETE FROM product WHERE id = :id';
        
        // Getting and returning results. Prepare Request Used
        $result = $db->prepare($sql);
        $result->bindParam(":id", $id, PDO::PARAM_INT);
        return $result->execute();
    }
    
    /**
     * Adds a new product
     * @param array $options <p>Array with product information</p>
     * @return integer <p>id added to the record table</p>
     */
    public static function createProduct($options)
    {
        // DB connection
        $db = Db::getConnection();
        
        // DB query text
        $sql = 'INSERT INTO product '
                . '(name, code, price, category_id, sub_category_id, brand, availability, '
                . 'description, is_new, is_featured, status) '
                . 'VALUES '
                . '(:name, :code, :price, :category_id, :subcategory_id, :brand, :availability,'
                . ':description, :is_new, :is_featured, :status)';
        
        // Getting and returnring results. Prepare Request Used
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
            // If the request is completed successfully, return the id of the added record
            return $db->lastInsertId();
        }
        // Otherwise return 0
        return 0;
    }
    
    /**
     * Edits a product with a given id
     * @param integer $id <p>product id</p>
     * @param array $options <p>Array with product information</p>
     * @return boolean <p>Method execution result</p>
     */
    public static function updateProductById($id, $options)
    {
        // DB connection
        $db = Db::getConnection();
        
        // DB query text
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
        
        // Getting and returning results. Prepare Request Used
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
    
    /**
     * Returns a text explanation of the availability of products: <br/>
     * <i>0 - On order, 1 - In stock</i>
     * @param integer $availability <p>Status</p>
     * @return string <p>Text explanation</p>
     */
    public static function getAvailabilityText($availability)
    {
        switch ($availability) {
            case '1':
                return 'In Stock';
                break;
            case '0':
                return 'Under the order';
                break;
        }
    }
    
    /**
     * Returns 
     * @param type $id
     * @return type
     */
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
    
    /**
     * Returns image path
     * @param integer $id
     * @return string <p>Image Path</p>
     */
    public static function getImage($id)
    {
        // Dummy Image Name
        $noImage = 'no-image.jpg';
        
        // The path to the product folder
        $path = '/upload/images/products/';
        
        // The path to the product image
        $pathToProductImage = $path . $id . '.jpg';
        
        if (file_exists($_SERVER['DOCUMENT_ROOT'].$pathToProductImage)) {
            // If image for product exists
            // Return the product image path
            return $pathToProductImage;
        }
        
        // Return the dummy image path
        return $path . $noImage;
    }
}
