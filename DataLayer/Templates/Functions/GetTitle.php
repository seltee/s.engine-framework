<?php
namespace DataLayer\Templates\Functions;

/**
 * Created by PhpStorm.
 * User: Drakiny
 * Date: 22.08.2017
 * Time: 21:30
 */
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