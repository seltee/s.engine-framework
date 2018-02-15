<?php
namespace DataLayer\Slider\Functions;


class GetSlidesByTag{
    public function __construct($getSlidesByTag, $getImageLinks){
        $this->setGetSlidesByTagFunction($getSlidesByTag);
        $this->setGetImageLinksFunction($getImageLinks);
    }

    public function Run(\DataLayer\Slider\Requests\GetSlidesByTag $request){
        $slides = $this->getGetSlidesByTagFunction()->Run($request);
        foreach ($slides as $key => $value){
            $getLinksRequest = new \DataLayer\Gallery\Requests\GetImageLinks($value['Image']);
            $links = $this->getGetImageLinksFunction()->Run($getLinksRequest);
            $slides[$key] = array_merge($slides[$key], $links);
        }
        return $slides;
    }

    protected $getSlidesByTagFunction = null;
    protected $getImageLinksFunction = null;

    /**
     * @return null
     */
    public function getGetSlidesByTagFunction()
    {
        return $this->getSlidesByTagFunction;
    }

    /**
     * @param null $getSlidesByTagFunction
     */
    public function setGetSlidesByTagFunction($getSlidesByTagFunction)
    {
        $this->getSlidesByTagFunction = $getSlidesByTagFunction;
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