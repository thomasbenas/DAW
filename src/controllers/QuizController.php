<?php

namespace app\src\controllers;

use app\src\core\controller;

/**
 * QuizController
 */
class QuizController extends Controller
{

    public function index(){
        $model = "quiz";
        $this->loadModel($model);
        $quizs = $this->$model->GetAllByCategoryName();
        
        $this->render('quiz', 'index', [
            'quizs'=>$quizs,
        ]);
    }

    public function voir(string $slug){
        $model = "quiz";
        $this->loadModel($model);
        $quizs = $this->$model->GetAllByCategoryNameSlug($slug);
        
        $this->render('quiz', 'voir', [
            'quizs'=>$quizs,
        ]);
    }
}