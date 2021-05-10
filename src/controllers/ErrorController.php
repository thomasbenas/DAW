<?php

namespace app\src\controllers;

use app\src\core\controller;

/**
 * ErrorController
 */
class ErrorController extends Controller
{
    public function Error_404(){
        $this->render('error', '404', []);
    }

    public function Error_403($message){
        $this->render('error', '403', [
            'message' => $message,
        ]);
    }
}