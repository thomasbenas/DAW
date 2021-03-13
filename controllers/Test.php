<?php

namespace app\controllers;

use app\core\controller;

class Test extends Controller
{

    public function index(){
        $model = "test";
        $this->loadModel($model);
        $tests = $this->$model->getOne();
        
        echo '<pre>';
        var_dump($tests);
        echo '</pre>';
    }
}