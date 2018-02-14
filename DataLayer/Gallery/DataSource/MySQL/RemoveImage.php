<?php
namespace DataLayer\Gallery\DataSource\MySQL;

class RemoveImage extends \Engine\MYSQLiDataSourceReq
{
    protected function CheckRequest($request)
    {
        return $request instanceof \DataLayer\Gallery\Requests\ImageId;
    }

    protected function GetRequestString(){
        return "DELETE FROM gallery
                WHERE ID = :id;";
    }

    protected function GetDataArray($request){
        return array(
            ':id' => $request->getImageId()
        );
    }

    public function GetData($data)
    {
        return $this->GetConnection()->affected_rows;
    }
}