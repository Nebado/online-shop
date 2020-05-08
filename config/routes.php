<?php

return array(
    
    'catalog/category-([0-9]+)-([0-9]+)' => 'catalog/subCategory/$1/$2', // actionSubCategory in CatalogController
    
    'catalog/category-([0-9]+)' => 'catalog/category/$1', // actionCategory in CatalogController
    
    'product/([0-9]+)' => 'product/view/$1', // actionView in ProductController
    
    '' => 'site/index' // actionIndex in SiteController
);

