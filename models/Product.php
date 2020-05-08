<?php

class Product
{
    const SHOW_BY_DEFAULT = 10;
    
    /**
     * Returns an array with products in current category
     * @type array
     */
    public static function getProductsListInCategory($count = self::SHOW_BY_DEFAULT, $categoryId)
    {
        $categoryId = intval($categoryId);
        
        if ($categoryId) {
            $db = Db::getConnection();
            
            $products = array();
            
            $sql = "SELECT id, name, code, price, title, category_id, sub_category_id,"
                    . "availability, is_recommended, is_new, image FROM product "
                    . "WHERE status='1' AND category_id=:categoryId "
                    . "ORDER BY id DESC "
                    . "LIMIT ".$count;
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
                $products[$i]['category_id'] = $row['category_id'];
                $products[$i]['sub_category_id'] = $row['sub_category_id'];
                $products[$i]['availability'] = $row['availability'];
                $products[$i]['is_recommended'] = $row['is_recommended'];
                $products[$i]['is_new'] = $row['is_new'];
                $products[$i]['image'] = $row['image'];
                $i++;
            }
            
            return $products;
        }
    }
}