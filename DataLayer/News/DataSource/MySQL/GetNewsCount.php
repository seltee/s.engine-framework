<?php
namespace DataLayer\News\DataSource\MySQL;

class GetNewsCount extends \Engine\MYSQLiDataSource
{
    protected function CheckRequest($request)
    {
        return true;
    }

    protected function GetRequestString(){
        return "SELECT COUNT(*) FROM news";
    }

    protected function GetDataArray($request){
        return array();
    }

    public function GetData($data)
    {
        return $data[0]['COUNT(*)'];
    }
}