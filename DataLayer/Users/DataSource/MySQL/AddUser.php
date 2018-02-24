<?php
namespace DataLayer\Users\DataSource\MySQL;

class AddUser extends \Engine\MYSQLiDataSourceReq
{
    protected function CheckRequest($request)
    {
        if (!($request instanceof \DataLayer\Users\Requests\AddUser)){
            return false;
        }

        if (strlen($request->getPassword()) < 4){
            throw new \Exceptions\DefaultException("Password is too short");
        }

        return true;
    }

    protected function GetRequestString(){
        return "INSERT INTO users (LOGIN, PASSWORD, TYPE) VALUES (:login, :password, :type)";
    }

    protected function GetDataArray($request){
        return array(
            ":login" => $request->GetLogin(),
            ":password" => crypt($request->GetPassword(), PASS_SALT),
            ":type" => $request->GetUserType()
        );
    }

    public function GetData($data){
        return $this->GetConnection()->lastInsertId();
    }
}