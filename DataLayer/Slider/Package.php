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

    public function getFunctions()
    {
        return array(
            $this->f("getSlides", '/DataLayer/Slider/Requests/GetSlides', 'Get overall slides'),
            $this->f("getSlidesByTag", '/DataLayer/Slider/Requests/GetSlidesByTag', 'Get slides tagged with tag. Use tags to get slides for certain slider'),
            $this->f("addSlide", '/DataLayer/Slider/Requests/AddSlide', 'Add\'s slide. Admin user use only', 2),
            $this->f("removeSlide", '/DataLayer/Slider/Requests/SlideId', "Removes slide. Admin user use only", 2)
        );
    }
}
























