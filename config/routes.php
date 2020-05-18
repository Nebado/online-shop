<?php

return array(
    
    // Catalog
    'catalog/category-([0-9]+)-([0-9]+)/page-([0-9]+)' => 'catalog/subCategory/$1/$2/$3', // actionSubCategory in CatalogController
    'catalog/category-([0-9]+)/page-([0-9]+)' => 'catalog/category/$1/$2', // actionCategory in CatalogController
    'catalog/category-([0-9]+)-([0-9]+)' => 'catalog/subCategory/$1/$2', // actionSubCategory in CatalogController
    'catalog/category-([0-9]+)' => 'catalog/category/$1', // actionCategory in CatalogController
    // Product
    'product/([0-9]+)' => 'product/view/$1', // actionView in ProductController
    // Cart
    'cart/checkout' => 'cart/checkout', // actionCheckout in CartController
    'cart/add/([0-9])' => 'cart/add/$1', // actionAdd in CartController
    'cart/addAjax/([0-9]+)' => 'cart/addAjax/$1', // actionAddAjax in CartController
    'cart/deleteProduct/([0-9]+)' => 'cart/deleteProduct/$1', // actionDeleteProduct in CarController
    'cart/delete/([0-9])' => 'cart/delete/$1', // actionDelete in CartController
    'cart' => 'cart/index', // actionIndex in CartController
    // User
    'register' => 'user/register', // actionRegister in UserController
    'login' => 'user/login', // actionLogin in UserController
    'logout' => 'user/logout', // actionLogout in UserController
    
    '' => 'site/index' // actionIndex in SiteController
);

