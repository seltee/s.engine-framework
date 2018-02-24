<?php
namespace DataLayer\News\DataSource\MySQL;

class RemoveNews extends \Engine\MYSQLiDataSourceReq
{
    protected function CheckRequest($request)
    {
        return $request instanceof \DataLayer\News\Requests\NewsId;
    }

    protected function GetRequestString(){
        return "DELETE FROM news
                WHERE ID = :id;";
    }

    protected function GetDataArray($request){
        return array(
            ":id" => $request->getId()
        );
    }

    public function GetData($data)
    {
        return true;
    }
}