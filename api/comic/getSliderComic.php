<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once("../../db/connection.php");


$result = $dbConn->query("SELECT cm.id, cm.title, cm.synopsis, cm.sub_title, cm.thumbnail, group_concat(CONCAT(' ',cm_cate.title_category)) AS `categories`, au.name as author_name, cm.country, us.user_name as publish_by
                            FROM `comic_category` as cm_cate INNER JOIN comic as cm on cm_cate.id_comic = cm.id 
                            INNER JOIN author as au on cm.author = au.id
                            INNER JOIN user as us on cm.PUBLISH_BY = us.id
                            GROUP BY cm_cate.id_comic;
                            ORDER BY cm.create_at desc 
                            LIMIT 5;");


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