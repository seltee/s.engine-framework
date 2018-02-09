<?php
namespace DataLayer\Templates\Requests;

class Render extends \Requests\User {
    protected $templateName = "";
    protected $parameters = array();
    protected $withBase = true;

    /**
     * @return mixed
     */
    public function getTemplateName()
    {
        return $this->templateName;
    }

    /**
     * @param mixed $templateName
     */
    public function setTemplateName($templateName)
    {
        $this->templateName = $templateName;
    }

    /**
     * @return array
     */
    public function getParameters()
    {
        return $this->parameters;
    }

    /**
     * @param array $parameters
     */
    public function setParameters($parameters)
    {
        $this->parameters = $parameters;
    }

    /**
     * @param bool $withBase
     */
    public function setWithBase($withBase)
    {
        $this->withBase = $withBase;
    }

    /**
     * @return bool
     */
    public function isWithBase()
    {
        return $this->withBase;
    }
}