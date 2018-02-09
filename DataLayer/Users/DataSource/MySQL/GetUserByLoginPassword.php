<?php
namespace DataLayer\Users\DataSource\MySQL;

class GetUserByLoginPassword extends \Engine\MYSQLiDataSource
{
    protected function CheckRequest($request)
    {
        return $request instanceof \DataLayer\Users\Requests\Login;
    }

    protected function GetRequestString(){
        return "SELECT * FROM users WHERE LOGIN=:login AND PASSWORD=:password";
    }

    protected function GetDataArray($request){
        return array(
            ":login" => $request->GetLogin(),
            ":password" => crypt($request->GetPassword(), PASS_SALT)
        );
    }

    public function GetData($data){
        if ($data && count($data)){
            return array(
                'Id' => $data[0]["ID"],
                'Login' => $data[0]["LOGIN"],
                'Type' => $data[0]["TYPE"]
            );
        }else{
            return null;
        }
    }
}