<?php


namespace app\src\models;


use app\src\core\Model;

class TestModel extends Model
{

    /**
     * Test constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->table = "test";
        $this->connection();
    }
}