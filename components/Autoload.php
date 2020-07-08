<?php

/**
 * __Autoload function for automatically connecting classes
 */

spl_autoload_register('myAutoloader');

function myAutoloader($class_name)
{
    // Array of folders where necessary classes can be found
    $array_paths = array(
        '/components/',
        '/models/',
        '/controllers/',
    );
    
    // Go through the folder array
    foreach ($array_paths as $path) {
        
        // Form the name and path to the file with the class
        $path = ROOT . $path . $class_name . '.php';
        
        // If such a file exists, include it
        if (is_file($path)) {
            include_once $path;
        }
    }
}

