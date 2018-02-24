<?php
namespace DataLayer\News\Requests;

class GetNewsList extends \Requests\Dummy {
    protected $page = 1;
    protected $limit = 10;

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
        $this->page = $page;
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
        $this->limit = $limit;
    }
}