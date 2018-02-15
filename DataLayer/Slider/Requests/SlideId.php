<?php
namespace DataLayer\Slider\Requests;

class SlideId extends \Requests\Dummy {
    protected $id = null;

    /**
     * @return null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param null $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
}