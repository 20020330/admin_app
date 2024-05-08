<?php
include_once("../db/connection.php");

header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, categoryization, X-Requested-With");

$data = json_decode(file_get_contents("php://input"));

// handle insert data
if ($data != null) {

    $typeHandle = $data->type_handle;

    try {
        $sql = "";

        switch ($typeHandle) {
            case "insert":
            case "update":
                //get data of comic
                $comicTitle = $data->comic_title;
                $comicSubTitle = $data->comic_sub_title;
                $comicThumbnail = $data->comic_thumbnail;
                $comicSynopsis = $data->comic_synopsis;

                $comicCategories = $data->comic_categories;
                $comicAuthor = $data->comic_author;
                $comicCountry = $data->comic_country;

                if ($typeHandle == "insert") {
                    $id = format_uuidv4(random_bytes(16));
                    $sql = "INSERT INTO comic (id, title, sub_title, thumbnail, synopsis, country, author, publish_by) 
                            VALUES ('$id', '$comicTitle', '$comicSubTitle', '$comicThumbnail', '$comicSynopsis', '$comicCountry->id', '$comicAuthor->id', '04bed9f8-180d-11ee-ad27-5414f30d74ff')";
                    $dbConn->exec($sql);

                    foreach ($comicCategories as $itemComic) {
                        $sql = "INSERT INTO comic_category (id_category, id_comic, title_category) 
                            VALUES ('$itemComic->id', '$id', '$itemComic->text')";
                        $dbConn->exec($sql);
                    }
                } else if ($typeHandle == "update") {
                    $id = $data->comic_id;

                    $sql = "UPDATE comic SET title='$comicTitle', sub_title='$comicSubTitle', thumbnail='$comicThumbnail', synopsis='$comicSynopsis', country='$comicCountry->id', author='$comicAuthor->id', publish_by='04bed9f8-180d-11ee-ad27-5414f30d74ff'
                            WHERE id='$id'";
                    $dbConn->exec($sql);

                    //handle categories of comic
                    $sql = "DELETE FROM comic_category WHERE id_comic = '$id'";
                    $deleteResult = $dbConn->exec($sql);
                    if ($deleteResult) {
                        foreach ($comicCategories as $itemComic) {
                            $sql = "INSERT INTO comic_category (id_category, id_comic, title_category) 
                                    VALUES ('$itemComic->id', '$id', '$itemComic->text')";
                            $dbConn->exec($sql);
                        }
                    } else {
                        echo json_encode(
                            array(
                                "status" => "error",
                                "message" => "Lỗi xóa thể loại của truyện có id là $id"
                            )
                        );
                        exit();
                    }
                }
                break;
            case "delete":
                $comicId = $data->comic_id;
                $sql = "DELETE FROM comic_category WHERE id_comic = '$comicId'";
                $deleteResult = $dbConn->exec($sql);
                if ($deleteResult) {
                    $sql = "DELETE FROM comic WHERE id = '$comicId'";
                    $deleteResult = $dbConn->exec($sql);
                } else {
                    echo json_encode(
                        array(
                            "status" => "error",
                            "message" => "Lỗi xóa truyện có id là $comicId"
                        )
                    );
                    exit();
                }
                break;
        }


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

function format_uuidv4($data)
{
    assert(strlen($data) == 16);

    $data[6] = chr(ord($data[6]) & 0x0f | 0x40); // set version to 0100
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80); // set bits 6-7 to 10

    return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
}
