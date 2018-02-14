<?php
namespace DataLayer\Gallery\DataSource\MySQL;

class AddImageRecord extends \Engine\MYSQLiDataSourceReq
{
    protected function CheckRequest($request)
    {
        return $request instanceof \DataLayer\Gallery\Requests\AddImageRecord;
    }

    protected function GetRequestString(){
        return "INSERT INTO gallery (FILE, EXTENSION, NAME, DESCRIPTION) VALUES (:file, :extension, :name, :description)";
    }

    protected function GetDataArray($request){
        return array(
            ':file' => $request->getFile(),
            ':extension' => $request->getExtension(),
            ':name' => $request->getName(),
            ':description' => $request->getDescription()
        );
    }
}