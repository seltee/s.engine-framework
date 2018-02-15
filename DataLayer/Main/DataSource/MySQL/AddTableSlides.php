<?php
namespace DataLayer\Main\DataSource\MySQL;

class AddTableSlides extends \Engine\MYSQLiDataSourceReq
{
    protected function CheckRequest($request)
    {
        return true;
    }

    protected function GetRequestString(){
        return "CREATE TABLE `slides` (
                  `ID` int(11) NOT NULL AUTO_INCREMENT,
                  `IMAGE` varchar(24) NOT NULL,
                  `TAG` varchar(16) NOT NULL,
                  `HEADER` tinytext NOT NULL,
                  `BODY` text NOT NULL, 
                  `LINK` TEXT NULL,
                  PRIMARY KEY (`ID`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
    }

    protected function GetDataArray($request){
        return array();
    }
}