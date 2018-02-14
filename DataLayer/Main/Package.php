<?php
namespace DataLayer\Main;

class Package extends \Engine\Package {
    public function addBasicTable(){
        $packageMisc = $this->getPackageByName("Misc");

        $getConnectionInfo = $packageMisc->getConnectionInfo();
        $addTableUsers = new DataSource\MySQL\AddTableUsers();
        $addTableGallery = new DataSource\MySQL\AddTableGallery();

        return new Functions\AddBasicTable($getConnectionInfo, $addTableUsers, $addTableGallery);
    }
}
























