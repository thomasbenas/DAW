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

    public function UserRegistration($username, $password, $mail){
        $model = "user";
        $this->loadModel($model);
        try {
            $this->$model->Inscription($username, $password, $mail);
            $this->UserSetup($model, $username);
        } catch (\PDOException  $e) {
            $_GET['error'] = "Le nom d'utilisateur ou le mail est déjà utilisé.";
        }
    }

    private function UserSetup($model, $username){
        $this->loadModel($model);
        $userData = $this->$model->getUserByUsername($username);
        $this->$model->hydrate($userData);

        foreach($userData as $key => $value)
        {
            $method = 'get'.ucfirst($key);
            $_SESSION[$key] = $this->$model->$method();
        }
    }

    //TODO
    /**
     * UserConnexion($pseudo, $password)
     * Vérifier les doublons, gestion des exceptions, etc...
     * htmlspecialchars
     */

}