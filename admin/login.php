<?php
session_start();
require_once "../config/connection.php";

if (isset($_SESSION['admin_uid']) != "") {
    header("Location: index.php");
}
if (isset($_POST['txtUsername'])) {
    $email = mysqli_real_escape_string($conn, $_POST['txtUsername']);
    $password = mysqli_real_escape_string($conn, $_POST['txtPassword']);

    if (strlen($password) < 6) {
        $password_error = "Password must be minimum of 6 characters";
    }

    $query = "SELECT * FROM tbl_user WHERE Username = '" . $email . "' and Password = '" . $password . "'";
    $result = mysqli_query($conn, $query);
    if ($row = mysqli_fetch_array($result)) {
        $_SESSION['admin_uid'] = $row['LoginId'];
        $_SESSION['admin_name'] = $row['Fullname'];
        $_SESSION['admin_email'] = $row['Email'];
        header("Location: index.php");
    } else {
        $error_message = "Incorrect Email or Password!!!";
    }
}
?>
<html lang="en">
 
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../siteimages/dash/assets/vendor/bootstrap/css/bootstrap.min.css">
    <link href="../siteimages/dash/assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="../siteimages/dash/assets/libs/css/style.css">
    <link rel="stylesheet" href="../siteimages/dash/assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
    <!-- <link rel="icon" type="image/x-icon" href="../assets/img/logo/favicon.png"> -->
    <link rel="shortcut icon" href="../front/images/favicon.png" type="image/x-icon">
    <style>
    html,
    body {
        height: 100%;
    }

    body {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-align: center;
        align-items: center;
        padding-top: 40px;
        padding-bottom: 40px;
    }
    </style>
</head>

<body>
    <!-- ============================================================== -->
    <!-- login page  -->
    <!-- ============================================================== -->
    <div class="splash-container">
        <div class="card ">
            <div class="card-header text-center"><a href="../index.php"><img class="logo-img" src="../front/images/logo2.png" alt="logo" width="150px"></a><span class="splash-description">Administrative Portal</span></div>
            <div class="card-body">
            <span class="text-danger">
                    <?php if (isset($error_message))
                        echo $error_message; ?>
                </span>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group">
                        <input class="form-control form-control-lg" id="txtUsername" name="txtUsername" type="text" placeholder="Username" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <input class="form-control form-control-lg" id="txtPassword" name="txtPassword" type="password" placeholder="Password">
                    </div>
                    <!-- <div class="form-group">
                        <label class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox"><span class="custom-control-label">Remember Me</span>
                        </label>
                    </div> -->
                    <button type="submit" class="btn btn-primary btn-lg btn-block">Sign in</button>
                </form>
            </div>
            <div class="card-footer bg-white p-0  ">
                <!-- <div class="card-footer-item card-footer-item-bordered">
                    <a href="#" class="footer-link">Create An Account</a></div> -->
                <div class="card-footer-item card-footer-item-bordered">
                    <a href="forgot-password.php" class="footer-link">Forgot Password</a>
                </div>
            </div>
        </div>
    </div>
  
    <!-- ============================================================== -->
    <!-- end login page  -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <script src="../siteimages/dash/assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    <script src="../siteimages/dash/assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
</body>
 
</html>