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