<?php
include_once '../Init.php';

//get data
$input = fopen('php://input', "r");
$content = stream_get_contents($input);
$data = json_decode($content, true);

if ($data && array_key_exists('request', $data) && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $dataLayer = \DataLayer\DataLayer::getInstance();

    try {
        $result = $dataLayer->processFunction($data['request'], isset($data['data']) ? $data['data'] : null);
        $answer = array(
            'data' => $result && isset($result['data']) ? $result['data'] : null,
            'error' => false
        );
    }catch(\Exception $e){
        if ($e instanceof \Exceptions\DefaultException){
            $answer = array(
                'error' => true,
                'message' => $e->getMessage(),
                'code' => $e->getCode()
            );
        }else{
            $answer = array(
                'error' => true,
                'message' => "Unknown error appeared on service",
                'code' => 200
            );
        }
    }

    echo json_encode($answer);
}else{
    die("This file may be accessed only by POST requests");
}
