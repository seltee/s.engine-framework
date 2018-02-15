<?php
namespace DataLayer\Slider\Functions;

class AddSlide{
    public function __construct($addSlide, $getImage){
        $this->setAddSlideFunction($addSlide);
        $this->setGetImageFunction($getImage);
    }

    public function Run(\DataLayer\Slider\Requests\AddSlide $request){
        if (!$request->getImageName() || strlen($request->getImageName()) == 0){
            if ($request->getImageId()){
                $getImageRequest = new \DataLayer\Gallery\Requests\ImageId($request->getImageId());
                $imageInfo = $this->getGetImageFunction()->Run($getImageRequest);

                if ($imageInfo) {
                    $request->setImageName($imageInfo['File']);
                }else{
                    throw new \Exceptions\InternalException("No image with Id ".$request->getImageId());
                }
            }else{
                throw new \Exceptions\InternalException("No way to get image name");
            }
        }

        $slideId = $this->getAddSlideFunction()->Run($request);
        return $slideId;
    }

    protected $addSlideFunction = null;
    protected $getImageFunction = null;

    /**
     * @return null
     */
    public function getAddSlideFunction()
    {
        return $this->addSlideFunction;
    }

    /**
     * @param null $addSlideFunction
     */
    public function setAddSlideFunction($addSlideFunction)
    {
        $this->addSlideFunction = $addSlideFunction;
    }

    /**
     * @param null $getImageFunction
     */
    public function setGetImageFunction($getImageFunction)
    {
        $this->getImageFunction = $getImageFunction;
    }

    /**
     * @return null
     */
    public function getGetImageFunction()
    {
        return $this->getImageFunction;
    }
}