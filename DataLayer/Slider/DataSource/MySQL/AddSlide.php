<?php
namespace DataLayer\Slider\DataSource\MySQL;

class AddSlide extends \Engine\MYSQLiDataSourceReq
{
    protected function CheckRequest($request)
    {
        return $request instanceof \DataLayer\Slider\Requests\AddSlide;
    }

    protected function GetRequestString(){
        return "INSERT INTO slides (IMAGE, TAG, HEADER, BODY, LINK) VALUES (:image, :tag, :header, :body, :link)";
    }

    protected function GetDataArray($request){
        return array(
            ":image" => $request->GetImageName(),
            ":tag" => $request->GetTag(),
            ":header" => $request->GetHeader(),
            ":body" => $request->GetBody(),
            ":link" => $request->GetLink()
        );
    }

    public function GetData($data){
        return $this->GetConnection()->lastInsertId();
    }
}