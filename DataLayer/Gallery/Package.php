<?php
namespace DataLayer\Gallery;

class Package extends \Engine\Package {
    public function addImage(){
        $addImageRecord = new DataSource\MySQL\AddImageRecord();

        return new Functions\AddImage($addImageRecord);
    }

    public function getImageCount(){
        return new DataSource\MySQL\GetImageCount();
    }

    public function getImageList(){
        $getImageList = new DataSource\MySQL\GetImageList();
        $getImageLinks = new Functions\GetImageLinks();

        return new Functions\GetImageList($getImageList, $getImageLinks);
    }

    public function getImageById(){
        $getImageById = new DataSource\MySQL\GetImageById();
        $getImageLinks = new Functions\GetImageLinks();

        return new Functions\GetImageById($getImageById, $getImageLinks);
    }

    public function removeImage(){
        $getImageById = $this->getImageById();
        $removeImage = new DataSource\MySQL\RemoveImage();

        return new Functions\RemoveImage($getImageById, $removeImage);
    }
}
























