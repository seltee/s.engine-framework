<?php
namespace DataLayer\Slider\DataSource\MySQL;

class GetSlides extends \Engine\MYSQLiDataSource
{
    protected function CheckRequest($request)
    {
        return $request instanceof \DataLayer\Slider\Requests\GetSlides;
    }

    protected function GetRequestString(){
        return "SELECT * FROM slides ORDER BY ID DESC LIMIT :count OFFSET :offset";
    }

    protected function GetDataArray($request){
        $limit = $request->getLimit() ? $request->getLimit() : 10;
        return array(
            ":count" => $limit,
            ":offset" => ($request->getPage()-1)*$limit
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