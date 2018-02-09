<?php
namespace DataLayer\Users\DataSource\MySQL;

class GetUsersList extends \Engine\MYSQLiDataSource
{
    protected function CheckRequest($request)
    {
        return $request instanceof \Requests\Dummy;
    }

    protected function GetRequestString(){
        return "SELECT * FROM users";
    }

    protected function GetDataArray($request){
        return array();
    }

    public function GetData($data){
        $out = array();
        if ($data){
            foreach ($data as $key => $value){
                $out[] = array(
                    'Id' => $value['ID'],
                    'Login' => $value['LOGIN'],
                    'Type' => $value['TYPE']
                );
            }
        }
        return $out;
    }
}