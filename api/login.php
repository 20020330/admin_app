<?php
include_once("../db/connection.php");
try {
    $data = json_decode(file_get_contents("php://input"));

    $cl_email = $data->email;
    $cl_password = $data->password;

    $sqlUser = "SELECT * FROM USER WHERE EMAIL = '$cl_email'";
    $userResult = $dbConn->query($sqlUser);

    if ($userResult->rowCount() > 0) {
        $row = $userResult->fetch(PDO::FETCH_ASSOC);
        $password = $row["password"];

        if (!password_verify($cl_password, $password)) {
            echo json_encode(array(
                "status" => "error",
                "message" => "Kiểm tra lại mật khẩu hoặc tài khoản",
            ));
        } else {
            echo json_encode(array(
                "status" => "success",
                "message" => "login success",
                "user" => array(
                    "id" => $row["id"],
                    "user_name" => $row["user_name"],
                    "avatar" => $row["avatar"],
                    "email" => $cl_email,
                    "uid" => $row["uid"]
                )
            ));
        }
    } else {
        echo json_encode(array(
            "status" => "error",
            "message" => "Kiểm tra lại mật khẩu hoặc tài khoản",
        ));
    }
} catch (Exception $e) {
    echo json_encode(array(
        "status" => "error",
        "message" => $e->getMessage(),
    ));
}