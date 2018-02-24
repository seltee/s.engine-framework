<?php
namespace DataLayer\News\DataSource\MySQL;

class GetNews extends \Engine\MYSQLiDataSource
{
    protected function CheckRequest($request)
    {
        return $request instanceof \DataLayer\News\Requests\NewsId;
    }

    protected function GetRequestString(){
        return "SELECT ID, TITLE, BODY, IMAGE, CREATED, UPDATED
                FROM news WHERE ID = :id";
    }

    protected function GetDataArray($request){
        return array(
            ":id" => $request->getId()
        );
    }

    public function GetData($data)
    {
        return $this->GetFirst($data, array(
            'ID' => 'Id',
            'TITLE' => 'Title',
            'BODY' => 'Body',
            'IMAGE' => 'Image',
            'CREATED' => 'Created',
            'UPDATED' => 'Updated'
        ));
    }
}