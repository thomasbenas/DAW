<?php

namespace app\src\core;

use app\src\models;

/**
 * Représente un Controller 
 */
abstract class Controller
{

    
    /**
     * loadModel permet de charger un modèle de données
     *
     * @param  mixed $model le modèle à charger
     * @return void
     */
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