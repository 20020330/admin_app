<?php
include_once("../db/connection.php");

header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$data = json_decode(file_get_contents("php://input"));

// handle insert data
if ($data != null) {

    $typeHandle = $data->type_handle;

    try {
        $sql = "";
        switch ($typeHandle) {
            case "insert":
            case "update":

                $chapterTitle = $data->chapter_title;
                $chapterIndex = $data->chapter_index;
                $chapterContent = $data->chapter_content;
                $chapterComic = $data->chapter_comic;
                $hasHTML = $data->has_html;

                if ($typeHandle == "insert") {
                    $sql = "INSERT INTO chapter (title, chapter_index, content, id_comic, has_html) 
                            VALUES ('$chapterTitle', $chapterIndex, '$chapterContent', '$chapterComic->id', $hasHTML)";
                } else if ($typeHandle == "update") {
                    $chapterId = $data->chapter_id;
                    $sql = "UPDATE chapter 
                            SET title='$chapterTitle', chapter_index='$chapterIndex', content='$chapterContent', id_comic='$chapterComic->id', has_html=$hasHTML
                            WHERE id = '$chapterId'";
                }

                $resultQuery = $dbConn->exec($sql);
                if (!$resultQuery) {
                    echo json_encode(
                        array(
                            "status" => "error",
                            "message" => $e->getMessage()
                        )
                    );
                    exit();
                }
                break;
            case "delete":
                $chapterId = $data->chapter_id;
                $sql = "DELETE FROM chapter WHERE id='$chapterId'";
                $dbConn->exec($sql);
                break;
        }


        echo json_encode(
            array(
                "status" => "success",
                "message" => "Thêm chương thành công!"
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
}
