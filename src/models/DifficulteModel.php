<?php

namespace app\src\models;

use app\src\core\Model;

/**
 * DifficulteModel
 */
class DifficulteModel extends Model
{

    public function __construct()
    {
        parent::__construct();
        $this->table = "difficulties";
        $this->connection();
    }
    
}