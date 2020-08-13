<?php

class Router{
    public function getUrlSegments(){
        return explode('/', trim($_SERVER['REQUEST_URI'], '/'));
    }

    public function run(){
        $urlSegments = $this->getUrlSegments();
        $controllerName = $urlSegments[0] ? ucfirst(array_shift($urlSegments)) . 'Controller' : 'AuthController';
        $actionName = $urlSegments[0] ? strtolower(array_shift($urlSegments)) : 'index';

        $controllerPath =  ROOT . '/app/controllers/' . $controllerName . '.php';

        if (file_exists($controllerPath)){
            include_once $controllerPath;
        }else{
            self::notFound();
        }

        $controller = new $controllerName;
        if (method_exists($controller, $actionName)){
            $controller->$actionName(...$urlSegments);
        }else{
            self::notFound();
        }
    }

    public static function notFound(){
        header('Location: http://'.$_SERVER['HTTP_HOST'].'/errors/notfound');
    }
}