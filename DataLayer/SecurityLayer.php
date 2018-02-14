<?php

namespace DataLayer;

class SecurityLayer extends \Engine\SecurityLayer {
    public function check($functionInfo, $request, $dataLayer, $checkSecurity = true){
        //security check. Tests if user allowed to use this function
        if ($checkSecurity && $functionInfo['secured'] > 0){
            if (!isset($_SESSION['user'])){
                $dataLayer->processException(new \Exceptions\DefaultException("This function is not allowed for unregistered users"));
            }

            switch($_SESSION['user']['Type']){
                case 'USR':
                    if ($functionInfo['secured'] > 1){
                        $dataLayer->processException(new \Exceptions\DefaultException("This function is not allowed for common users"));
                    }
                    break;
                case 'ADM':
                    break;
                default:
                    $dataLayer->processException(new \Exceptions\InternalException("Unknown user type"));
            }
        }

        //this point adds user info to ther request
        if ($request instanceof \Requests\User){
            if(isset($_SESSION['user'])){
                $request->setUserInfo($_SESSION['user']);
            }else {
                $request->setUserInfo(null);
            }
        }

        //this point adds connection info
        if ($request instanceof \Requests\UserConnection){
            $request->setIp($this->getUserHostAddress());
        }

        return true;
    }

    public function checkException(\Exception $e){
        if ($e instanceof \Exceptions\InternalException && !DEV_SERVER){
            //internal errors should not be displayed on the user server. Only for internal use on develop side.
            return new \Exceptions\DefaultException("Internal server error");
        }else{
            return $e;
        }
    }

    protected function getUserHostAddress(){
        if (!empty($_SERVER['HTTP_X_REAL_IP']))   //check ip from share internet
        {
            $ip=$_SERVER['HTTP_X_REAL_IP'];
        }
        elseif (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
        {
            $ip=$_SERVER['HTTP_CLIENT_IP'];
        }
        else
        {
            $ip=$_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }
}