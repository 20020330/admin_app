<?php

header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//http:localhost:3000/api/demo/calculate.php?a=5&b=6&c=7

$a = $_GET['a'];
$b = $_GET['b'];
$c = $_GET['c'];

$detal = $b * $b - 4 * ($a * $c);

$ketqua = "";
$x1 = 0;
$x2 = 0;

if ($detal > 0) {
    $ketqua = "Phương trình có hai nghiệm";
    $x1 = (- ($b + sqrt($detal)) / (2 * $a));
    $x2 = (- ($b - sqrt($detal)) / (2 * $a));
} else if ($ketqua == 0) {
    $ketqua = "Phương trình có nghiệm kép";
    $x1 = -$b  / (2 * $a);
} else {
    $ketqua = "Phương trình vô nghiệm";
}
//handle

echo json_encode(
    array(
        "result" => $ketqua,
        "x1" => $x1,
        "x2" => $x2
    )
);
