<?php
namespace DataLayer\News\DataSource\MySQL;

class AddNews extends \Engine\MYSQLiDataSourceReq
{
    protected function CheckRequest($request)
    {
        return $request instanceof \DataLayer\News\Requests\AddNews;
    }

    protected function GetRequestString(){
        return "INSERT INTO news (TITLE, BODY, SHORTBODY, IMAGE, UPDATED) VALUES (:title, :body, :shortbody, :image, CURRENT_TIMESTAMP)";
    }

    protected function GetDataArray($request){
        return array(
            ':title' => $request->getTitle(),
            ':body' => $request->getBody(),
            ':shortbody' => $request->getShortBody(),
            ':image' => $request->getimageName()
        );
    }

    public function GetData($data)
    {
        return $this->GetConnection()->lastInsertId();
    }
}