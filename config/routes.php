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
    'cart/add/([0-9])' => 'cart/add/$1', // actionAdd in CartController
    'cart' => 'cart/index', // actionIndex in CartController
    // User
    'register' => 'user/register', // actionRegister in UserController
    'login' => 'user/login', // actionLogin in UserController
    'logout' => 'user/logout', // actionLogout in UserController
    
    '' => 'site/index' // actionIndex in SiteController
);

