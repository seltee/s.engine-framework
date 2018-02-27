<?php
include_once '../Init.php';

//allow cross domain post for dev server

if (DEV_SERVER) {
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Credentials: true");
    header("Access-Control-Allow-Methods: GET,HEAD,OPTIONS,POST,PUT");
    header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Origin,Accept, X-Requested-With, Content-Type, Access-Control-Request-Method, Access-Control-Request-Headers");
}

//get data from stream, if $_POST is empty
$input = fopen('php://input', "r");
$content = stream_get_contents($input);
$data = json_decode($content, true);

if ($data && array_key_exists('request', $data) && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $dataLayer = new \DataLayer\DataLayer('datapoint');
    $result = $dataLayer->processFunction($data['request'], isset($data['data']) ? $data['data'] : null);

    $answer = array(
        'data' => $result && isset($result['data']) ? $result['data'] : null,
        'error' => false
    );

    echo json_encode($answer);
}else{
    die("This file may be accessed only by POST requests");
}
