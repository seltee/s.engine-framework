<?php
namespace DataLayer\Slider\DataSource\MySQL;

class GetSlidesByTag extends \Engine\MYSQLiDataSource
{
    protected function CheckRequest($request)
    {
        return $request instanceof \DataLayer\Slider\Requests\GetSlidesByTag;
    }

    protected function GetRequestString(){
        return "SELECT * FROM slides WHERE TAG=:tag ORDER BY ID DESC";
    }

    protected function GetDataArray($request){
        return array(
            ":tag" => $request->getTag()
        );
    }

    public function GetData($data){
        return $this->Match($data, array(
            'ID' => 'Id',
            'IMAGE' => 'Image',
            'TAG' => 'Tag',
            'HEADER' => 'Header',
            'BODY' => 'Body',
            'LINK' => 'Link'
        ));
    }
}