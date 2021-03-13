<?php


namespace app\models;


use app\core\Model;

class Test extends Model
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