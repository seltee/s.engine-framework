<?php
namespace DataLayer\Misc\Functions;

class GetDBInfo{
    public function __construct($getTables){
        $this->setGetTablesFunction($getTables);
    }

    public function Run(\Requests\Dummy $request){
        $tables = array();
        $errorOccurred = null;

        $reporting = error_reporting();
        error_reporting(0);
        try{
            $tables = $this->getGetTablesFunction()->Run($request);
        }catch (\Exception $e){
            $errorOccurred = $e->getMessage();
        }
        error_reporting($reporting);

        return array(
            "DBError" => $errorOccurred,
            "DBTables" => $tables,
            "DBServer" => SQL_SERVER,
            "DBUser" => SQL_USER,
            "DB" => SQL_DB
        );
    }

    protected $getTablesFunction = null;

    /**
     * @return null
     */
    public function getGetTablesFunction()
    {
        return $this->getTablesFunction;
    }

    /**
     * @param null $getTablesFunction
     */
    public function setGetTablesFunction($getTablesFunction)
    {
        $this->getTablesFunction = $getTablesFunction;
    }
}