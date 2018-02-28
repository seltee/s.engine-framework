<?php
namespace DataLayer\Templates\Functions;

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