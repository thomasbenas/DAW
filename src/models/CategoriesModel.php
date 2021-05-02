<?php

namespace app\src\models;

use app\src\core\Model;

/**
 * CategoriesModel
 */
class CategoriesModel extends Model
{

    public function __construct()
    {
        parent::__construct();
        $this->table = "categories";
        $this->connection();
    }
    
}