<?php
namespace DataLayer\Slider\Functions;


class GetSlides{
    public function __construct($getSlides, $getImageLinks){
        $this->setGetSlidesFunction($getSlides);
        $this->setGetImageLinksFunction($getImageLinks);
    }

    public function Run(\DataLayer\Slider\Requests\GetSlides $request){
        $slides = $this->getGetSlidesFunction()->Run($request);
        foreach ($slides as $key => $value){
            $getLinksRequest = new \DataLayer\Gallery\Requests\GetImageLinks($value['Image']);
            $links = $this->getGetImageLinksFunction()->Run($getLinksRequest);
            $slides[$key] = array_merge($slides[$key], $links);
        }
        return $slides;
    }

    protected $getSlidesFunction = null;
    protected $getImageLinksFunction = null;

    /**
     * @return null
     */
    public function getGetSlidesFunction()
    {
        return $this->getSlidesFunction;
    }

    /**
     * @param null $getSlidesFunction
     */
    public function setGetSlidesFunction($getSlidesFunction)
    {
        $this->getSlidesFunction = $getSlidesFunction;
    }

    /**
     * @return null
     */
    public function getGetImageLinksFunction()
    {
        return $this->getImageLinksFunction;
    }

    /**
     * @param null $getImageLinksFunction
     */
    public function setGetImageLinksFunction($getImageLinksFunction)
    {
        $this->getImageLinksFunction = $getImageLinksFunction;
    }
}