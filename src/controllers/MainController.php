<?php

namespace app\src\controllers;

use app\src\core\controller;

/**
 * MainController
 */
class MainController extends Controller
{
	public function index(){
		$courses=NULL;
		if (isset($_SESSION['username'])){
			$model = "cours";
			$this->loadModel($model);
			$courses = $this->$model->getRecommendations($_SESSION['id']); 
		}
		$this->render('main', 'index', [
			'courses' => $courses,
		]);
    }
}