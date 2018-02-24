<?php
namespace DataLayer\Users\Functions;

class AddUser{
    public function __construct($addUser, $getUsersCount){
        $this->setAddUserFunction($addUser);
        $this->setGetUsersCount($getUsersCount);
    }

    public function Run(\DataLayer\Users\Requests\AddUser $request){
        $userCount = $this->getGetUsersCount()->Run($request);

        if ($userCount){
            $type = 'USR';
        }else{
            $type = 'ADM';
        }

        $request->setUserType($type);
        return $this->getAddUserFunction()->Run($request);
    }

    protected $addUserFunction;
    protected $getUsersCount;

    /**
     * @return mixed
     */
    public function getAddUserFunction()
    {
        return $this->addUserFunction;
    }

    /**
     * @param mixed $addUserFunction
     */
    public function setAddUserFunction($addUserFunction)
    {
        $this->addUserFunction = $addUserFunction;
    }

    /**
     * @return mixed
     */
    public function getGetUsersCount()
    {
        return $this->getUsersCount;
    }

    /**
     * @param mixed $getUsersCount
     */
    public function setGetUsersCount($getUsersCount)
    {
        $this->getUsersCount = $getUsersCount;
    }
}