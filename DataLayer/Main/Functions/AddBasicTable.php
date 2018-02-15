<?php
namespace DataLayer\Main\Functions;

class AddBasicTable{
    public function __construct($getConnectionInfo, $addTableUsers, $addTableGallery, $addTableSlides){
        $this->setGetConnectionInfoFunction($getConnectionInfo);
        $this->setAddTableUsersFunction($addTableUsers);
        $this->setAddTableGalleryFunction($addTableGallery);
        $this->setAddTableSlidesFunction($addTableSlides);
    }

    public function Run(\DataLayer\Main\Requests\AddBasicTable $request){
        $tables = $this->getGetConnectionInfoFunction()->Run(new \Requests\Dummy())['DBTables'];
        $requestedName = $request->getIdentifier();

        if (in_array($requestedName, $tables)){
            return false;
        }

        switch($requestedName){
            case 'users':
                $this->getAddTableUsersFunction()->Run(new \Requests\Dummy());
                return true;

            case 'gallery':
                $this->getAddTableGalleryFunction()->Run(new \Requests\Dummy());
                return true;

            case 'slides':
                $this->getAddTableSlidesFunction()->Run(new \Requests\Dummy());
                return true;
            default:
                return false;
        }
    }

    protected $getConnectionInfoFunction = null;
    protected $addTableUsersFunction = null;
    protected $addTableGalleryFunction = null;
    protected $addTableSlidesFunction = null;

    /**
     * @param null $getConnectionInfoFunction
     */
    public function setGetConnectionInfoFunction($getConnectionInfoFunction)
    {
        $this->getConnectionInfoFunction = $getConnectionInfoFunction;
    }

    /**
     * @return null
     */
    public function getGetConnectionInfoFunction()
    {
        return $this->getConnectionInfoFunction;
    }

    /**
     * @return null
     */
    public function getAddTableUsersFunction()
    {
        return $this->addTableUsersFunction;
    }

    /**
     * @param null $addTableUsersFunction
     */
    public function setAddTableUsersFunction($addTableUsersFunction)
    {
        $this->addTableUsersFunction = $addTableUsersFunction;
    }

    /**
     * @return null
     */
    public function getAddTableGalleryFunction()
    {
        return $this->addTableGalleryFunction;
    }

    /**
     * @param null $addTableGalleryFunction
     */
    public function setAddTableGalleryFunction($addTableGalleryFunction)
    {
        $this->addTableGalleryFunction = $addTableGalleryFunction;
    }

    /**
     * @return null
     */
    public function getAddTableSlidesFunction()
    {
        return $this->addTableSlidesFunction;
    }

    /**
     * @param null $addTableSlidesFunction
     */
    public function setAddTableSlidesFunction($addTableSlidesFunction)
    {
        $this->addTableSlidesFunction = $addTableSlidesFunction;
    }
}