<?php
namespace DataLayer\Users\DataSource\MySQL;

class ChangeUserType extends \Engine\MYSQLiDataSourceReq
{
    protected function CheckRequest($request)
    {
        if (!($request instanceof \DataLayer\Users\Requests\ChangeUserType)){
            return false;
        }

        if ($request->getType() != 'ADM' && $request->getType() != 'USR'){
            throw new \Exceptions\InternalException("Unknown user type");
        }

        return true;
    }

    protected function GetRequestString(){
        return "UPDATE users SET TYPE=:type WHERE ID=:id";
    }

    protected function GetDataArray($request){
        return array(
            ":id" => $request->getId(),
            ":type" => $request->getType()
        );
    }
}