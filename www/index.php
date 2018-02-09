<?php

include_once '../Init.php';

$dataLayer = new \DataLayer\DataLayer();
$request = new \DataLayer\Templates\Requests\Render();

if (count($_GET)){
    $parameters = array();
    foreach($_GET as $key => $value){
        $parameters[$key] = $value;
    }

    $request->setTemplateName(key($_GET));
    $request->setParameters($parameters);
}else{
    $request->setTemplateName('main');
}

$result = $dataLayer->processRequest('render', $request);
echo $result['data'];
