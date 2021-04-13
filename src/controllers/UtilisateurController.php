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
}