<?php
namespace DataLayer\Templates\Functions;

class GetTitle
{
    function __construct()
    {
    }

    public function Run(\DataLayer\Templates\Requests\Render $request){
        switch ($request->getTemplateName()){
            case 'main':
                return SITE_NAME . " - Main Page";
            default:
                return SITE_NAME;
        }
    }
}