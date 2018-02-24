<?php
namespace DataLayer\News\Requests;

class AddNews extends \Requests\Dummy {
    protected $title = "";
    protected $body = "";
    protected $shortBody = "";
    protected $imageId = "";
    protected $imageName = "";

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @param string $body
     */
    public function setBody($body)
    {
        $this->body = $body;
    }

    /**
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @return string
     */
    public function getShortBody()
    {
        return $this->shortBody;
    }

    /**
     * @param string $shortBody
     */
    public function setShortBody($shortBody)
    {
        $this->shortBody = $shortBody;
    }

    /**
     * @param string $imageId
     */
    public function setImageId(string $imageId)
    {
        $this->imageId = $imageId;
    }

    /**
     * @return string
     */
    public function getImageId(): string
    {
        return $this->imageId;
    }

    /**
     * @return string
     */
    public function getImageName(): string
    {
        return $this->imageName;
    }

    /**
     * @param string $imageName
     */
    public function setImageName(string $imageName)
    {
        $this->imageName = $imageName;
    }
}