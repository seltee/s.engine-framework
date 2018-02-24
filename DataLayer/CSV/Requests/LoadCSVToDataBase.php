<?php
namespace DataLayer\CSV\Requests;

class LoadCSVToDataBase extends \Requests\Dummy {
    protected $fileData = null;
    protected $tableName = "";
    protected $columns = array();

    /**
     * @return mixed
     */
    public function getFileData()
    {
        return $this->fileData;
    }

    /**
     * @param mixed $fileData
     */
    public function setFileData($fileData)
    {
        $this->fileData = $fileData;
    }

    /**
     * @param string $tableName
     */
    public function setTableName($tableName)
    {
        $this->tableName = $tableName;
    }

    /**
     * @return string
     */
    public function getTableName()
    {
        return $this->tableName;
    }

    /**
     * @param array $columns
     */
    public function setColumns($columns)
    {
        $this->columns = $columns;
    }

    /**
     * @return array
     */
    public function getColumns()
    {
        return $this->columns;
    }
}