<?php
namespace DataLayer\Misc;

class Package extends \Engine\Package {
    public function getConnectionInfo(){
        $getTables = new DataSource\MySQL\GetTables();

        return new Functions\GetDBInfo($getTables);
    }

    public function addTable(){
        return new DataSource\MySQL\AddTable();
    }

    public function getFunctions()
    {
        return null;
    }
}












