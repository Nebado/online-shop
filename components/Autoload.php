<?php

function __autoload($class_name)
{
    $paths = array(
        '/components/',
        '/models/'
    );
    
    foreach ($paths as $path) {
        $path = ROOT . $path . $class_name . '.php';
        
        if (file_exists($path)) {
            require_once($path);
        }
    }
}

