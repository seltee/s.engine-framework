<?php
namespace DataLayer\Gallery\DataSource\MySQL;

class GetImageList extends \Engine\MYSQLiDataSource
{
    protected function CheckRequest($request)
    {
        return $request instanceof \DataLayer\Gallery\Requests\GetImageList;
    }

    protected function GetRequestString(){
        return "SELECT * FROM gallery ORDER BY ID DESC";
    }

    protected function GetDataArray($request){
        return array(
            ":count" => $request->getPerPage(),
            ":offset" => ($request->getPage()-1)*$request->getPerPage()
        );
    }

    public function GetData($data){
        $out = array();
        if ($data){
            foreach ($data as $key => $value){
                $out[] = array(
                    'Id' => $value['ID'],
                    'File' => $value['FILE'],
                    'Extension' => $value['EXTENSION'],
                    'Name' => $value['NAME'],
                    'Description' => $value['DESCRIPTION']
                );
            }
        }
        return $out;
    }
}