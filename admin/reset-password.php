<!doctype html>
<html lang="en">
<?php include 'includes/header.php'; ?>
<style>
    .table thead th,
    .table th {
        color: white !important;
        font-family: 'Circular Std Medium';
        background-color: black !important;
    }
</style>

<body>
    <!-- ============================================================== -->
    <!-- main wrapper -->
    <!-- ============================================================== -->
    <div class="dashboard-main-wrapper">
        <!-- ============================================================== -->
        <!-- navbar -->
        <!-- ============================================================== -->

        <?php include 'includes/top-bar.php'; ?>
        <!-- ============================================================== -->
        <!-- end navbar -->
        <!-- ============================================================== -->
        <?php include 'includes/sidebar.php'; ?>


        <!-- ============================================================== -->
        <!-- wrapper  -->
        <!-- ============================================================== -->
        <div class="dashboard-wrapper">
            <div class="dashboard-ecommerce">
                <div class="container-fluid dashboard-content ">
                    <!-- ============================================================== -->
                    <!-- pageheader  -->
                    <!-- ============================================================== -->

                    <div class="row">



                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="card">
                                <h5 class="card-header"> Reset Password</h5>
                                <div class="card-body">
                                    <form method="post" action="#" id="basicform" data-parsley-validate="">

                                        <div class="form-row">
                                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-2">
                                                <label for="txtOldPassword">Old Password</label>
                                                <input id="txtOldPassword" name="txtOldPassword" type="password"
                                                    required="" placeholder="Old Password" class="form-control"
                                                    maxlength="32">
                                            </div>
                                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-2">
                                                <label for="txtPass">New Password</label>
                                                <input type="password" class="form-control" id="txtPass" name="txtPass"
                                                    placeholder="Enter Password" maxlength="32" required>

                                            </div>
                                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-2">
                                                <label for="txtRepeatPassword">Confirm New Password</label>
                                                <input id="txtRepeatPassword" name="txtRepeatPassword" type="password"
                                                    required="" placeholder="Confirm Password" class="form-control"
                                                    maxlength="32" onblur="validate()">
                                                <span class="text-danger" id="spnRepMsg"></span>
                                            </div>

                                        </div>
                                        <div class="form-row">
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-2">
                                                <p class="text-center">
                                                    <button type="submit"
                                                        class="btn btn-space btn-primary">Reset</button>
                                                </p>

                                            </div>

                                        </div>

                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
        <!-- footer -->
        <?php include 'includes/footer.php'; ?>
    </div>
    <!-- ============================================================== -->
    <!-- end wrapper  -->
    <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- end main wrapper  -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <?php include 'includes/footer-js.php'; ?>



</body>

<?php
include '../config/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $oldpassword = $_POST["txtOldPassword"];

    $pwd = $_POST["txtPass"];

    $adminid = $_SESSION['admin_uid'];
    $oldie = "";
    if (isset($_SESSION['admin_uid'])) {

        $query = "SELECT * FROM tbl_user WHERE LoginId = " . $ownerid;

        $result = mysqli_query($conn, $query);
        if ($row = mysqli_fetch_array($result)) {
            $oldie = $row['Password'];
        } else {
            $oldie = "";
        }

        
        if ($oldie == $oldpassword && $ownerid > 0) {

            $sql = "UPDATE tbl_user SET Password='$pwd'
        WHERE LoginId=$ownerid";

            echo $sql;

            $result = $conn->query($sql);
            if ($conn->query($sql) === TRUE) {
                echo "<script>";
                echo "alert('Password updated successfully');";
                echo "window.location='index.php'";
                echo "</script>";
            } else {
                echo "Error updating user details: " . $conn->error;
            }
        } else {

        }
    }




}
?>


<script>
    function validate() {
        var x = document.getElementById("txtPass");
        var y = document.getElementById("txtRepeatPassword");
        if (x.value == y.value) {
            document.getElementById("spnRepMsg").innerHTML = "";
            return;
        }
        else {
            document.getElementById("spnRepMsg").innerHTML = "Password not same!";
        }
    }
</script>

</html>