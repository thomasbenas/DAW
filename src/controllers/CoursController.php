<?php

namespace app\src\controllers;

use app\src\core\controller;

/**
 * CoursController
 */
class CoursController extends Controller
{

    public function index(){
    $this->render('cours', 'index', []);
        /*$this->loadModel($model);
        $tests = $this->$model->getAll();
        
        $this->render('cours', 'index', [
            'courses' => $courses,
        ]);*/
    }

    public function voir(string $slug){
        $model = "cours";
        /*$this->loadModel($model);
        $courses = $this->$model->findBySlug($slug);

        $this->render('cours', 'voir', [
            'courses' => $courses,
        ]);*/
    }
}
