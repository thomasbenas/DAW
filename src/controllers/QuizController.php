<?php

namespace app\src\controllers;

use app\src\core\controller;

/**
 * QuizController
 */
class QuizController extends Controller
{
    use userVerificationTrait;

    public function index(){
        $this->isConnectedUser();

        $model = "quiz";
        $this->loadModel($model);
        $quizs = $this->$model->getAllByCategoryName();

        if(!empty($_SESSION['id'])){
            $id_user =  $_SESSION['id'];
            $abilty = $this->$model->getUserAbility($id_user);

            $this->render('quiz', 'index', [
                'quizs'=>$quizs,
                'ability' => $abilty,
                "ability" => (!empty($abilty)) ? $abilty : "Inconnu",
            ]);
        }
        
    }

    public function voir(string $slug){
        $this->isConnectedUser();

        $model = "quiz";
        $this->loadModel($model);
        $quizs = $this->$model->getAllByCategoryNameSlug($slug);
        
        $this->render('quiz', 'voir', [
            'quizs'=>$quizs,
            'quizProcess'=>$this,
        ]);
    }

    public function updateAbilityUser($score, $categoryId){
        $model = "quiz";
        $this->loadModel($model);
        
        $userId = $_SESSION['id'];
    
        if($score <= 4)
                $newDifficulty = 1;
        else if($score <= 7)
                $newDifficulty = 2;
        else
                $newDifficulty = 3;

        $quizs = $this->$model->updateAbilityUser($newDifficulty, $userId, $categoryId);
    }
}