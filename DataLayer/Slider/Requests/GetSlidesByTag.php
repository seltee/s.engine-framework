<?php
namespace DataLayer\Slider\Requests;

class GetSlidesByTag extends \Requests\Dummy {
    protected $tag = "";

    function __construct($tag = "main")
    {
        $this->setTag($tag);
    }

    /**
     * @return string
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * @param string $tag
     */
    public function setTag($tag)
    {
        $this->tag = $tag;
    }
}