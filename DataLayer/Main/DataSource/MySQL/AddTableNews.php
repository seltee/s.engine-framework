<?php
namespace DataLayer\Main\DataSource\MySQL;

class AddTableNews extends \Engine\MYSQLiDataSourceReq
{
    protected function CheckRequest($request)
    {
        return true;
    }

    protected function GetRequestString(){
        return "CREATE TABLE `news` (
                 `ID` INT NOT NULL AUTO_INCREMENT , 
                 `TITLE` TINYTEXT NOT NULL , 
                 `BODY` LONGTEXT NOT NULL , 
                 `SHORTBODY` TEXT NOT NULL , 
                 `IMAGE` VARCHAR(48) NOT NULL , 
                 `CREATED` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , 
                 `UPDATED` TIMESTAMP NULL DEFAULT NULL , 
                 PRIMARY KEY (`ID`)) ENGINE = InnoDB;";
    }

    protected function GetDataArray($request){
        return array();
    }
}