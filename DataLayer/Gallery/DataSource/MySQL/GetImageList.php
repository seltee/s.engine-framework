<?php
namespace DataLayer\Gallery\DataSource\MySQL;

class GetImageList extends \Engine\MYSQLiDataSource
{
    protected function CheckRequest($request)
    {
        return $request instanceof \DataLayer\Gallery\Requests\GetImageList;
    }

    protected function GetRequestString(){
        return "SELECT * FROM gallery ORDER BY ID DESC LIMIT :count OFFSET :offset";
    }

    protected function GetDataArray($request){
        return array(
            ":count" => $request->getLimit(),
            ":offset" => ($request->getPage()-1)*$request->getLimit()
        );
    }

    public function GetData($data){
        return $this->Match($data, array(
            'ID' => 'Id',
            'FILE' => 'File',
            'EXTENSION' => 'Extension',
            'NAME' => 'Name',
            'DESCRIPTION' => 'Description'
        ));
    }
}