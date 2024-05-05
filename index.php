<!DOCTYPE html>
<html lang="en">

<?php
//kiểm tra nếu có session thì sẽ ở lại ko thì chuyển sang login

session_start();

// if (!isset($_SESSION["email"])) {
//   header("Location: login.php");
// }

include_once (__DIR__ .'\\db\\connection.php');
// $result = $dbConn->query("SELECT id, name, price, quantity, image FROM products");

?>

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="./assets/img/favicon.png">
  <title>
    Dashboard Comic App
  </title>