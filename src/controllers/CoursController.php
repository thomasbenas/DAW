<?php

namespace app\src\controllers;

use app\src\core\controller;

/**
 * CoursController
 */
class CoursController extends Controller
{

    public function index(){
        $model = "cours";
        $this->loadModel($model);
        $courses = $this->$model->getAll(); 
        $this->render('cours', 'index', [
            'courses' => $courses,
        ]);
    }

    public function voir(string $slug){
        $model = "cours";
        $this->loadModel($model);
        $courses = $this->$model->findBySlug($slug);
        //Récupération de tout les chapitres
        $chapitres = $this->$model->getAllChapitre($slug);
        $this->render('cours', 'voir', [
            'courses' => $courses,
            'chapitres' => $chapitres,
        ]);
    }
    public function chapter(string $slug){
        $model = "cours";
        $this->loadModel($model);
        $chapitre = $this->$model->getChapitreBySlug($slug);
        $chapitreSuivant = $this->$model->getChapitreNumber($chapitre['ch_number']+1, $chapitre['lesson']);
        $chapitrePrecedent = $this->$model->getChapitreNumber($chapitre['ch_number']-1, $chapitre['lesson']);
        $chapitres = $this->$model->getAllChapitreLesson($chapitre['lesson']);
        $this->render('cours', 'chapter', [
            'chapitre' => $chapitre,
            'chapitreSuivant' => $chapitreSuivant,
            'chapitrePrecedent' => $chapitrePrecedent,
            'chapitres' => $chapitres,
        ]);
    }
}
