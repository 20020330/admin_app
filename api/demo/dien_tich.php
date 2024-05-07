<?php

header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//http:localhost:3000/api/demo/calculate.php?a=5&b=6&c=7
$data = json_decode(file_get_contents("php://input"));

$chieudai  = $data->chieu_dai;
$chieurong  = $data->chieu_rong;
$dientich = $chieudai  * $chieurong;

echo json_encode(
    array(
        "result" => $dientich,
    )
);
