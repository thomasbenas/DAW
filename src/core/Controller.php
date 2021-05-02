<?php

namespace app\src\core;

use app\src\models;

/**
 * Représente un Controller 
 */
abstract class Controller
{
    public function __construct(){
       if(!isset($_SESSION))
            session_start();
    }
    
    /**
     * loadModel permet de charger un modèle de données
     *
     * @param  string $model le modèle à charger
     * @return void
     */
    public function loadModel(string $model) :void
    {
        $modelNameSpace = "\app\src\models\\". $model."Model";
        $this->$model = new $modelNameSpace();
    }

        
    /**
     * render permet d'afficher la vue
     *
     * @param  string $folder le dossier dans views/ où se trouve le fichier de la vue
     * @param  string $file le fichier .php de la vue
     * @param  string $data les paramèetres que l'on passe à la vue 
     * @return void
     */
    public function render(string $folder, string $file, array $data = [])
    {
        extract($data, null);

        ob_start();
        require_once(ROOT.'src/views/'.$folder.'/'.$file.'.php');
        $content = ob_get_clean();
        require_once(ROOT.'src/views/layout/base.php');

    }
}