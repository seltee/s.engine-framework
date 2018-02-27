<?php
namespace DataLayer\Gallery\Functions;

use Exceptions\DefaultException;

class AddImage{
    public function __construct($addImageRecord){
        $this->setAddImageRecordFunction($addImageRecord);
    }

    public function Run(\DataLayer\Gallery\Requests\AddImage $request){
        //create directories if needed
        if (!is_dir(GALLERY_DIR)){
            mkdir(GALLERY_DIR);
            mkdir(GALLERY_DIR.'/preview');
            mkdir(GALLERY_DIR.'/medium');
            mkdir(GALLERY_DIR.'/big');
            mkdir(GALLERY_DIR.'/full');
        }

        //check data
        if (strlen($request->getImageData()) == 0 || strlen($request->getImageName()) == 0){
            throw new DefaultException("Data or name was not sended");
        }

        //check if extension allowed
        $allowedImageTypes = array("jpeg", "png", "gif");

        if (!in_array($request->getImageType(), $allowedImageTypes)){
            throw new DefaultException("Image type not allowed");
        }

        //generate name, that doesn't used yet
        do {
            $name = $this->generateRandomString(12) . '.' . $request->getImageType();
        }while(file_exists (  GALLERY_DIR.'/full/'.$name));

        //convert image
        $pathFull = GALLERY_DIR.'/full/'.$name;
        $pathBig = GALLERY_DIR.'/big/'.$name;
        $pathMedium = GALLERY_DIR.'/medium/'.$name;
        $pathPreview = GALLERY_DIR.'/preview/'.$name;

        $file = base64_decode($request->getImageData(), true);

        file_put_contents($pathFull, $file);
        $image = $this->loadAsImage($pathFull);
        if (!$image){
            unlink($pathFull);
            throw new DefaultException("Could not load image");
        }

        $result = true;
        $result &= $this->saveImage($this->resize($image, BIG_IMAGE), $pathBig, $request->getImageType());
        $result &= $this->saveImage($this->resize($image, MEDIUM_IMAGE), $pathMedium, $request->getImageType());
        $result &= $this->saveImage($this->resize($image, PREVIEW_IMAGE), $pathPreview, $request->getImageType());

        if (!$result){
            unlink($pathFull);
            throw new DefaultException("Could not save image");
        }

        $reqAddImageRecord = new \DataLayer\Gallery\Requests\AddImageRecord();
        $reqAddImageRecord->setName($request->getImageName());
        $reqAddImageRecord->setFile($name);
        $reqAddImageRecord->setExtension($request->getImageType());
        $reqAddImageRecord->setDescription($request->getImageDescription());

        $id = $this->getAddImageRecordFunction()->Run($reqAddImageRecord);

        return array(
            "imageName" => $name,
            "imageId" => $id
        );
    }

    protected function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ_';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    protected function loadAsImage($path){
        $image_info = getimagesize($path);
        switch($image_info[2]) {
            case IMAGETYPE_JPEG:
                return imagecreatefromjpeg($path);
            case IMAGETYPE_GIF:
                return imagecreatefromgif($path);
            case IMAGETYPE_PNG:
                return imagecreatefrompng($path);
            default:
                return false;
        }
    }

    protected function saveImage($image, $path, $extension){
        switch($extension){
            case "jpeg":
                imagejpeg($image, $path, 90);
                return true;
            case "png":
                imagepng($image, $path);
                return true;
            case "gif":
                imagegif($image, $path);
                return true;
        }
    }

    protected function resize($image, $size){
        if (imagesx($image) >= imagesy($image)){
            $width = $size;
            $height = imagesy($image) * ($size / imagesx($image));
        }else{
            $width = imagesx($image) * ($size / imagesy($image));
            $height = $size;
        }

        $new_image = imagecreatetruecolor($width, $height);
        imagecopyresampled($new_image, $image, 0, 0, 0, 0, $width, $height, imagesx($image), imagesy($image));

        return $new_image;
    }


    protected $addImageRecordFunction = null;

    /**
     * @return null
     */
    public function getAddImageRecordFunction()
    {
        return $this->addImageRecordFunction;
    }

    /**
     * @param null $addImageRecordFunction
     */
    public function setAddImageRecordFunction($addImageRecordFunction)
    {
        $this->addImageRecordFunction = $addImageRecordFunction;
    }
}