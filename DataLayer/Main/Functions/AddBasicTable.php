<?php
namespace DataLayer\Main\Functions;

class AddBasicTable{
    public function __construct($getConnectionInfo, $addTableUsers){
        $this->setGetConnectionInfoFunction($getConnectionInfo);
        $this->setAddTableUsersFunction($addTableUsers);
    }

    public function Run(\DataLayer\Main\Requests\AddBasicTable $request){
        $tables = $this->getGetConnectionInfoFunction()->Run(new \Requests\Dummy())['DBTables'];
        $requestedName = $request->getIdentifier();

        if (in_array($requestedName, $tables)){
            return false;
        }

        switch($requestedName){
            case 'users':
                $this->getAddTableUsersFunction()->Run(new \Requests\Dummy());
                return true;
            default:
                return false;
        }
    }

    protected $getConnectionInfoFunction = null;
    protected $addTableUsersFunction = null;

    /**
     * @param null $getConnectionInfoFunction
     */
    public function setGetConnectionInfoFunction($getConnectionInfoFunction)
    {
        $this->getConnectionInfoFunction = $getConnectionInfoFunction;
    }

    /**
     * @return null
     */
    public function getGetConnectionInfoFunction()
    {
        return $this->getConnectionInfoFunction;
    }

    /**
     * @return null
     */
    public function getAddTableUsersFunction()
    {
        return $this->addTableUsersFunction;
    }

    /**
     * @param null $addTableUsersFunction
     */
    public function setAddTableUsersFunction($addTableUsersFunction)
    {
        $this->addTableUsersFunction = $addTableUsersFunction;
    }
}