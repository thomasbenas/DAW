<?php


namespace app\core;

use app\libraries\DotEnv;

abstract class Model
{
    private string $host;
    private string $username;
    private string $password;

    protected \PDO $connection;

    public string $table;
    public string $id;

    public function __construct()
    {
        (new DotEnv(__DIR__ . '/.env'))->load();

        $this->host = getenv('database_dns');
        $this->username = getenv('database_user');
        $this->password = getenv('database_password');
    }

    public function connection() : void
    {
        try {
            $this->connection = new \PDO($this->host, $this->username, $this->password);
            $this->connection->exec("SET NAMES utf8");
        }catch (\PDOException $e){
            echo "Error : " . $e->getMessage();
        }
    }

    public function getOne() : mixed
    {
        $sql = "SELECT * FROM " . $this->table . "WHERE id =" . $this->id;
        $query = $this->connection->prepare($sql);
        $query->execute();
        return $query->fetch();
    }

    public function getAll() : mixed
    {
        $sql = "SELECT * FROM " . $this->table;
        $query = $this->connection->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

}