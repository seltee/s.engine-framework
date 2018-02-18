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

    public function changeUserType(){
        return new DataSource\MySQL\ChangeUserType;
    }

    public function quit(){
        return new Functions\Quit();
    }

    public function getFunctions()
    {
        return array(
            $this->f("addUser", '/DataLayer/Users/Requests/AddUser', 'Adds user'),
            $this->f("getUsersList", '/Requests/User', 'Get the full users list'),
            $this->f("login", '/DataLayer/Users/Requests/Login', 'After this function, other methods will be able to get user data with /Requests/User request'),
            $this->f("quit", '/Requests/User', 'Delete\s info about current session'),
            $this->f("changeUserType", '/DataLayer/Users/Requests/ChangeUserType', "Changes the user type. For example, to admin. For admin users only", 2)
        );
    }
}
























