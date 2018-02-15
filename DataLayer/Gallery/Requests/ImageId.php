<?php
namespace DataLayer\Gallery\Requests;

class ImageId extends \Requests\Dummy {
    protected $imageId = null;

    function __construct($imageId = null)
    {
        $this->setImageId($imageId);
    }

    /**
     * @param null $imageId
     */
    public function setImageId($imageId)
    {
        $this->imageId = $imageId;
    }

    /**
     * @return null
     */
    public function getImageId()
    {
        return $this->imageId;
    }
}