<?php
namespace DataLayer\CSV;

class Package extends \Engine\Package {
    public function checkCSV(){
        return new \DataLayer\CSV\Functions\CheckCSV();
    }

    public function loadCSVToDataBase(){
        $addCSVTable = new DataSource\MySQL\AddCSVTable();
        $addCSVEntry = new DataSource\MySQL\AddCSVEntry();

        return new Functions\LoadCSVToDataBase($addCSVTable, $addCSVEntry);
    }

    public function getFunctions()
    {
        return array(
            $this->f("checkCSV",  "/DataLayer/CSV/Requests/CheckCSV", "Returns parsed CSV data and info"),
            $this->f("loadCSVToDataBase", "/DataLayer/CSV/Requests/LoadCSVToDataBase", "Creates table in Data Base with defined in request fields and adds all rows from the CSV there", 2)
        );
    }
}
























