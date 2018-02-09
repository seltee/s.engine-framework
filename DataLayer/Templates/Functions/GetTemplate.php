<?php
namespace DataLayer\Templates\Functions;

/**
 * Created by PhpStorm.
 * User: Drakiny
 * Date: 22.08.2017
 * Time: 21:30
 */
class GetTemplate
{
    function __construct()
    {
    }

    public function Run(\DataLayer\Templates\Requests\GetTemplate $request){
        $data = $request->getData();
        $templateName = $request->getTemplateName();

        foreach ($data as $k => $v) {
            $$k = $v;
        }

        $path = __DIR__ . "/../Templates/$templateName.php";

        if (file_exists($path)) {
            ob_start();
            include __DIR__ . "/../Templates/$templateName.php";
            $content = ob_get_clean();
            return $content;
        } else {
            return null;
        }
    }
}