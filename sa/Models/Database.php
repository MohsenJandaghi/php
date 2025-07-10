<?php 

namespace Models;

use PDO;
use ReflectionClass;
use ReflectionException;

class Database
{
    private $model;
    private $tableName="";
    private $isUsedWhere = false;
    private $connectionInstance = null;
    private $selectQuery="SELECT * FROM";

    private $dbName = "";
    private $servername = "";
    private $username = "";
    private $password = "";

    /**
     * @throws ReflectionException
     */
    public function __construct($class)
    {
        $this->servername = SERVERNAME;
        $this->username = USERNAME;
        $this->password = PASSWORD;
        $this->dbName = DBNAME;
        
        $this->model = $class;
        $class=(new ReflectionClass($class))->getShortName();
        $this->tableName = strtolower($class)."s";
        $this->selectQuery .= " $this->tableName";
    }

    public function get ()
    {
        $statement = $this->connection->prepare($this->selectQuery);
        $statement->execute();
    
        $statement->setFetchMode(PDO::FETCH_ASSOC);
        $result = $statement->fetchAll();

        $model = $this->model;

        $newResult = [];
        foreach($result as $item)
            $newResult [] = new $model($item);
        
        return $newResult;
    }

    public function count ()
    {
        $statement = $this->connection->prepare($this->selectQuery);
        $statement->execute();

        $statement->setFetchMode(PDO::FETCH_ASSOC);
        $result = $statement->fetchAll();
        return count($result);
    }

    public function where ($condition)
    {
        if(!$this->isUsedWhere) {
            $this->selectQuery .= " WHERE";
            $this->isUsedWhere = true;
        } else {
            $this->selectQuery .= " AND ";
        }
        $this->selectQuery .= "  $condition[0] $condition[1] '$condition[2]'";
        return $this;
    }


    public function whereIn($item){
        // گاهی اوقات ممکن است فارینکی و و جدولی که به ان متصل است دارای یک نام ستون باشند بنابریان من از ایف یک خطی استفاده کرد.
        $this->selectQuery .= " WHERE $item[0] IN (SELECT " . ((count($item) > 2) ? $item[1] : $item[0]) . " FROM " . ((count($item) > 2) ? $item[2] : $item[1]).")";
        $this->isUsedWhere = true;
        return $this;
    }

    public function create ($values)
    {
        $keysQuery = "(".implode(', ', array_keys($values)).")";
        $valuesQuery = "(:".implode(', :', array_keys($values)).")";
        $statement = $this->connection->prepare("INSERT INTO $this->tableName $keysQuery VALUES $valuesQuery");
        $statement->execute($values);
        return $this->connection->lastInsertId();
    }

    private function getConnection ()
    {
        try {
            return new PDO ("mysql:host={$this->servername};dbname={$this->dbName}", $this->username, $this->password, [
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
            ]);
        } catch (\Exception $e) {
            var_dump($e);
        }
    }

    public function __get($name)
    {
        if($name == "connection") {
            if($this->connectionInstance)
                return $this->connectionInstance;
            
            $this->connectionInstance = $this->getConnection();
            return $this->connectionInstance;
        }
        return null;
    }
}