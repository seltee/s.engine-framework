<?php
namespace DataLayer\News\Requests;

class NewsId extends \Requests\Dummy {
    protected $id = null;

    function __construct($id = null)
    {
        $this->setId($id);
    }

    /**
     * @param null $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return null
     */
    public function getId()
    {
        return $this->id;
    }
}