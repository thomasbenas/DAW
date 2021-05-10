<?php

use app\src\controllers\MainController;
use app\src\controllers\ErrorController;

require_once __DIR__.'/vendor/autoload.php'; // autoload des classes et methodes avec composer
define('ROOT', str_replace('index.php','',$_SERVER['SCRIPT_FILENAME'])); // definit le chemin racine ou se trouve la solution
define('FOLDER_ROOT', basename(__DIR__));
define('HOST', $_SERVER['HTTP_HOST']);

// On separe les parametres et on les mets dans le tableau $params
$params = explode('/', $_GET['p']);

if($params[0] !== ""){
    $controller = ucfirst($params[0]);
    $action = $params[1] ?? 'index'; // sauvegarde le deuxieme parametre s'il existe sinon index

    $controllerNameSpace = "\app\src\controllers\\". $controller."Controller";

    if(method_exists($controllerNameSpace, $action)){
        unset($params[0], $params[1]);

        $controller = new $controllerNameSpace();
        call_user_func_array([$controller, $action], $params);
    }
    else{
        $error = new ErrorController();
        $error->error_404();
    }
} else {
    $controller = new MainController();
    $controller->index();
}