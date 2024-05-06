<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once("../../db/connection.php");
include_once("../../mock/email.php");

use PHPMailer\PHPMailer\PHPMailer;

include_once '../../utilities/PHPMailer-master/src/PHPMailer.php';
include_once '../../utilities/PHPMailer-master/src/SMTP.php';
include_once '../../utilities/PHPMailer-master/src/Exception.php';
try {
    // lay mail tu body
    $data = json_decode(file_get_contents("php://input"));
    $email = $data->email;
    //kt mail co ton tai ko
    $result = $dbConn->query("select id from user where email like '$email'");
    $user = $result->fetch(PDO::FETCH_ASSOC);
    $userId = $user["id"];
    if (!$user) {
        throw new Exception("Email khong ton tai");
    }
    // tao token
    $token = md5(time() . $email);
    //luu token vao database

    $link = "http://127.0.0.1:3000/verify_account.php?email=$email";
    $mail = new PHPMailer();
    $mail->CharSet = "utf-8";
    $mail->isSMTP();
    $mail->SMTPAuth = true;
    $mail->Username = "vutran789jjjj";
    $mail->Password = "byaobfidnumjksdk";
    $mail->SMTPSecure = "ssl";
    $mail->Host = "ssl://smtp.gmail.com";
    $mail->Port = "465";
    $mail->From = "vutran789jjjj@gmail.com";
    $mail->FromName = "TranVux";
    $mail->addAddress("vutran789jjjj@gmail.com", 'Hello');
    $mail->Subject = "Verify Your Account";
    $mail->isHTML(true);
    $mail->Body = getTempMail($link, "Xác thực tài khoản");
    $res = $mail->Send();

    if ($res) {
        echo json_encode(array(
            "status" => 200,
            "message" => "Email send."
        ));
    } else {
        echo json_encode(array(
            "status" => 400,
            "message" => "Email send failed."
        ));
    }
} catch (Exception $e) {
    echo json_encode(array(
        "status" => 400,
        "message" => $e->getMessage()
    ));
}
