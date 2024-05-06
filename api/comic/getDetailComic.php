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

$response = array();

$comicResult = $dbConn->query("SELECT cm.id, cm.title, cm.synopsis, cm.sub_title, cm.thumbnail, group_concat(CONCAT(' ',cm_cate.title_category)) AS `categories`, au.name as author_name, cm.country, us.user_name as publish_by
                                FROM `comic_category` as cm_cate inner join comic as cm on cm_cate.id_comic = cm.id 
                                inner join author as au on cm.author = au.id
                                inner join user as us on cm.PUBLISH_BY = us.id
                                WHERE cm.id LIKE '$comic_id'
                                GROUP BY cm_cate.id_comic;");

$chapterOfComicResult = $dbConn->query("SELECT id, title, chapter_index, content, id_comic, create_at, has_html 
                            FROM comic_app.chapter 
                            WHERE ID_COMIC 
                            LIKE '$comic_id'
                            ORDER BY chapter_index;");

$response["comic"] = $comicResult->fetchAll(PDO::FETCH_ASSOC)[0];
$response["chapters"] = $chapterOfComicResult->fetchAll((PDO::FETCH_ASSOC));

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