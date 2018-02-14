<?php
namespace DataLayer\Gallery\DataSource\MySQL;

class GetImageCount extends \Engine\MYSQLiDataSource
{
    protected function CheckRequest($request)
    {
        return true;
    }

    protected function GetRequestString(){
        return "SELECT COUNT(*) FROM gallery";
    }

    protected function GetDataArray($request){
        return array();
    }

    public function GetData($data)
    {
        return $data[0]['COUNT(*)'];
    }
}