<?php
namespace DataLayer\Misc\DataSource\MySQL;

class GetTables extends \Engine\MYSQLiDataSource
{
    protected function CheckRequest($request)
    {
        return true;
    }

    protected function GetRequestString(){
        return "SHOW TABLES";
    }

    protected function GetDataArray($request){
        return array();
    }

    public function GetData($data){
        $tables = array();
        $key = "Tables_in_".SQL_DB;
        foreach ($data as $value){
            $tables[] = $value[$key];
        }
        return array_reverse($tables);
    }


}