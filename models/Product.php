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
}