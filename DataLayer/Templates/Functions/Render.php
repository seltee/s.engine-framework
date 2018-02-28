<?php
namespace DataLayer\Templates\Functions;

class Render
{
    function __construct($getTemplate, $getTitle)
    {
        $this->setGetTemplateFunction($getTemplate);
        $this->setGetTitle($getTitle);
    }

    public function Run(\DataLayer\Templates\Requests\Render $request){
        $parameters = $request->getParameters();
        $parameters["user"] = $request->getUserInfo();


        $content = $this->getGetTemplateFunction()->Run(new \DataLayer\Templates\Requests\GetTemplate($request->getTemplateName(), $parameters));

        if ($request->isWithBase()){
            $baseRequest = new \DataLayer\Templates\Requests\GetTemplate(
                'base',
                array(
                    "content" => $content,
                    "title" => $this->getGetTitle()->Run($request),
                    "action" => $request->getTemplateName()
                )
            );
            $content = $this->getGetTemplateFunction()->Run($baseRequest);
        }

        return $content;
    }

    protected $getTemplateFunction = null;
    protected $getTitle = null;

    /**
     * @return null
     */
    public function getGetTemplateFunction()
    {
        return $this->getTemplateFunction;
    }

    /**
     * @param null $getTemplateFunction
     */
    public function setGetTemplateFunction($getTemplateFunction)
    {
        $this->getTemplateFunction = $getTemplateFunction;
    }

    /**
     * @return null
     */
    public function getGetTitle()
    {
        return $this->getTitle;
    }

    /**
     * @param null $getTitle
     */
    public function setGetTitle($getTitle)
    {
        $this->getTitle = $getTitle;
    }
}