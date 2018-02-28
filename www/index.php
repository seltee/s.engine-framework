<?php

include_once '../Init.php';

$dataLayer = \DataLayer\DataLayer::getInstance();
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

try {
    $result = $dataLayer->processRequest('render', $request);
}catch(\Exception $e){
    if ($e instanceof \Exceptions\DefaultException){
        $request = new \DataLayer\Templates\Requests\Render();
        $request->setTemplateName('exception');
        $request->setParameters(array(
            'message' => $e->getMessage()
        ));
        $result = $this->processRequest('render', $request, false);
    }else{
        die("Internal error occurred");
    }
}

echo $result['data'];
