<?php
namespace DataLayer\Users\DataSource\MySQL;

class GetUsersCount extends \Engine\MYSQLiDataSource
{
    protected function CheckRequest($request)
    {
        return true;
    }

    protected function GetRequestString(){
        return "SELECT COUNT(*) FROM users";
    }

    protected function GetDataArray($request){
        return array();
    }

    public function GetData($data){
        return $data[0]['COUNT(*)'];
    }
}