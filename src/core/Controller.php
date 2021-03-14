<?php

namespace app\src\core;

use app\src\models;

abstract class Controller
{

    public function loadModel(string $model) :void
    {
        $modelNameSpace = "\app\src\models\\". $model."Model";
        $this->$model = new $modelNameSpace();
    }

}