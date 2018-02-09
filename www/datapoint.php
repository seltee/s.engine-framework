<?php
include_once '../Init.php';

$dataLayer = new \DataLayer\DataLayer('datapoint');
$result = $dataLayer->processFunction($_POST['request'], isset($_POST['data']) ? $_POST['data'] : null);

$answer = array(
    'data' => $result && isset($result['data']) ? $result['data'] : null,
    'error' => false
);

echo json_encode($answer);
