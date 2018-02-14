<?php
namespace DataLayer\Gallery\Functions;

use Exceptions\DefaultException;

class RemoveImage{
    public function __construct($getImageById, $removeImage){
        $this->setGetImageByIdFunction($getImageById);
        $this->setRemoveImageFunction($removeImage);
    }

    public function Run(\DataLayer\Gallery\Requests\ImageId $request){
        $data = $this->getGetImageByIdFunction()->Run($request);
        if (!$data){
            throw new \Exceptions\DefaultException("No such image id");
        }

        $name = $data['File'];

        $affected = $this->getRemoveImageFunction()->Run($request);

        if ($affected){
            unlink(GALLERY_DIR.'/full/'.$name);
            unlink(GALLERY_DIR.'/big/'.$name);
            unlink(GALLERY_DIR.'/medium/'.$name);
            unlink(GALLERY_DIR.'/preview/'.$name);

            return true;
        }
    }
    protected $getImageByIdFunction = null;
    protected $removeImageFunction = null;

    /**
     * @param null $getImageByIdFunction
     */
    public function setGetImageByIdFunction($getImageByIdFunction)
    {
        $this->getImageByIdFunction = $getImageByIdFunction;
    }

    /**
     * @return null
     */
    public function getGetImageByIdFunction()
    {
        return $this->getImageByIdFunction;
    }

    /**
     * @return null
     */
    public function getRemoveImageFunction()
    {
        return $this->removeImageFunction;
    }

    /**
     * @param null $removeImageFunction
     */
    public function setRemoveImageFunction($removeImageFunction)
    {
        $this->removeImageFunction = $removeImageFunction;
    }
}