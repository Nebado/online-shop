<?php

class Category
{
    
    public static function createCategory($name, $sortOrder, $status)
    {
        // Connect to DB
        $db = Db::getConnection();
        
        // Request string to DB
        $sql = 'INSERT INTO category (name, sort_order, status) '
                . 'VALUES (:name, :sort_order, :status)';
        
        // Get and return results. To use prepare request
        $result = $db->prepare($sql);
        $result->bindParam(":name", $name, PDO::PARAM_STR);
        $result->bindParam(":sort_order", $sortOrder, PDO::PARAM_STR);
        $result->bindParam(":status", $status, PDO::PARAM_STR);
        if ($result->execute()) {
            return $db->lastInsertId();
        }
        return 0;
    }
    
    public static function getCategoryById($id)
    {
        if ($id) {
            $db = Db::getConnection();
            
            $sql = "SELECT * FROM category WHERE id = :id";
            $result = $db->prepare($sql);
            $result->bindParam(":id", $id, PDO::PARAM_INT);
            $result->execute();
            
            return $result->fetch();
        }
    }
    
    public static function updateCategoryById($id, $name, $sortOrder, $status)
    {
        // Connect to DB
        $db = Db::getConnection();
        
        // Request string to DB
        $sql = "UPDATE category SET name = :name, sort_order = :sortOrder, status = :status "
                . "WHERE id = :id";
        
        // Get and return results. To use prepare request
        $result = $db->prepare($sql);
        $result->bindParam(":id", $id, PDO::PARAM_INT);
        $result->bindParam(":name", $name, PDO::PARAM_STR);
        $result->bindParam(":sortOrder", $sortOrder, PDO::PARAM_STR);
        $result->bindParam(":status", $status, PDO::PARAM_INT);
        return $result->execute();
    }
    
    public static function deleteCategoryById($id)
    {
        // Connect to DB
        $db = Db::getConnection();
        
        // Request string from DB
        $sql = 'DELETE FROM category WHERE id = :id';
        
        // Get and return results. Use prepare request
        $result = $db->prepare($sql);
        $result->bindParam(":id", $id, PDO::PARAM_INT);
        return $result->execute();
    }
    
    public static function getCategoriesList()
    {
        // Create empty array for categories list
        $categoryList = array();
        // Connect to DB
        $db = Db::getConnection();
        
        // Make request string
        $sql = 'SELECT id, name FROM category '
                . 'WHERE status="1" '
                . 'ORDER BY sort_order ASC';
        $result = $db->query($sql);
        
        // Get and return array
        $i = 0;
        while ($row = $result->fetch()) {
            $categoryList[$i]['id'] = $row['id'];
            $categoryList[$i]['name'] = $row['name'];
            $i++;
        }
        return $categoryList;
    }
    
    public static function getSubCategoriesList($category_id = false)
    {
        $category_id = intval($category_id);

        if ($category_id) {
            // Create empty array for categories list
            $subCategoryList = array();
            // Connect to DB
            $db = Db::getConnection();
            
            // Make request string
            $sql = 'SELECT id, name, category_id FROM sub_category '
                    . 'WHERE status="1" AND category_id="'.$category_id.'"'
                    . 'ORDER BY sort_order ASC';
            $result = $db->query($sql);
            
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
        return false;
    }
    
    public static function getCategoriesListAdmin()
    {
        // Create empty array for categories list
        $categoryList = array();
        // Connect to DB
        $db = Db::getConnection();
        
        // Make request string
        $sql = 'SELECT id, name, sort_order, status FROM category ORDER BY sort_order ASC';
        $result = $db->query($sql);
        
        // Get and return array
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

