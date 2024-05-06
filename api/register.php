<?php
include_once("../db/connection.php");
try {
    $body = json_decode(file_get_contents("php://input"));

    $email = $body->email;
    $password = $body->password;
    $name = $body->user_name;

    if (empty($email) || empty($password) || empty($name)) {
        echo json_encode(array(
            "status" => "error",
            "message" => "Nhập đầy đủ email, password và user_name",
        ));
        return;
    } else {
        $user = $dbConn->query("SELECT email FROM user WHERE email = '$email'");

        if ($user->rowCount() > 0) {
            echo json_encode(array(
                "status" => "error",
                "message" => "Tài khoản đã tồn tại",
            ));
        } else {
            //thêm tài khoản
            $password = password_hash($password, PASSWORD_BCRYPT);
            $dbConn->exec("INSERT INTO user (user_name, email, password) VALUES ('$name', '$email', '$password')");
            echo json_encode(array(
                "status" => "success",
                "message" => "success",
                "user" => array(
                    "user_name" => $name,
                    "email" => $email,
                )
            ));
        }
    }
} catch (Exception $e) {
    echo json_encode(array(
        "status" => "error",
        "message" => $e->getMessage(),
    ));
}
