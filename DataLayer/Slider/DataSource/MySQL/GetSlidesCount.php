<?php
namespace DataLayer\Slider\DataSource\MySQL;

class GetSlidesCount extends \Engine\MYSQLiDataSource
{
    protected function CheckRequest($request)
    {
        return true;
    }

    protected function GetRequestString(){
        return "SELECT COUNT(*) FROM slides";
    }

    protected function GetDataArray($request){
        return array();
    }

    public function GetData($data){
        return $data[0]['COUNT(*)'];
    }
}