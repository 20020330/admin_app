<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once("../../db/connection.php");

$result = $dbConn->query("SELECT ct.id, ct.title, ct.display_color, ct.create_at, ct.info, ct.thumbnail, count(cm_ct.id_comic) as film_amount FROM category as ct 
                            LEFT JOIN comic_category as cm_ct ON ct.id = cm_ct.id_category
                            GROUP BY ct.id
                            ORDER BY film_amount desc
                            LIMIT 10;");


try {
    echo json_encode(array(
        "status" => "success",
        "result" => $result->fetchAll(PDO::FETCH_ASSOC),
    ));
} catch (Exception $e) {
    echo json_encode(array(
        "status" => "error",
        "message" => $e->getMessage()
    ));
}