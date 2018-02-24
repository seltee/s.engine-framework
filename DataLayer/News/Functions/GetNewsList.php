<?php
namespace DataLayer\News\Functions;


class GetNewsList{
    public function __construct($getNewsList, $getImageLinks){
        $this->setGetNewsListFunction($getNewsList);
        $this->setGetImageLinksFunction($getImageLinks);
    }

    public function Run(\DataLayer\News\Requests\GetNewsList $request){
        $news = $this->getGetNewsListFunction()->Run($request);

        foreach ($news as $key => $value){
            $news[$key] = array_merge(
                $value,
                $this->getGetImageLinksFunction()->Run(new \DataLayer\Gallery\Requests\GetImageLinks($value['Image']))
            );
        }

        return $news;
    }

    protected $getNewsListFunction;
    protected $getImageLinksFunction;

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

    /**
     * @return mixed
     */
    public function getGetNewsListFunction()
    {
        return $this->getNewsListFunction;
    }

    /**
     * @param mixed $getNewsListFunction
     */
    public function setGetNewsListFunction($getNewsListFunction)
    {
        $this->getNewsListFunction = $getNewsListFunction;
    }
}