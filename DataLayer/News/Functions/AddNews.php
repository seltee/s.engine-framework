<?php
namespace DataLayer\News\Functions;

use DataLayer\Gallery\Requests\ImageId;
use Engine\Request;

class AddNews{
    public function __construct($addNews, $getImage){
        $this->setAddNewsFunction($addNews);
        $this->setGetImageFunction($getImage);
    }

    public function Run(\DataLayer\News\Requests\AddNews $request){
        if (!$request->getTitle() || strlen($request->getTitle()) <= 3){
            throw new \Exceptions\DefaultException("The news title is too short");
        }

        if (!$request->getBody() || strlen($request->getBody()) <= 3){
            throw new \Exceptions\DefaultException("The news body is too short");
        }

        if (!$request->getShortBody() || strlen($request->getShortBody()) == 0){
            $shortStr = substr(strip_tags ($request->getBody()), 0, SHORT_NEW_LENGTH);
            $space = strrpos ( $shortStr, " ");
            if ($space) {
                $shortStr = substr($shortStr, 0, $space);
            }
            $request->setShortBody($shortStr);
        }

        if (!$request->getImageId() || strlen($request->getImageId()) == 0){
            $request->setImageName(null);
        }else{
            $imageInfo = $this->getGetImageFunction()->Run(new \DataLayer\Gallery\Requests\ImageId($request->getImageId()));
            if ($imageInfo) {
                $request->setImageName($imageInfo['File']);
            }
        }

        return $this->getAddNewsFunction()->Run($request);
    }

    protected $addNewsFunction;
    protected $getImageFunction;

    /**
     * @return mixed
     */
    public function getAddNewsFunction()
    {
        return $this->addNewsFunction;
    }

    /**
     * @param mixed $addNewsFunction
     */
    public function setAddNewsFunction($addNewsFunction)
    {
        $this->addNewsFunction = $addNewsFunction;
    }

    /**
     * @return mixed
     */
    public function getGetImageFunction()
    {
        return $this->getImageFunction;
    }

    /**
     * @param mixed $getImageFunction
     */
    public function setGetImageFunction($getImageFunction)
    {
        $this->getImageFunction = $getImageFunction;
    }
}