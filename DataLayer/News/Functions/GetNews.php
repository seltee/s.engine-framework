<?php
namespace DataLayer\News\Functions;


class GetNews{
    public function __construct($getNews, $getImageLinks){
        $this->setGetNewsFunction($getNews);
        $this->setGetImageLinksFunction($getImageLinks);
    }

    public function Run(\DataLayer\News\Requests\NewsId $request){
        $news = $this->getGetNewsFunction()->Run($request);
        return array_merge($news, $this->getGetImageLinksFunction()->Run(new \DataLayer\Gallery\Requests\GetImageLinks($news['Image'])));
    }


    protected $getNewsFunction = null;
    protected $getImageLinksFunction = null;

    /**
     * @return mixed
     */
    public function getGetNewsFunction()
    {
        return $this->getNewsFunction;
    }

    /**
     * @param mixed $getNewsFunction
     */
    public function setGetNewsFunction($getNewsFunction)
    {
        $this->getNewsFunction = $getNewsFunction;
    }

    /**
     * @param mixed $getImageLinksFunction
     */
    public function setGetImageLinksFunction($getImageLinksFunction)
    {
        $this->getImageLinksFunction = $getImageLinksFunction;
    }

    /**
     * @return mixed
     */
    public function getGetImageLinksFunction()
    {
        return $this->getImageLinksFunction;
    }
}