<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once("../../db/connection.php");

$comic_id;

if (!isset($_GET['comic_id'])) {
    $comic_id = "";
} else {
    $comic_id = $_GET['comic_id'];
}

$result = $dbConn->query("SELECT cm.id, cm.title, cm.synopsis, cm.sub_title, cm.thumbnail, group_concat(CONCAT(' ',cm_cate.title_category)) AS `categories`, au.name as author_name, cm.country, us.user_name as publish_by
                                FROM `comic_category` as cm_cate inner join comic as cm on cm_cate.id_comic = cm.id 
								inner join author as au on cm.author = au.id
                                inner join user as us on cm.PUBLISH_BY = us.id
                                WHERE cm.id LIKE '$comic_id'
                                GROUP BY cm_cate.id_comic");

$response;
if ($result->columnCount() > 0) {
    $response = $result->fetchAll(PDO::FETCH_OBJ);
} else {
    $response = null;
}

try {
    echo json_encode(array(
        "status" => "success",
        "result" => $response,
    ));
} catch (Exception $e) {
    echo json_encode(array(
        "status" => "error",
        "message" => $e->getMessage()
    ));
}