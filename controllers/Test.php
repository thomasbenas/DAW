<?php

namespace app\controllers;

use app\core\controller;

class Test extends Controller
{

    public function index(){
        $this->loadModel("Test");
        $tests = $this->Test->getAll();
        var_dump($tests);
    }
}