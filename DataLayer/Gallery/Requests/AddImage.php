<?php
namespace DataLayer\Gallery\Requests;

class AddImage extends \Requests\Dummy {
    protected $imageData;
    protected $imageName = "";
    protected $imageType = "";
    protected $imageDescription = "";

    /**
     * @param mixed $imageData
     */
    public function setImageData($imageData)
    {
        $this->imageData = $imageData;
    }

    /**
     * @return mixed
     */
    public function getImageData()
    {
        return $this->imageData;
    }

    /**
     * @return mixed
     */
    public function getImageName()
    {
        return $this->imageName;
    }

    /**
     * @param mixed $imageName
     */
    public function setImageName($imageName)
    {
        $this->imageName = $imageName;
    }

    /**
     * @return mixed
     */
    public function getImageType()
    {
        return $this->imageType;
    }

    /**
     * @param mixed $imageType
     */
    public function setImageType($imageType)
    {
        $this->imageType = $imageType;
    }

    /**
     * @return string
     */
    public function getImageDescription()
    {
        return $this->imageDescription;
    }

    /**
     * @param string $imageDescription
     */
    public function setImageDescription($imageDescription)
    {
        $this->imageDescription = $imageDescription;
    }
}