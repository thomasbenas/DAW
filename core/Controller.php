<?php

namespace app\core;

use app\models;

abstract class Controller
{

    public function loadModel(string $model) :void
    {
        $modelNameSpace = "\app\models\\". $model;
        $this->$model = new $modelNameSpace();
    }

}