<?php

/**
 * Class Router
 * Routing component
 */
class Router {
    
    /**
     * Property for storing an array of routes
     * @var array
     */
    private $routes;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $routesPath = ROOT . '/config/routes.php';
        $this->routes = include($routesPath);
    }
    
    /**
     * Returns a request string
     */
    private function getURI()
    {
        if (!empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }
    
    /**
     * Method for processing request
     */
    public function run()
    {
        // Get the request string
        $uri = $this->getURI();
        
        // Check for the presence of such a request in the array of routes (routes.php)
        foreach ($this->routes as $uriPattern => $path) {
            
            // Compare $uriPattern and $uri
            if (preg_match("~$uriPattern~", $uri)) {
                
                // Get the internal path from the external according to the rule.
                $internalRoute = preg_replace("~$uriPattern~", $path, $uri);
                
                // Define controller, action, parameters
                $segments = explode('/', $internalRoute);
                
                $controllerName = array_shift($segments).'Controller';
                $controllerName = ucfirst($controllerName);
                
                $actionName = 'action'.ucfirst(array_shift($segments));
                
                $parameters = $segments;
                
                // Include a controller class file
                $controllerFile = ROOT.'/controllers/'.$controllerName.'.php';
                if (is_file($controllerFile)) {
                    require_once($controllerFile);
                }
                
                // Create an object, call a method (i.e. action)
                $controllerObject = new $controllerName;
                
                /* Call the required method ($actionName) on a specific
                 * class ($controllerObject) with the given ($parameters) parameters
                 */
                $result = call_user_func_array(array($controllerObject, $actionName), $parameters);
                
                // If the controller method is successfully called, shut down the router
                if ($result != null) {
                    break;
                }
            }
        }
    }
}

