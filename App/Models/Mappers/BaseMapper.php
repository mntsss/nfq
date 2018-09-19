<?php

namespace App\Models\Mappers;
use App\Core\Database\IDatabase;

abstract class BaseMapper
{
    protected $gateway;
    protected $dataTable;

    protected $objectStore;

    protected $sortField;
    protected $sortDirection;

    protected $pageNumber;
    protected $pageLimit;

    protected $current_time;

    function __construct(IDatabase $gateway)
    {
        $this->gateway = $gateway;
        $this->current_time = date("Y-m-d H:i:s");
    }

    public function getGateway(){
        return $this->gateway;
    }


    public function count(){
        return $this->gateway->count($this->dataTable);
    }

    public function findById($id)
    {
      $where = array('id' => $id);
      $table = $this->dataTable;
      $orderByField = $this->sortField;
      $boolOperator = " AND ";
      $orderDirection = $this->sortDirection;
      $pageNumber = $this->pageNumber;
      $pageLimit = $this->pageLimit;
      $selectParams = compact('table', 'where', 'boolOperator', 'orderByField', 'orderDirection', 'pageNumber', 'pageLimit');

      $this->gateway->select($selectParams);

        if (!$row = $this->gateway->fetch()) {
            return null;
        }

        return $this->mapObject($row);
    }

    public function findAll(array $params = array())
    {
        $objects = array();

        $table = $this->dataTable;
        $orderByField = $this->sortField;
        $boolOperator = " AND ";
        $orderDirection = $this->sortDirection;
        $pageNumber = $this->pageNumber;
        $pageLimit = $this->pageLimit;
        $where = $params;
        // select params: ($table, $where, $boolOperator = " AND ", $orderByField, $pageNumber, $pageLimit)

        $selectParams = compact('table', 'where', 'boolOperator', 'orderByField', 'orderDirection', 'pageNumber', 'pageLimit');
        $this->gateway->select($selectParams);
        $rows = $this->gateway->fetchAll();

        if ($rows) {
            foreach ($rows as $row) {
                $objects[] = $this->mapObject($row);
            }
        }

        return $objects;
    }

    public function paginate($page = 1, $perPage = 15)
    {
        $this->pageNumber = $page;
        $this->pageLimit = $perPage;
        return $this;
    }

    public function sort($field, $direction){
      $this->sortField = $field;
      $this->sortDirection = $direction;
      return $this;
    }

    abstract protected function mapObject(array $row);

}
