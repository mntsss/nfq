<?php

namespace App\Core\Database;

/**
 *
 */
interface IDatabase
{
    public function connect();

    public function prepare($query, array $params = array());

    public function execute(array $params = array());

    public function fetch();
    public function fetchAll();

    public function select($selectParams);
    public function insert($table, array $params);
    public function update($table, array $params, $where = "");
    public function delete($table, $where = "");

}
