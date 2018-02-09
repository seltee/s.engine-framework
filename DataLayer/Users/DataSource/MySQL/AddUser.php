<?php
namespace DataLayer\Users\DataSource\MySQL;

class AddUser extends \Engine\MYSQLiDataSourceReq
{
    protected function CheckRequest($request)
    {
        if (!($request instanceof \DataLayer\Users\Requests\AddUser)){
            return false;
        }

        if (strlen($request) < 4){
            throw new \Exceptions\DefaultException("Password is too short");
        }

        return true;
    }

    protected function GetRequestString(){
        return "INSERT INTO users (LOGIN, PASSWORD) VALUES (:login, :password)";
    }

    protected function GetDataArray($request){
        return array(
            ":login" => $request->GetLogin(),
            ":password" => crypt($request->GetPassword(), PASS_SALT)
        );
    }

    public function GetData($data){
        return mysqli_insert_id($this->GetConnection());
    }
}