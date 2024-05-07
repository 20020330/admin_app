<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once("../db/connection.php");
$data = json_decode(file_get_contents("php://input"));

$point = 0;
$name = "";

try {

    if (!isset($data->name)) {
        echo json_encode(array(
            "status" => "error",
            "message" => "Không được để trống tên"
        ));
        exit();
    } else if (!isset($data->point)) {
        echo json_encode(array(
            "status" => "error",
            "message" => "Không được để trống điểm"
        ));
        exit();
    } else {
        $point = $data->point;
        $name = $data->name;

        if (!is_numeric($point)) {
            echo json_encode(array(
                "status" => "error",
                "message" => "Điểm phải là 1 số"
            ));
            exit();
        } else if ($point > 10 || $point < 0) {
            echo json_encode(array(
                "status" => "error",
                "message" => "Điểm số phải nằm trong khoảng từ 0 - 10"
            ));
            exit();
        } else {
            $studentResult = $dbConn->query("SELECT id FROM SINH_VIEN WHERE NAME = '$name'");

            if ($studentResult->rowCount() <= 0) {
                echo json_encode(array(
                    "status" => "success",
                    "message" => "Không tồn tại sinh viên có tên $name"
                ));
                exit();
            } else {
                $id = $studentResult->fetch(PDO::FETCH_ASSOC)['id'];
                // echo $id;
                $dbConn->exec(
                    "UPDATE DIEM_TRUNG_BINH SET POINT = $point WHERE STUDENT_ID = '$id'"
                );
                echo json_encode(array(
                    "status" => "success",
                    "message" => "Cập nhật điểm sinh viên $name thành công"
                ));
            }
        }
    }
} catch (Exception $e) {
    echo json_encode(array(
        "status" => "error",
        "message" => $e->getMessage()
    ));
}
