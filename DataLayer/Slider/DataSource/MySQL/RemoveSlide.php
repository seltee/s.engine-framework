<?php
namespace DataLayer\Slider\DataSource\MySQL;

class RemoveSlide extends \Engine\MYSQLiDataSourceReq
{
    protected function CheckRequest($request)
    {
        return $request instanceof \DataLayer\Slider\Requests\SlideId;
    }

    protected function GetRequestString(){
        return "DELETE FROM slides
                WHERE ID = :id;";
    }

    protected function GetDataArray($request){
        return array(
            ":id" => $request->getId()
        );
    }
}