<?php

namespace App\config;

class Router
{
    private $router = [
        "/" => "GameController@homePage",
        "/highestForce" => "GameController@highestForce",
        "/highestLevel" => "GameController@highestLevel",
        "/random-combat" => "GameController@randomFight",
        "/api/combatCheck" => "GameController@checkFight",
        "/api/startFight" => "GameController@startFight",
        "/combat" => "GameController@fight",
    ];

    public function dispatch($requestUri)
    {
        foreach ($this->router as $route => $action) {
            if ($route === $requestUri) {
                return $this->executeAction($action);
            }

            if (preg_match("#^$route$#", $requestUri, $matches)) {
                array_shift($matches);
                return $this->executeAction($action, $matches);
            }
        }
        var_dump("La route n'existe pas");
        return false;
    }

    private function executeAction($action, $params = [])
    {
        list($controllerName, $methodName) = explode('@', $action);

        $controllerPath = __DIR__ . '/../controllers/' . $controllerName . '.php';
        if (!file_exists($controllerPath)) {
            var_dump("Le fichier n'existe pas");
            return false;
        }

        $controllerClass = "App\\controllers\\" . $controllerName;
        if (!class_exists($controllerClass)) {
            var_dump("La classe n'existe pas");
            return false;
        }

        $controller = new $controllerClass();
        if (!method_exists($controller, $methodName)) {
            var_dump("La méthode n'existe pas");
            return false;
        }

        if (empty($params)) {
            echo $controller->$methodName();
        } else {
            echo $controller->$methodName(...$params);
        }

        return true;
    }
}
