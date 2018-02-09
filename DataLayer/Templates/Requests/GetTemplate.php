<?php
namespace DataLayer\Templates\Requests;

class GetTemplate extends \Requests\Dummy {
    protected $templateName;
    protected $data;

    function __construct($templateName = "", $data = null)
    {
        $this->setTemplateName($templateName);
        $this->setData($data);
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param mixed $data
     */
    public function setData($data)
    {
        if (is_array($data)) {
            $this->data = $data;
        }else{
            $this->data = array();
        }
    }

    /**
     * @param mixed $templateName
     */
    public function setTemplateName($templateName)
    {
        $this->templateName = $templateName;
    }

    /**
     * @return mixed
     */
    public function getTemplateName()
    {
        return $this->templateName;
    }
}