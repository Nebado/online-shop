<?php

/**
 * Db class
 * Component for working with a database
 */
class Db
{
    /**
     * Establishes a database connection
     * @return \ PDO <p>Object of the PDO class for working with the database</p>
     */
    public static function getConnection()
    {
        // Get the connection parameters from the file
        $paramsPath = ROOT . '/config/db_params.php';
        $params = include($paramsPath);
        
        // Establish a connection
        $dsn = "mysql:host={$params['host']};dbname={$params['dbname']}";
        $db = new PDO($dsn, $params['user'], $params['password']);
        
        // Set the charset
        $db->exec("set names utf8");
        
        // Show PDO errors
         $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        return $db;
    }
}

