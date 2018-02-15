<?php
namespace Engine;

abstract class MYSQLiDataSourceReq extends MYSQLiDataSource
{
    protected function ObtainData($request){
        $connection = $this->GetConnection();

        $string = $this->GetRequestString();
        $dataArray = $this->GetDataArray($request);

        try {
            $result = $connection->prepare($string);
            $result->execute($dataArray);
        }catch (\PDOException $e){
            throw new \Exceptions\InternalException($e->getMessage());
        }

        return true;
    }

}