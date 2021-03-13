<?php

define('ROOT', str_replace('index.php','',$_SERVER['SCRIPT_FILENAME']));

require_once(ROOT.'app/Model.php');
require_once(ROOT.'app/Controller.php');

// On sèpare les paramètres et on les dans le tableau $params
$params = explode('/', $_GET['p']);

if($params[0] !== ""){
    $controller = ucfirst($params[0]);
    $action = $params[1] ?? 'index'; // sauvegarde le deuxième parametre s'il existe sinon index

    require_once(ROOT.'controllers/'.$controller.'.php');
    $controller = new $controller();

    if(method_exists($controller, $action))
        $controller->$action();
    else{
        http_response_code(404);
        echo "La page recherchée n'existe pas";
    }
} else {
    require_once(ROOT.'controllers/Main.php');
    $controller = new Main();
    $controller->index();
}