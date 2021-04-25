<?php

namespace app\src\models;

use app\src\core\Model;

/**
 * CategorieModel
 */
class CategorieModel extends Model
{

    public function __construct()
    {
        parent::__construct();
        $this->table = "categories";
        $this->connection();
    }
    
}