<?php
namespace Engine;

abstract class MYSQLiDataSource extends \Engine\DataSource
{
    abstract protected function GetRequestString();
    abstract protected function GetDataArray($request);

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
            $out = array();
            while ($row = $result->fetch_assoc()) {
                $out[] = $row;
            }
            return $out;
        }else{
            throw new \Exceptions\DefaultException($connection->error);
        }
    }

    protected function GetConnection(){
        if (!self::$connection){
            $link = mysqli_connect(SQL_SERVER, SQL_USER, SQL_PASSWORD, SQL_DB);
            if (!$link) {
                throw new \Exceptions\DefaultException(mysqli_connect_error());
            }
            $link->set_charset("utf8");
            self::$connection = $link;
        }

        return self::$connection;
    }

    static $connection = null;
}