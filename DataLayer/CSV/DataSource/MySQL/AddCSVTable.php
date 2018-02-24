<?php
namespace DataLayer\CSV\DataSource\MySQL;

class AddCSVTable extends \Engine\MYSQLiDataSourceReq
{
    protected function CheckRequest($request)
    {
        if (!($request instanceof \DataLayer\CSV\Requests\AddCSVTable)){
            return false;
        }

        if (count($request->getColumns())){
            $this->columnsString = ', '.join(', ', $request->getColumns());
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
        return "CREATE TABLE `".$this->tableName."` ( 
                `ID` INT NOT NULL AUTO_INCREMENT ".$this->columnsString." ,
                PRIMARY KEY (`ID`)
                ) ENGINE = InnoDB CHARSET=UTF8;";
    }

    protected function GetDataArray($request){
        return array(
        );
    }

    protected $columnsString = "";
}