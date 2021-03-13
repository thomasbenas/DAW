<?php

use app\controller\Main;

define('ROOT', str_replace('index.php','',$_SERVER['SCRIPT_FILENAME']));

require_once __DIR__.'/vendor/autoload.php';

// On sèpare les paramètres et on les dans le tableau $params
$params = explode('/', $_GET['p']);

if($params[0] !== ""){
    $controller = ucfirst($params[0]);
    $action = $params[1] ?? 'index'; // sauvegarde le deuxième parametre s'il existe sinon index

    $controller = new $controller();

    if(method_exists($controller, $action))
        $controller->$action();
    else{
        http_response_code(404);
        echo "La page recherchée n'existe pas";
    }
} else {
    $controller = new Main();
    $controller->index();
}