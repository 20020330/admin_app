<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once("../db/connection.php");

try {

    $result = $dbConn->query("SELECT SV.id as id, sv.name as name , TB.POINT AS point FROM SINH_VIEN as sv INNER JOIN DIEM_TRUNG_BINH AS TB ON SV.ID = TB.STUDENT_ID ORDER BY TB.POINT desc");

    $result = $result->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode(array(
        "status" => "success",
        "result" => $result
    ));
} catch (Exception $e) {
    echo json_encode(array(
        "status" => 400,
        "message" => $e->getMessage()
    ));
}
