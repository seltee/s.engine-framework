<?php
namespace Engine;

abstract class MYSQLiDataSourceReq extends MYSQLiDataSource
{
    protected function ObtainData($request){
        $connection = $this->GetConnection();

        $string = $this->GetRequestString();
        $dataArray = $this->GetDataArray($request);
        if ($dataArray) {
            foreach ($dataArray as $key => $value){
                if (is_array($value)){
                    $elements = implode ( " , ", $request->getColumns() );
                    $string = str_replace($key, mysqli_real_escape_string($connection, $elements), $string);
                }else {
                    $string = str_replace($key, "'" . mysqli_real_escape_string($connection, $value) . "'", $string);
                }
            }
        }

        $result = $connection->query($string);
        if ($result) {
            return true;
        }else{
            throw new \Exceptions\DefaultException($connection->error);
        }
    }

}