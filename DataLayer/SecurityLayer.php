<?php

namespace DataLayer;

class SecurityLayer extends \Engine\SecurityLayer {
    public function check($functionInfo, $request, $dataLayer, $checkSecurity = true){
        if ($checkSecurity && $functionInfo['secured'] > 0){
            if (!isset($_SESSION['user'])){
                $dataLayer->processException(new \Exceptions\DefaultException("Вы не имеете доступа к данному функционалу"));
            }
        }

        if ($request instanceof \Requests\User){
            if(isset($_SESSION['user'])){
                $request->setUserInfo($_SESSION['user']);
            }else {
                $request->setUserInfo(null);
            }
        }

        if ($request instanceof \Requests\UserConnection){
            $request->setIp($this->getUserHostAddress());
        }

        return true;
    }

    public function checkException(\Exception $e){
        if ($e instanceof \Exceptions\InternalException && !DEV_SERVER){
            return new \Exceptions\DefaultException("Ошибка сервера. Мы уже чиним.");
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