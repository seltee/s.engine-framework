<?php
namespace DataLayer\Main\DataSource\MySQL;

class AddTableGallery extends \Engine\MYSQLiDataSourceReq
{
    protected function CheckRequest($request)
    {
        return true;
    }

    protected function GetRequestString(){
        return "CREATE TABLE `gallery` ( `ID` INT NOT NULL AUTO_INCREMENT , `FILE` VARCHAR(24) NOT NULL , `EXTENSION` VARCHAR(8) NOT NULL , `NAME` VARCHAR(64) NOT NULL, `DESCRIPTION` TINYTEXT, PRIMARY KEY (`ID`)) ENGINE = InnoDB;";
    }

    protected function GetDataArray($request){
        return array();
    }
}