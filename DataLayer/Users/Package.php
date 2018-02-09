<?php
namespace DataLayer\Users;

class Package extends \Engine\Package {
    public function getUsersList(){
        return new DataSource\MySQL\GetUsersList();
    }

    public function addUser(){
        return new DataSource\MySQL\AddUser();
    }

    public function login(){
        $getUserByLoginPassword = new DataSource\MySQL\GetUserByLoginPassword;

        return new Functions\Login($getUserByLoginPassword);
    }

    public function quit(){
        return new Functions\Quit();
    }
}
























