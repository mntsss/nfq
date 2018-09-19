<?php

namespace App\Core\Database;

/**
 *
 */
class PDOGateway implements IDatabase
{
    private $database_name = "nfq";
    private $database_host = "localhost";
    private $database_user = "root";
    private $database_password = '';

    protected $connection = FALSE;
    protected $statement;
    protected $fetchType = \PDO::FETCH_ASSOC;


    function __construct()
    {
        // code...
    }

    public function getStatement() {
        if ($this->statement == null) {
            throw new \PDOException(
              "PDO Statement not found.");
              error_log("PDO Statement not found.", 0);
        }
        return $this->statement;
    }

    public function connect() {

        if ($this->connection) {
            return;
        }

        try {
            $this->connection = new \PDO('mysql:host='.$this->database_host.';dbname='.$this->database_name.';cherset=utf8',$this->database_user, $this->database_password);
            $this->connection->setAttribute(\PDO::ATTR_ERRMODE,\PDO::ERRMODE_EXCEPTION);
            $this->connection->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);
        }
        catch (\PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function prepare($query, array $params = array()) {
        $this->connect();
        try {
            $this->statement = $this->connection->prepare($query,
                $params);
            return $this;
        }
        catch (\PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function count($table, array $where = array()){
        if ($where) {
            $params = array();
            foreach ($where as $col => $value) {
                unset($where[$col]);
                $where[":" . $col] = $value;
                $params[] = $col . " = :" . $col;
            }
        }
        $query = "SELECT COUNT(*) FROM ". $table
        . (($where) ? " WHERE ". implode(" AND ", $params) : " ");
        $this->prepare($query)->execute($where);
        return $this->getStatement()->fetchColumn();
    }

    public function execute(array $params = array()) {
        try {
            $this->getStatement()->execute($params);
            return $this;
        }
        catch (\PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function countAffectedRows() {
        try {
            return $this->getStatement()->rowCount();
        }
        catch (\PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function getLastInsertId($name = null) {
        $this->connect();
        return $this->connection->lastInsertId($name);
    }

    public function fetch($fetchType = null) {
        if ($fetchType === null) {
            $fetchType = $this->fetchType;
        }

        try {
            return $this->getStatement()->fetch($fetchType);
        }
        catch (\PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function fetchAll($fetchType = null) {
        if ($fetchType === null) {
            $fetchType = $this->fetchType;
        }

        try {
            return $this->getStatement()->fetchAll($fetchType);
        }
        catch (\PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function select($selectParams) {
      extract($selectParams);

      if(!$boolOperator) $boolOperator = " AND ";

      if($pageLimit && !$pageNumber) $pageNumber = 1;
        if ($where) {
            $params = array();
            foreach ($where as $col => $value) {
                unset($where[$col]);
                $where[":" . $col] = $value;
                $params[] = $col . " = :" . $col;
            }
        }
        $query = "SELECT * FROM " . $table
            . (($where) ? " WHERE ". implode(" " . $boolOperator . " ", $params) : " ")
            .(($orderByField) ? " ORDER BY $orderByField"
            .(($orderByField && $orderDirection) ? " ".$orderDirection : " ASC ") : " ")
            .(($pageNumber && $pageLimit) ? " LIMIT ". $pageLimit ." OFFSET ". ($pageNumber-1)*$pageLimit : " ");
        $this->prepare($query)->execute($where);
        return $this;
    }

    public function search($selectParams) {
      extract($selectParams);

      if(!$boolOperator) $boolOperator = " AND ";

      if($pageLimit && !$pageNumber) $pageNumber = 1;
        if ($where) {

            $params = array();
            foreach ($where as $col => $value) {
                unset($where[$col]);
                $where[":" . $col] = "%".$value."%";
                $params[] = $col . " LIKE :" . $col;
            }
        }
        $query = "SELECT * FROM " . $table
            . (($where) ? " WHERE ". implode(" " . $boolOperator . " ", $params) : " ")
            .(($orderByField) ? " ORDER BY $orderByField"
            .(($orderByField && $orderDirection) ? " ".$orderDirection : " ASC ") : " ")
            .(($pageNumber && $pageLimit) ? " LIMIT ". $pageLimit ." OFFSET ". ($pageNumber-1)*$pageLimit : " ");
        $this->prepare($query)->execute($where);
        return $this;
    }

    public function insert($table, array $params) {
        $cols = implode(", ", array_keys($params));
        $values = implode(", :", array_keys($params));

        foreach ($params as $col => $value) {
            unset($params[$col]);
            $params[":" . $col] = $value;
        }

        $query = "INSERT INTO " . $table. " (" . $cols . ")  VALUES (:" . $values . ")";
        return (int) $this->prepare($query)
            ->execute($params)
            ->getLastInsertId();
    }

    public function update($table, array $params, $where = "") {
        $set = array();
        foreach ($params as $col => $value) {
            unset($params[$col]);
            $bind[":" . $col] = $value;
            $set[] = $col . " = :" . $col;
        }

        $query = "UPDATE " . $table . " SET " . implode(", ", $set). (($where) ? " WHERE " . $where : " ");
        return $this->prepare($query)
            ->execute($bind)
            ->countAffectedRows();
    }

    public function delete($table, $where = "") {
        $query = "DELETE FROM " . $table . (($where) ? " WHERE " . $where : " ");
        return $this->prepare($query)
            ->execute()
            ->countAffectedRows();
    }
}
