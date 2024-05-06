<?php
include_once("../db/connection.php");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

try {
    $comics = $dbConn->query("SELECT cm.title, cm.synopsis, cm.sub_title, cm.id, cm.thumbnail, group_concat(CONCAT(' ',cm_cate.title_category)) AS `categories`, au.name, cm.country, us.user_name
    FROM `comic_category` as cm_cate inner join comic as cm on cm_cate.id_comic = cm.id 
                                     inner join author as au on cm.author = au.id
                                     inner join user as us on cm.publish_by = us.id
    GROUP BY cm_cate.id_comic")->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode(array(
        "status" => "success",
        "result" => $comics,
    ));
} catch (Exception $e) {
    echo json_encode(array(
        "status" => "error",
        "message" => $e->getMessage()
    ));
}