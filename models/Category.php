<?php

class Category
{
    
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

