<?php
namespace DataLayer\Main\DataSource\MySQL;

class AddTableUsers extends \Engine\MYSQLiDataSourceReq
{
    protected function CheckRequest($request)
    {
        return true;
    }

    protected function GetRequestString(){
        return "CREATE TABLE `users` 
                ( 
                `ID` INT NOT NULL AUTO_INCREMENT , 
                `LOGIN` VARCHAR(64) NOT NULL , 
                `PASSWORD` VARCHAR(32) NOT NULL , 
                `TYPE` VARCHAR(3) NOT NULL DEFAULT 'USR' , 
                `REG_DATE` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , 
                PRIMARY KEY (`ID`) ,
                UNIQUE (`LOGIN`)
                ) 
                ENGINE = InnoDB;";
    }

    protected function GetDataArray($request){
        return array();
    }
}