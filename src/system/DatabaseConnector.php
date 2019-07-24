<?php

namespace Src\system;

use PDOException;
use PDO;

class DatabaseConnector{
    private $dbconnection = null;

    public function __construct()
    {
        $host = getenv('DB_HOST');
        $port = getenv('DB_PORT');
        $db   = getenv('DB_DATABASE');
        $user = getenv('DB_USERNAME');
        $pass = getenv('DB_PASSWORD');

        try{
            $this->dbconnection = new PDO("mysql:host=$host;port:$port;
            charset=utf8mb4;dbname=$db",$user,$pass);
        }catch(PDOException $e){
            exit($e->getMessage());
        }
    }

    public function getConnetion()
    {
        return $this->dbconnection;
    }
}
