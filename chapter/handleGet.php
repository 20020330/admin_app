
<?php

include_once("../db/connection.php");

header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


$idComic = $_GET["id_comic"];

try {

    $resultChapterQuery = $dbConn->query("SELECT id, title, id_comic, chapter_index FROM chapter WHERE id_comic = '$idComic' ORDER BY chapter_index");

    $resultList = array();

    while ($row = $resultChapterQuery->fetch(PDO::FETCH_ASSOC)) {
        $resultList[] = $row;
    }

    echo json_encode(
        array(
            "status" => "success",
            "result" => $resultList
        )
    );
} catch (Exception $e) {
    echo json_encode(
        array(
            "status" => "error",
            "message" => $e->getMessage()
        )
    );
}
