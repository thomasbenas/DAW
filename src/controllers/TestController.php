<?php

namespace app\src\controllers;

use app\src\core\controller;

class TestController extends Controller
{

    public function index(){
        $model = "test";
        $this->loadModel($model);
        $tests = $this->$model->getAll();
        
        echo '<pre>';
        var_dump($tests);
        echo '</pre>';
    }
}