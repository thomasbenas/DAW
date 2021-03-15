<?php

use app\src\controllers\MainController;

require_once __DIR__.'/vendor/autoload.php';
define('ROOT', str_replace('index.php','',$_SERVER['SCRIPT_FILENAME']));

// On sèpare les paramètres et on les dans le tableau $params
$params = explode('/', $_GET['p']);

if($params[0] !== ""){
    $controller = ucfirst($params[0]);
    $action = $params[1] ?? 'index'; // sauvegarde le deuxième parametre s'il existe sinon index

    $controllerNameSpace = "\app\src\controllers\\". $controller."Controller";

    if(method_exists($controllerNameSpace, $action)){
        unset($params[0], $params[1]);

        $controller = new $controllerNameSpace();
        call_user_func_array([$controller, $action], $params);
    }
    else{
        http_response_code(404);
        echo "La page recherchée n'existe pas";
    }
} else {
    $controller = new MainController();
    $controller->index();
}