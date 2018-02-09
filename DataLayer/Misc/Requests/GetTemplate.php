<?php
namespace DataLayer\Main\Requests;

class GetTemplate extends \Requests\User {
    protected $templateName;
    protected $subTemplate = null;
    protected $parameters = array();
    protected $withBase = false;

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
     * @return null
     */
    public function getSubTemplate()
    {
        return $this->subTemplate;
    }

    /**
     * @param null $subTemplate
     */
    public function setSubTemplate($subTemplate)
    {
        $this->subTemplate = $subTemplate;
    }

    /**
     * @param array $parameters
     */
    public function setParameters($parameters)
    {
        $this->parameters = $parameters;
    }

    /**
     * @return array
     */
    public function getParameters()
    {
        return $this->parameters;
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
    public function getWithBase()
    {
        return $this->withBase;
    }
}