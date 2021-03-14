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

    public function render(string $folder, string $file, array $data = [])
    {
        extract($data, null);
        require_once(ROOT.'src/views/'.$folder.'/'.$file.'.php');

    }

}