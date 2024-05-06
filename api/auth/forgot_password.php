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
    $dbConn->query("insert into reset_password(id_user, email,token) values('$userId', '$email','$token')");

