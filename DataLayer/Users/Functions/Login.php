<?php
namespace DataLayer\Users\Functions;

class Login{
    public function __construct($getUserByLoginPassword){
        $this->setGetUserByLoginPasswordFunction($getUserByLoginPassword);
    }

    public function Run(\DataLayer\Users\Requests\Login $request){
        if ($request->getUserInfo()){
            throw new \Exceptions\DefaultException("You are already logged in as ".$request->getUserInfo()['login']);
        }

        $user = $this->getGetUserByLoginPasswordFunction()->Run($request);

        if ($user){
            $_SESSION['user'] = array(
                'Ip' => $request->getIp(),
                'Login' => $request->getLogin(),
                'Type' => $user['Type']
            );

            return true;
        }

        throw new \Exceptions\DefaultException("Login or/and password are incorrect");
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