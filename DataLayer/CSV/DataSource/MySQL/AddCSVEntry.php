<?php
namespace DataLayer\CSV\DataSource\MySQL;

class AddCSVEntry extends \Engine\MYSQLiDataSource
{
    protected function CheckRequest($request)
    {
        if (!($request instanceof \DataLayer\CSV\Requests\AddCSVEntry)){
            return false;
        }

        if (count($request->getRow())){
            $this->columnsString = array();
            $this->valuesString = array();
            $this->valuesArray = array();

            foreach ($request->getRow() as $key => $value){
                $this->columnsString[] = strtoupper($key);
                $this->valuesString[] = ':'.strtolower($key);
                $this->valuesArray[':'.strtolower($key)] = $value;
            }
        }else{
            return false;
        }

        if (strlen($request->getTableName()) == 0){
            return false;
        }

        $this->tableName = $request->getTableName();
        return true;
    }

    protected function GetRequestString(){
        return "INSERT INTO `".$this->tableName."` 
                (".join(", ", $this->columnsString).")
                VALUES
                (".join(", ", $this->valuesString).");";
    }

    protected function GetDataArray($request){
        return $this->valuesArray;
    }

    protected $columnsString = array();
    protected $valuesString = array();
    protected $valuesArray = array();
}