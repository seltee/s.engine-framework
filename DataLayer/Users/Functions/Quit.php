<?php
namespace DataLayer\Users\Functions;

class Quit{
    public function __construct(){
    }

    public function Run(\Requests\User $request){
        if (!$request->getUserInfo()){
            throw new \Exceptions\DefaultException("You are not logged in");
        }

        unset($_SESSION['user']);
    }

    protected $getUserByLoginPasswordFunction;

    /**
     * @return mixed
     */
    public function getGetUserByLoginPasswordFunction()
    {
        return $this->getUserByLoginPasswordFunction;
    }

    /**
     * @param mixed $getUserByLoginPasswordFunction
     */
    public function setGetUserByLoginPasswordFunction($getUserByLoginPasswordFunction)
    {
        $this->getUserByLoginPasswordFunction = $getUserByLoginPasswordFunction;
    }

}