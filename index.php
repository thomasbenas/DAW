<?php

use app\controllers\Main;

require_once __DIR__.'/vendor/autoload.php';

// On sèpare les paramètres et on les dans le tableau $params
$params = explode('/', $_GET['p']);

if($params[0] !== ""){
    $controller = ucfirst($params[0]);
    $action = $params[1] ?? 'index'; // sauvegarde le deuxième parametre s'il existe sinon index

    $controllerNameSpace = "\app\controllers\\". $controller;

    if(method_exists($controllerNameSpace, $action)){
        $controller = new $controllerNameSpace();
        $controller->$action();
    }
    else{
        http_response_code(404);
        echo "La page recherchée n'existe pas";
    }
} else {
    $controller = new Main();
    $controller->index();
}