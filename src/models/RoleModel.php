<?php

namespace app\src\models;

use app\src\core\Model;

/**
 * TestModel
 */
class RoleModel extends Model
{

    public function __construct()
    {
        parent::__construct();
        $this->table = "roles";
        $this->connection();
    }
}