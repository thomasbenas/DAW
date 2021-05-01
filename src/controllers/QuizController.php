<?php

namespace app\src\controllers;

use app\src\core\controller;

/**
 * QuizController
 */
class QuizController extends Controller
{

    public function index(){
        //$model = "quiz";
        //$this->loadModel($model);
        //$quizs = $this->$model->getAll();
        
        $this->render('quiz', 'index', []);
    }
}