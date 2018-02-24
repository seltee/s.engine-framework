<?php
namespace DataLayer\Main;

class Package extends \Engine\Package {
    public function addBasicTable(){
        $packageMisc = $this->getPackageByName("Misc");

        $getConnectionInfo = $packageMisc->getConnectionInfo();
        $addTableUsers = new DataSource\MySQL\AddTableUsers();
        $addTableGallery = new DataSource\MySQL\AddTableGallery();
        $addTableSlides = new DataSource\MySQL\AddTableSlides();
        $addTableNews = new DataSource\MySQL\AddTableNews();

        return new Functions\AddBasicTable($getConnectionInfo, $addTableUsers, $addTableGallery, $addTableSlides, $addTableNews);
    }

    public function getConnectionInfo(){
        $packageMisc = $this->getPackageByName("Misc");
        return $packageMisc->getConnectionInfo();
    }

    public function getFunctions()
    {
        $functionList = array();

        if (DEV_SERVER) {
            $functionList = array_merge($functionList, array(
                $this->f("addBasicTable", '/DataLayer/Main/Requests/AddBasicTable', 'Adds system tables. It is allowed for all users by default.'),
                $this->f("getConnectionInfo", '/Requests/Dummy', "Get information about tables in data base")
            ));
        }

        return $functionList;
    }
}
























