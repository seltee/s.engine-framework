<?php
namespace DataLayer\Gallery\Functions;

class GetImageById{
    public function __construct($getImageById, $getImageLinks){
        $this->setGetImageByIdFunction($getImageById);
        $this->setGetImageLinksFunction($getImageLinks);
    }

    public function Run(\DataLayer\Gallery\Requests\ImageId $request){
        $imageData = $this->getGetImageByIdFunction()->Run($request);
        return array_merge($imageData, $this->getGetImageLinksFunction()->Run(new \DataLayer\Gallery\Requests\GetImageLinks($imageData['File'])));
    }

    protected $getImageByIdFunction = null;
    protected $getImageLinksFunction = null;

    /**
     * @param null $getImageLinksFunction
     */
    public function setGetImageLinksFunction($getImageLinksFunction)
    {
        $this->getImageLinksFunction = $getImageLinksFunction;
    }

    /**
     * @return null
     */
    public function getGetImageLinksFunction()
    {
        return $this->getImageLinksFunction;
    }

    /**
     * @return null
     */
    public function getGetImageByIdFunction()
    {
        return $this->getImageByIdFunction;
    }

    /**
     * @param null $getImageByIdFunction
     */
    public function setGetImageByIdFunction($getImageByIdFunction)
    {
        $this->getImageByIdFunction = $getImageByIdFunction;
    }
}