<?php
namespace DataLayer\Gallery\Requests;

class GetImageList extends \Requests\Dummy {
    protected $page = 1;
    protected $perPage = 10;

    function __construct($page = 1, $perPage = 10)
    {
        $this->setPage($page);
        $this->setPerPage($perPage);
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
        $this->page = $page;
    }

    /**
     * @return int
     */
    public function getPerPage()
    {
        return $this->perPage;
    }

    /**
     * @param int $perPage
     */
    public function setPerPage($perPage)
    {
        $this->perPage = $perPage;
    }
}