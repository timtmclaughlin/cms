<?php

class Init
{
    public function __construct()
    {
        $url = isset($_GET['url']) ? $_GET['url'] : null;
        $url = rtrim($url, '/');
        $url = explode('/', $url);

        if (empty($url[0])) {
            require ROOT . DS . 'application' . DS . 'controllers' . DS . 'index.php';
            $index = new IndexController();
            $index->index();
            return false;
        }

        // Check if page exists
        $file = ROOT . DS . 'application' . DS . 'controllers' . DS . $url[0] . '.php';

        if (file_exists($file)) {
            // If it does, require it, and instantiate it
            require_once $file;
            $controllerName = $url[0] . 'Controller';
            $controller = new $controllerName;

            if (!empty($url[1]) && (method_exists($controller, $url[1]))) {
                // If we have an action in the url and the method exists
                $action = $url[1];
                $controller->$action($url);
            } else {
                $controller->index($url);
            }

        } else {
            // Log an error to user
            echo 'That page does not exist';
        }
    }

    private function init_error($errors)
    {
        require_once ROOT . DS . 'application' . DS . 'controllers' . DS . 'error.php';
        $error = new Error($errors);
        $error->index();
        return false;
    }

}

