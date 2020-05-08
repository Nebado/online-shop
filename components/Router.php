<?php

/**
 * Redirect all requests in Controller and action
 */
class Router {
    
    /**
     * Contains array with routes
     * @var array
     */
    private $routes;
    
    /**
     * Get path of file with array of routes
     * And include this file in private property $routes
     */
    public function __construct()
    {
        $routesPath = ROOT . '/config/routes.php';
        $this->routes = include($routesPath);
    }
    
    /**
     * Returns request string
     * @return string
     */
    private function getURI()
    {
        if (!empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }
    
    public function run()
    {
        // Get request string
        $uri = $this->getURI();
        
        // Dissameble array with routes
        foreach ($this->routes as $uriPattern => $path) {
            
            // Compare $uriPattern and $uri
            if (preg_match("~$uriPattern~", $uri)) {
                
                // Get internal route
                $internalRoute = preg_replace("~$uriPattern~", $path, $uri);
                
                // Get controller name, action name, parameters
                $segments = explode('/', $internalRoute);
                
                // ControllerName
                $controllerName = array_shift($segments).'Controller';
                $controllerName = ucfirst($controllerName);
                
                // actionName
                $actionName = 'action'.ucfirst(array_shift($segments));
                
                // Parameters
                $parameters = $segments;
                
                // Connect file of controller
                $controllerFile = ROOT.'/controllers/'.$controllerName.'.php';
                if (is_file($controllerFile)) {
                    require_once($controllerFile);
                }
                
                // Create an object controller and method (action)
                $controllerObject = new $controllerName;
                $result = call_user_func_array(array($controllerObject, $actionName), $parameters);
                
                // Exit from foreach
                if ($result != null) {
                    break;
                }
            }
        }
    }
}

