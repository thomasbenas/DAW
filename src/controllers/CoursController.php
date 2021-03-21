<?php

namespace app\src\controllers;

use app\src\core\controller;

class CoursController extends Controller
{
    public function index(){
        /*
        $model = "cours"; //nom du modèle
        $this->loadModel($model); //charge le modèle
        $tests = $this->$model->getAll(); //récupère toutes les données de la table "test"*/


        $this->render('cours', 'index', []);
    }
}