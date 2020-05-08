<?php

class ProductController
{  
    public function actionView($productId)
    {
        
        
        require_once(ROOT . '/views/products/view.php');
        return true;
    }
}

