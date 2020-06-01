<?php

/**
 * Category class - a model for working with product categories
 */
class Category
{
    /**
     * Adds a new category
     * @param string $name <p>Name</p>
     * @param integer $sortOrder <p>Sequence number</p>
     * @param integer $status <p>Status <i> (on "1", off "0")</i> </p>
     * @return boolean <p>The result of adding a record to the table</p>
     */
    public static function createCategory($name, $sortOrder, $status)
    {
        // DB connection
        $db = Db::getConnection();
        
        // DB request
        $sql = 'INSERT INTO category (name, sort_order, status) '
                . 'VALUES (:name, :sort_order, :status)';
        
        // Getting and returning results. Prepared Request Used
        $result = $db->prepare($sql);
        $result->bindParam(":name", $name, PDO::PARAM_STR);
        $result->bindParam(":sort_order", $sortOrder, PDO::PARAM_STR);
        $result->bindParam(":status", $status, PDO::PARAM_STR);
        if ($result->execute()) {
            return $db->lastInsertId();
        }
        return 0;
    }
    
    /**
     * Adds a new subcategory
     * @param string $name <p>Name</p>
     * @param string $categoryId <p>categoryId</p>
     * @param integer $sortOrder <p>Sequence number</p>
     * @param integer $status <p>Status <i> (on "1", off "0")</i> </p>
     * @return boolean <p>The result of adding a record to the table</p>
     */
    public static function createSubCategory($name, $sortOrder, $categoryId, $status)
    {
        // DB connection
        $db = Db::getConnection();
        
        // DB request
        $sql = 'INSERT INTO sub_category (name, sort_order, category_id, status) '
                . 'VALUES (:name, :sort_order, :category_id, :status)';
        
        // Getting and returning results. Prepared Request Used
        $result = $db->prepare($sql);
        $result->bindParam(":name", $name, PDO::PARAM_STR);
        $result->bindParam(":sort_order", $sortOrder, PDO::PARAM_INT);
        $result->bindParam(":category_id", $categoryId, PDO::PARAM_INT);
        $result->bindParam(":status", $status, PDO::PARAM_INT);
        if ($result->execute()) {
            return $db->lastInsertId();
        }
        return 0;
    }
    
    /**
     * Returns the category with the specified id
     * @param integer $id <p>category id</p>
     * @return array <p>An array with category information</p>
     */
    public static function getCategoryById($id)
    {
        // DB connection
        $db = Db::getConnection();

        // DB request
        $sql = "SELECT * FROM category WHERE id = :id";
        
        // Prepared Request Used
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
     * Returns the category with the specified id
     * @param integer $id <p>category id</p>
     * @return array <p>An array with category information</p>
     */
    public static function getSubCategoryById($id)
    {
        // DB connection
        $db = Db::getConnection();

        // DB request
        $sql = "SELECT * FROM sub_category WHERE id = :id";
        
        // Prepared Request Used
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
     * Editing a category with a given id
     * @param integer $id <p> category id </p>
     * @param string $name <p> Name </p>
     * @param integer $sortOrder <p> Sequence number </p>
     * @param integer $status <p> Status <i> (on "1", off "0") </i> </p>
     * @return boolean <p>Method execution result</p>
     */
    public static function updateCategoryById($id, $name, $sortOrder, $status)
    {
        // DB connection
        $db = Db::getConnection();
        
        // DB request
        $sql = "UPDATE category SET name = :name, sort_order = :sortOrder, status = :status "
                . "WHERE id = :id";
        
        // Getting and returning results. Prepared Request Used
        $result = $db->prepare($sql);
        $result->bindParam(":id", $id, PDO::PARAM_INT);
        $result->bindParam(":name", $name, PDO::PARAM_STR);
        $result->bindParam(":sortOrder", $sortOrder, PDO::PARAM_STR);
        $result->bindParam(":status", $status, PDO::PARAM_INT);
        return $result->execute();
    }
    
    /**
     * Editing a category with a given id
     * @param integer $id <p> category id </p>
     * @param string $name <p> Name </p>
     * @param integer $sortOrder <p> Sequence number </p>
     * @param integer $status <p> Status <i> (on "1", off "0") </i> </p>
     * @return boolean <p>Method execution result</p>
     */
    public static function updateSubCategoryById($id, $name, $sortOrder, $categoryId, $status)
    {
        // DB connection
        $db = Db::getConnection();
        
        // DB request
        $sql = "UPDATE sub_category SET name = :name, sort_order = :sortOrder, category_id = :category_id,"
                . " status = :status WHERE id = :id";
        
        // Getting and returning results. Prepared Request Used
        $result = $db->prepare($sql);
        $result->bindParam(":id", $id, PDO::PARAM_INT);
        $result->bindParam(":name", $name, PDO::PARAM_STR);
        $result->bindParam(":sortOrder", $sortOrder, PDO::PARAM_INT);
        $result->bindParam(":category_id", $categoryId, PDO::PARAM_INT);
        $result->bindParam(":status", $status, PDO::PARAM_INT);
        return $result->execute();
    }
    
    /**
     * Removes a category with the given id
     * @param integer $id
     * @return boolean <p>Method execution result</p>
     */
    public static function deleteCategoryById($id)
    {
        // DB connection
        $db = Db::getConnection();
        
        // DB request
        $sql = 'DELETE FROM category WHERE id = :id';
        
        // Getting and returning results. Prepared Request Used
        $result = $db->prepare($sql);
        $result->bindParam(":id", $id, PDO::PARAM_INT);
        return $result->execute();
    }
    
    /**
     * Removes a subcategory with the given id
     * @param integer $id
     * @return boolean <p>Method execution result</p>
     */
    public static function deleteSubCategoryById($id)
    {
        // DB connection
        $db = Db::getConnection();
        
        // DB request
        $sql = 'DELETE FROM sub_category WHERE id = :id';
        
        // Getting and returning results. Prepared Request Used
        $result = $db->prepare($sql);
        $result->bindParam(":id", $id, PDO::PARAM_INT);
        return $result->execute();
    }
    
    /**
     * Returns an array of categories for a list on a site
     * @return array <p>An array with categories</p>
     */
    public static function getCategoriesList()
    {
        // DB connection
        $db = Db::getConnection();
        
        // DB request
        $sql = 'SELECT id, name FROM category '
                . 'WHERE status="1" '
                . 'ORDER BY sort_order ASC';
        $result = $db->query($sql);
        
        // Getting and returning results
        $i = 0;
        $categoryList = array();
        while ($row = $result->fetch()) {
            $categoryList[$i]['id'] = $row['id'];
            $categoryList[$i]['name'] = $row['name'];
            $i++;
        }
        return $categoryList;
    }
    
    public static function getSubCategoriesList($category_id)
    {
        $status = 1;
        // Create empty array for categories list
        $subCategoryList = array();
        // Connect to DB
        $db = Db::getConnection();

        // Make request string
        $sql = 'SELECT id, name, category_id FROM sub_category'
                . ' WHERE status=:status AND category_id=:category_id'
                . ' ORDER BY sort_order ASC';
        
        // Getting and returning results. Prepared Request Used
        $result = $db->prepare($sql);
        $result->bindParam(":status", $status, PDO::PARAM_INT);
        $result->bindParam(":category_id", $category_id, PDO::PARAM_INT);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();

        // Get and return array
        $i = 0;
        while ($row = $result->fetch()) {
            $subCategoryList[$i]['id'] = $row['id'];
            $subCategoryList[$i]['name'] = $row['name'];
            $subCategoryList[$i]['category_id'] = $row['category_id'];
            $i++;
        }
        
        return $subCategoryList;
    }
    
    public static function getSubCategoryName($category_id, $id)
    {
        $status = 1;
        // Connect to DB
        $db = Db::getConnection();

        // Make request string
        $sql = 'SELECT name FROM sub_category'
                . ' WHERE status=:status AND category_id=:category_id AND id=:id' 
                . ' ORDER BY sort_order ASC';
        $result = $db->prepare($sql);
        $result->bindParam(":status", $status, PDO::PARAM_INT);
        $result->bindParam(":category_id", $category_id, PDO::PARAM_INT);
        $result->bindParam(":id", $id, PDO::PARAM_INT);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();

        // Get and return array
        if ($row = $result->fetch()) {
            return $name = $row['name'];
        }
        return false;
    }
    /**
     * Returns an array of categories for a list in the admin panel <br/>
     * (at the same time, on and off categories fall into the result)
     * @return array <p>An array of categories</p>
     */
    public static function getCategoriesListAdmin()
    {        
        // DB connection
        $db = Db::getConnection();
        
        // DB request
        $sql = 'SELECT id, name, sort_order, status FROM category ORDER BY sort_order ASC';
        $result = $db->query($sql);
        
        // Getting and returning results
        $categoryList = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $categoryList[$i]['id'] = $row['id'];
            $categoryList[$i]['name'] = $row['name'];
            $categoryList[$i]['sort_order'] = $row['sort_order'];
            $categoryList[$i]['status'] = $row['status'];
            $i++;
        }
        return $categoryList;
    }
    
    public static function getSubCategoriesListAdmin($category_id = 1)
    {
        $category_id = intval($category_id);

        if ($category_id) {
            // Create empty array for categories list
            $subCategoryList = array();
            // Connect to DB
            $db = Db::getConnection();
            
            // Make request string
            $sql = 'SELECT id, name, category_id, sort_order, status FROM sub_category '
                    . 'WHERE category_id="'.$category_id.'"'
                    . 'ORDER BY sort_order ASC';
            $result = $db->query($sql);
            
            // Get and return array
            $i = 0;
            while ($row = $result->fetch()) {
                $subCategoryList[$i]['id'] = $row['id'];
                $subCategoryList[$i]['name'] = $row['name'];
                $subCategoryList[$i]['category_id'] = $row['category_id'];
                $subCategoryList[$i]['sort_order'] = $row['sort_order'];
                $subCategoryList[$i]['status'] = $row['status'];
                $i++;
            }
            return $subCategoryList;
        }
        return false;
    }
}

