<?php
namespace DataLayer\CSV\Requests;

class CheckCSV extends \Requests\Dummy {
    protected $fileData;
    protected $previewCount = 1000;

    /**
     * @param mixed $fileData
     */
    public function setFileData($fileData)
    {
        $this->fileData = $fileData;
    }

    /**
     * @return mixed
     */
    public function getFileData()
    {
        return $this->fileData;
    }

    /**
     * @return mixed
     */
    public function getPreviewCount()
    {
        return $this->previewCount;
    }

    /**
     * @param mixed $previewCount
     */
    public function setPreviewCount($previewCount)
    {
        $this->previewCount = $previewCount;
    }
}