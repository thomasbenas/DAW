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

        ob_start();
        require_once(ROOT.'src/views/'.$folder.'/'.$file.'.php');
        $content = ob_get_clean();
        require_once(ROOT.'src/views/layout/base.php');

    }

}