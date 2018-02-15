<?php
namespace DataLayer\Slider\Requests;

class GetSlides extends \Requests\Dummy {
    protected $page = 0;
    protected $limit = 0;

    function __construct($page = 1, $limit = 10)
    {
        $this->setPage($page);
        $this->setLimit($limit);
    }

    /**
     * @return int
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * @param int $page
     */
    public function setPage($page)
    {
        $this->page = intval($page);
    }

    /**
     * @return int
     */
    public function getLimit()
    {
        return $this->limit;
    }

    /**
     * @param int $limit
     */
    public function setLimit($limit)
    {
        $this->limit = intval($limit);
    }
}