<!doctype html>


<html lang="en">
<?php include 'includes/header.php'; 

?>

<?php
include "../config/connection.php";
$LoginID = $_SESSION['admin_uid'];

// Check if the form is submitted and the 'id' parameter is set
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $LoginID;
    $name = $_POST['txtName'];
    $email = $_POST['txtEmail'];
    $Username = $_POST['txtUsername'];


    $duplicatesql = "select * from tbl_user where Username='$Username' and  Loginid<>'$id'";

    $result = $conn->query($duplicatesql);
    if ($result->num_rows > 0) {
        echo "<script >";
        echo "alert('Duplicate user found');";
        echo "</script>";
    } else {

        // Update customer details in the database
        $sql = "UPDATE tbl_user SET Fullname='$name',Email='$email',Username='$Username'
                WHERE LoginId=$id";

        $result = $conn->query($sql);

        if ($conn->query($sql) === TRUE) {
            echo "Your details updated successfully";
            header("Location: index.php");
        } else {
            echo "Error updating owner details: " . $conn->error;
        }
    }
} else {
    echo "Invalid request. Please submit the form.";
}

?>

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
                            <?php

                            // Check if the 'id' parameter is set in the query string
                            if (isset($LoginID)) {

                                // Fetch customer details based on the provided ID
                                $sql = "SELECT * FROM tbl_user WHERE Loginid = $LoginID";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    $row = $result->fetch_assoc();
                                    ?>
                                    <div class="card">
                                        <h5 class="card-header"> Edit Profile - <b>Username:
                                                <?php echo $row['Username']; ?>
                                            </b></h5>
                                        <div class="card-body">

                                            <form action="" method="POST" id="basicform" data-parsley-validate="">
                                                <div class="form-row">
                                                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-2">
                                                        <label for="txtName">Full Name</label>
                                                        <input type="text" class="form-control" id="txtName" name="txtName"
                                                            data-parsley-trigger="change" placeholder="Enter Full name"
                                                            value="<?php echo $row['Fullname']; ?>" required>

                                                    </div>
                                                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-2">
                                                        <label for="txtEmail">Email</label>
                                                        <input type="email" class="form-control" id="txtEmail" name="txtEmail"
                                                            value="<?php echo $row['Email']; ?>" placeholder="Enter email"
                                                            required>

                                                    </div>
                                                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-2">
                                                        <label for="txtUsername">User Name</label>
                                                        <input type="text" class="form-control" id="txtUsername"
                                                            name="txtUsername" value="<?php echo $row['Username']; ?>"
                                                            placeholder="Enter User Name" required>
                                                    </div>
                                                </div>


                                        </div>


                                        <div class="form-row">
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-2">
                                                <p class="text-center">
                                                    <button type="submit" class="btn btn-space btn-primary">Update
                                                        Profile</button>
                                                </p>

                                            </div>

                                        </div>

                                        </form>

                                    </div>
                                </div>
                                <?php
                                } else {
                                    echo "Owner not found.";
                                }
                            } else {
                                echo "Invalid request. Please provide a owner ID.";
                            }
                            ?>
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

    <script type="text/javascript">
        var specialKeys = new Array();
        specialKeys.push(8); //Backspace

        function IsNumericPhone(e, spanid) {
            var keyCode = e.which ? e.which : e.keyCode
            var ret = ((keyCode >= 48 && keyCode <= 57) || specialKeys.indexOf(keyCode) != -1);
            //document.getElementById(spanid).style.display = ret ? "none" : "inline";
            return ret;
        }
    </script>

</body>



</html>