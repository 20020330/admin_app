<?php
include_once("../db/connection.php");

header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$data = json_decode(file_get_contents("php://input"));

// handle insert data
if ($data != null) {

    $authorName = "";
    $authorInfo = "";
    $typeHandle = $data->type_handle;

    try {
        $sql = "";

        switch ($typeHandle) {
            case "insert":
                $authorInfo = $data->author_info;
                $authorName = $data->author_name;

                $sql = "INSERT INTO author (name, info) VALUES ('$authorName', '$authorInfo')";
                break;
            case "update":
                $authorId = $data->author_id;
                $authorInfo = $data->author_info;
                $authorName = $data->author_name;

                $sql = "UPDATE author 
                    SET name='$authorName', info='$authorInfo'
                    WHERE id='$authorId'";
                break;
            case "delete":
                $authorId = $data->author_id;
                $sql = "DELETE FROM author WHERE id='$authorId'";
                break;
        }

        $dbConn->exec($sql);

        echo json_encode(
            array(
                "status" => "success",
                "message" => ""
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
