<?php
include_once("../db/connection.php");

header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, categoryization, X-Requested-With");

$data = json_decode(file_get_contents("php://input"));

// handle insert data
if ($data != null) {

    $categoryName = "";
    $categoryInfo = "";
    $categoryColor = "";
    $categoryThumbnail = "";
    $typeHandle = $data->type_handle;

    try {
        $sql = "";

        switch ($typeHandle) {
            case "insert":
                $categoryInfo = $data->category_info;
                $categoryName = $data->category_name;
                $categoryColor = $data->category_color;
                $categoryThumbnail = $data->category_thumbnail;

                $sql = "INSERT INTO category (title, info, display_color, thumbnail) VALUES ('$categoryName', '$categoryInfo', '$categoryColor', '$categoryThumbnail')";
                break;
            case "update":
                $categoryId = $data->category_id;
                $categoryInfo = $data->category_info;
                $categoryName = $data->category_name;
                $categoryColor = $data->category_color;
                $categoryThumbnail = $data->category_thumbnail;

                $sql = "UPDATE category 
                    SET title='$categoryName', info='$categoryInfo', display_color='$categoryColor', thumbnail='$categoryThumbnail'
                    WHERE id='$categoryId'";
                break;
            case "delete":
                $categoryId = $data->category_id;
                $sql = "DELETE FROM category WHERE id='$categoryId'";
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
