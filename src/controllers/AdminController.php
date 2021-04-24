<?php

namespace app\src\controllers;

use app\src\core\controller;

/**
 * AdminController
 */
class AdminController extends Controller
{
    private function isAdmin(){
        $isAdmin = (!empty($_SESSION)) ? $_SESSION['admin'] : false;
        if(!$isAdmin){
            $error = new ErrorController();
            $error->error_403();
        }
    }

    public function index(){
        $this->isAdmin();

        $userModel = "user";
        $this->loadModel($userModel);
        $usersCount = $this->$userModel->count();

        $coursModel = "cours";
        $this->loadModel($coursModel);
        $coursCount = $this->$coursModel->count();

        //TODO modèles pour les catégories et les QCM

        $this->render('admin', 'index', [
            "usersCount" => $usersCount[0],
            "coursCount" => $coursCount[0],
        ]);
    }

}