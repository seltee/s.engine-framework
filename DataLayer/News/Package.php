<?php
namespace DataLayer\News;

class Package extends \Engine\Package {
    public function getNewsList(){
        $galleryPackage = $this->getPackageByName("Gallery");

        $getNewsList = new DataSource\MySQL\GetNewsList();
        $getImageLinks = $galleryPackage->getImageLinks();

        return new Functions\GetNewsList($getNewsList, $getImageLinks);
    }

    public function getNewsCount(){
        return new DataSource\MySQL\GetNewsCount();
    }

    public function getNews(){
        $galleryPackage = $this->getPackageByName("Gallery");

        $getNews = new DataSource\MySQL\GetNews();
        $getImageLinks = $galleryPackage->getImageLinks();

        return new Functions\GetNews($getNews, $getImageLinks);
    }

    public function addNews(){
        $galleryPackage = $this->getPackageByName("Gallery");

        $getImage = $galleryPackage->getImageById();
        $addNews = new DataSource\MySQL\AddNews();

        return new Functions\AddNews($addNews, $getImage);
    }

    public function updateNews(){

    }

    public function removeNews(){
        return new DataSource\MySQL\RemoveNews();
    }


    public function getFunctions()
    {
        return array(
            $this->f("getNewsList", '/DataLayer/News/Requests/GetNewsList', 'Get news list page by limit'),
            $this->f("getNewsCount", '/Requests/Dummy', 'Get news overall count'),
            $this->f("addNews", '/DataLayer/News/Requests/AddNews', 'Add news'),
            $this->f("removeNews", '/DataLayer/News/Requests/NewsId', 'Removes the selected news by id'),
            $this->f("getNews", '/DataLayer/News/Requests/NewsId', 'Get the full view of news'),
        );
    }
}
























