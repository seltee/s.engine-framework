<?php
namespace DataLayer\Slider;


class Package extends \Engine\Package {
    public function addSlide(){
        $galleryPackage = $this->getPackageByName("Gallery");
        $getImage = $galleryPackage->getImageById();
        $addSlide = new DataSource\MySQL\AddSlide();

        return new Functions\AddSlide($addSlide, $getImage);
    }

    public function removeSlide(){
        return new DataSource\MySQL\RemoveSlide();
    }

    public function getSlides(){
        $galleryPackage = $this->getPackageByName("Gallery");

        $getSlides = new DataSource\MySQL\GetSlides();
        $getImageLinks = $galleryPackage->getImageLinks();

        return new Functions\GetSlides($getSlides, $getImageLinks);
    }

    public function getSlidesByTag(){
        $galleryPackage = $this->getPackageByName("Gallery");

        $getSlidesByTag = new DataSource\MySQL\GetSlidesByTag();
        $getImageLinks = $galleryPackage->getImageLinks();

        return new Functions\GetSlidesByTag($getSlidesByTag, $getImageLinks);
    }

    public function getSlidesCount(){
        return new DataSource\MySQL\GetSlidesCount();
    }
}
























