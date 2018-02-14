<?php
namespace DataLayer\Gallery\Functions;

use Exceptions\DefaultException;

class GetImageList{
    public function __construct($getImageList, $getImageLinks){
        $this->setGetImageListFunction($getImageList);
        $this->setGetImageLinksFunction($getImageLinks);
    }

    public function Run(\DataLayer\Gallery\Requests\GetImageList $request){
        $result = $this->getGetImageListFunction()->Run($request);
        foreach ($result as $key => $value){
            $result[$key] = array_merge($result[$key], $this->getGetImageLinksFunction()->Run(new \DataLayer\Gallery\Requests\GetImageLinks($value['File'])));
        }
        return $result;
    }


    protected $getImageListFunction = null;
    protected $getImageLinksFunction = null;

    /**
     * @return null
     */
    public function getGetImageListFunction()
    {
        return $this->getImageListFunction;
    }

    /**
     * @param null $getImageListFunction
     */
    public function setGetImageListFunction($getImageListFunction)
    {
        $this->getImageListFunction = $getImageListFunction;
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