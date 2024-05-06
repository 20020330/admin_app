<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once("../../db/connection.php");

$page;
$limit;

if (!isset($_GET['page'])) {
    $page = 1;
} else {
    $page = $_GET['page'];
}

if (!isset($_GET['limit'])) {
    $limit = 5;
} else {
    $limit = $_GET['limit'];
}

$totalRow = $dbConn->query("SELECT * FROM comic")->rowCount();

$totalPage = ceil($totalRow / $limit);
$startFrom = ($page - 1) * $limit;

$result = $dbConn->query("SELECT cm.id, cm.title, cm.synopsis, cm.sub_title, cm.thumbnail, group_concat(CONCAT(' ',cm_cate.title_category)) AS `categories`, au.name as author_name, cm.country, us.user_name as publish_by
                            FROM `comic_category` as cm_cate INNER JOIN comic as cm on cm_cate.id_comic = cm.id 
                            INNER JOIN author as au on cm.author = au.id
                            INNER JOIN user as us on cm.PUBLISH_BY = us.id
                            GROUP BY cm_cate.id_comic;
                            LIMIT " . $startFrom . "," . "$limit;");


try {
    echo json_encode(array(
        "status" => "success",
        "result" => $result->fetchAll(PDO::FETCH_ASSOC),
        "total" => $totalRow,
        "total_page" => $totalPage,
        "current_page" => $startFrom + 1
    ));
} catch (Exception $e) {
    echo json_encode(array(
        "status" => "error",
        "message" => $e->getMessage()
    ));
}
