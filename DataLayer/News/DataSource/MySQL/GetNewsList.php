<?php
namespace DataLayer\News\DataSource\MySQL;

class GetNewsList extends \Engine\MYSQLiDataSource
{
    protected function CheckRequest($request)
    {
        return $request instanceof \DataLayer\News\Requests\GetNewsList;
    }

    protected function GetRequestString(){
        return "SELECT ID, TITLE, SHORTBODY, IMAGE, CREATED, UPDATED
                FROM news ORDER BY ID DESC LIMIT :count OFFSET :offset";
    }

    protected function GetDataArray($request){
        return array(
            ":count" => $request->getLimit(),
            ":offset" => ($request->getPage()-1)*$request->getLimit()
        );
    }

    public function GetData($data)
    {
        return $this->Match($data, array(
            'ID' => 'Id',
            'TITLE' => 'Title',
            'SHORTBODY' => 'ShortBody',
            'IMAGE' => 'Image',
            'CREATED' => 'Created',
            'UPDATED' => 'Updated'
        ));
    }
}