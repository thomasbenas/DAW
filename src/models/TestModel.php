<?php

namespace app\src\models;

use app\src\core\Model;

/**
 * TestModel
 */
class TestModel extends Model
{

    public function __construct()
    {
        parent::__construct();
        $this->table = "test";
        $this->connection();
    }
    
}