<?php
namespace DataLayer\Gallery\DataSource\MySQL;

class GetImageById extends \Engine\MYSQLiDataSource
{
    protected function CheckRequest($request)
    {
        return $request instanceof \DataLayer\Gallery\Requests\ImageId;
    }

    protected function GetRequestString(){
        return "SELECT * FROM gallery WHERE ID=:id";
    }

    protected function GetDataArray($request){
        return array(
            ":id" => $request->getImageId()
        );
    }

    public function GetData($data){
        if (array_key_exists(0, $data)){
            return array(
                'Id' => $data[0]['ID'],
                'File' => $data[0]['FILE'],
                'Extension' => $data[0]['EXTENSION'],
                'Name' => $data[0]['NAME'],
                'Description' => $data[0]['DESCRIPTION']
            );
        }
        return null;
    }
}