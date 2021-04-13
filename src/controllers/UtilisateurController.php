<?php

namespace app\src\controllers;

use app\src\core\controller;

/**
 * UserController
 */
class UtilisateurController extends Controller
{
    public function connexion(){
        $this->render('utilisateur', 'connexion', [
            'utilisateur' => $this,
        ]);
    }

    public function rejoindre(){
        $this->render('utilisateur', 'rejoindre', [
            'utilisateur' => $this,
        ]);
    }

    public function UserRegistration($pseudo, $password, $mail){
        $model = "user";
        $this->loadModel($model);
        $this->$model->Inscription($pseudo, $password, $mail);
    }

    //TODO
    /**
     * UserConnexion($pseudo, $password)
     * Vérifier les doublons, gestion des exceptions, etc...
     * htmlspecialchars
     */

}