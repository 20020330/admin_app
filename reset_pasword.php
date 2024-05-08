<?php
include_once("./db/connection.php");

if (isset($_POST["btn_submit"])) {
    //POST
    $email = $_POST["email"];
    $token = $_POST["token"];
    $password = $_POST["new_password"];
    $confirmPassword = $_POST["confirm_password"];

    if (empty($email) || empty($token)) {
        header("Location: 404.php");
        exit();
    }

    $result = $dbConn->query("SELECT id_user FROM reset_password
                                WHERE email like '$email' AND token like '$token'
                                AND create_at >= DATE_SUB(NOW(), INTERVAL 1 HOUR)
                                AND is_available = 1");

    $user = $result->fetch(PDO::FETCH_ASSOC);
    if (!$user) {
        header("Location: 404.php");
        exit();
    }

    $newPassword = password_hash($password, PASSWORD_BCRYPT);
    $dbConn->query("update user set password = '$newPassword'
                    where email = '$email'");

    //hủy token
    $dbConn->query("update reset_password set 
                    is_available = 0 
                    where email = '$email'
                    and token = '$token' ");

    session_start();
    session_destroy();

    header("Location: login.php");
} else {
    //GET
    $email = $_GET["email"];
    $token = $_GET["token"];

    if (empty($email) || empty($token)) {
        header("Location: 404.php");
        exit();
    }

    $result = $dbConn->query("SELECT id_user FROM reset_password
                                WHERE email like '$email' AND token like '$token'
                                AND create_at >= DATE_SUB(NOW(), INTERVAL 1 HOUR)
                                AND is_available = 1");

    $user = $result->fetch(PDO::FETCH_ASSOC);
    if (!$user) {
        header("Location: 404.php");
        exit();
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="./assets/img/favicon.png">
    <title>
        Soft UI Dashboard by Creative Tim
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="./assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="./assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="./assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="./assets/css/soft-ui-dashboard.css?v=1.0.7" rel="stylesheet" />
    <!-- Nepcha Analytics (nepcha.com) -->
    <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
    <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
</head>

<body class="">
    <div class="container position-sticky z-index-sticky top-0">
        <div class="row">
            <div class="col-12">

            </div>
        </div>
    </div>
    <main class="main-content  mt-0">
        <section>
            <div class="page-header min-vh-75">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
                            <div class="card card-plain mt-8">
                                <div class="card-header pb-0 text-left bg-transparent">
                                    <h3 class="font-weight-bolder text-info text-gradient">Welcome back</h3>
                                    <p class="mb-0">Nhập mật khẩu mới của bạn</p>
                                </div>
                                <div class="card-body">
                                    <form role="form" id="form" method="post">
                                        <label>Mật khẩu mới</label>
                                        <div class="mb-3">
                                            <input type="password" class="form-control" placeholder="New Password" name="new_password" aria-label="Email" aria-describedby="email-addon">
                                        </div>
                                        <label>Nhập lại mật khẩu mới</label>
                                        <div class="mb-3">
                                            <input type="password" class="form-control" placeholder="ReNew Password" name="confirm_password" aria-label="Password" aria-describedby="password-addon">
                                            <input hidden class="form-control" placeholder="ReNew Password" name="email" aria-label="Password" aria-describedby="password-addon" value="<?php echo $_GET["email"] ?>">
                                            <input hidden class="form-control" placeholder="ReNew Password" name="token" aria-label="Password" aria-describedby="password-addon" value="<?php echo $_GET["token"] ?>">
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" name="btn_submit" class="btn bg-gradient-info w-100 mt-4 mb-0">Đổi mật khẩu</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="oblique position-absolute top-0 h-100 d-md-block d-none me-n8">
                                <div class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6" style="background-image:url('./assets/img/curved-images/curved6.jpg')"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <!-- -------- START FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
    <footer class="footer py-5">
        <div class="container">
            <div class="row">
                <div class="col-8 mx-auto text-center mt-1">
                    <p class="mb-0 text-secondary">
                        Copyright © <script>
                            document.write(new Date().getFullYear())
                        </script> TranVux.
                    </p>
                </div>
            </div>
        </div>
    </footer>
    <!-- -------- END FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
    <!--   Core JS Files   -->
    <script src="./assets/js/core/popper.min.js"></script>
    <script src="./assets/js/core/bootstrap.min.js"></script>
    <script src="./assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="./assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="./assets/js/soft-ui-dashboard.min.js?v=1.0.7"></script>
</body>

</html>