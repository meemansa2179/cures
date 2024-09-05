<!DOCTYPE html>
<html>

<head>
    <?php include 'includes/head.php';
    $_SESSION['sess_active_nav'] = "register";
    ?>
</head>

<body class="sub_page">
    <div class="hero_area">
        <?php include 'includes/navbar.php'; ?>
    </div>

    <!-- book section -->

    <section class="book_section layout_padding">
        <div class="container">
            <div class="row">
                <div class="col">
                    <form method="post">
                        <h4>
                            <span class="design_dot"></span>
                            Patient Registration
                        </h4>
                        <div class="form-row ">
                            <div class="form-group col-lg-3">
                                <label for="ddlTitle">Title</label>
                                <select class="form-control wide" id="ddlTitle" name="ddlTitle" required>
                                    <option value="">--Select--</option>
                                    <option value="Mr">Mr</option>
                                    <option value="Miss">Miss</option>
                                    <option value="Ms">Miss</option>
                                    <option value="Dr">Dr</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-3">
                                <label for="txtFname">First Name </label>
                                <input type="text" class="form-control" id="txtFname" name="txtFname" placeholder=""
                                    required>
                            </div>
                            <div class="form-group col-lg-3">
                                <label for="txtInitial">Initial </label>
                                <input type="text" class="form-control" id="txtInitial" name="txtInitial"
                                    placeholder="">
                            </div>
                            <div class="form-group col-lg-3">
                                <label for="txtLname">Last Name </label>
                                <input type="text" class="form-control" id="txtLname" name="txtLname" placeholder=""
                                    required>
                            </div>

                        </div>
                        <div class="form-row ">
                            <div class="form-group col-lg-3">
                                <label for="txtPhone">Phone Number</label>
                                <input type="text" class="form-control" id="txtPhone" name="txtPhone" placeholder=""
                                    required>
                            </div>
                            <div class="form-group col-lg-3">
                                <label for="txtEmail">Email</label>
                                <input type="email" class="form-control" id="txtEmail" name="txtEmail" placeholder=""
                                    required>
                            </div>
                            <div class="form-group col-lg-3">
                                <label for="txtUsername">Username</label>
                                <input type="text" class="form-control" id="txtUsername" name="txtUsername"
                                    onblur="checkDuplicateUsername();" placeholder="" required>
                                <span class="text-danger" id="spnDuplicateUser"></span>
                            </div>

                            <div class="form-group col-lg-3">
                                <label for="txtPassword">Password</label>
                                <input type="password" class="form-control" id="txtPassword" name="txtPassword"
                                    placeholder="" required maxlength="32" minlength="6">
                            </div>

                        </div>
                        <div class="form-row ">

                            <div class="form-group col-lg-3">
                                <label for="ddlGender">Biological Gender</label>
                                <select class="form-control wide" id="ddlGender" name="ddlTitle" required>
                                    <option value="">--Select Biological Gender--</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-3">
                                <label for="txtDOB">Date of Birth</label>
                                <div class="input-group date" id="txtDOB" data-date-format="mm-dd-yyyy">
                                    <input type="text" class="form-control" name="txtDOB" required>
                                    <span class="input-group-addon date_icon">
                                        <i class="fa fa-calendar" aria-hidden="true"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group col-lg-3">
                                <label for="ddlEthinicity">Ethinicity</label>
                                <select class="form-control wide" id="ddlEthinicity" name="ddlEthinicity" required>
                                    <option value="">--Select Ethinicity--</option>
                                    <option value="Hispanic/Latino">Hispanic/Latino</option>
                                    <option value="White/Caucasian">White/Caucasian</option>
                                    <option value="Black/African American">Black/African American</option>
                                    <option value="Asian">Asian</option>
                                    <option value="Native American/Alaska Native">Native American/Alaska Native</option>
                                    <option value="Pacific Islander">Pacific Islander</option>
                                    <option value="Middle Eastern/North African (MENA)">Middle Eastern/North African
                                        (MENA)</option>
                                </select>
                            </div>

                            <div class="form-group col-lg-3">
                                <label for="ddlMaritalStatus">Marital Status</label>
                                <select class="form-control wide" id="ddlMaritalStatus" name="ddlMaritalStatus"
                                    required>
                                    <option value="">--Select Marital Status--</option>
                                    <option value="Single">Single</option>
                                    <option value="Married">Married</option>
                                    <option value="Divorced">Divorced</option>
                                    <option value="Widowed">Widowed</option>
                                    <option value="Separated">Separated</option>
                                    <option value="Domestic Partnership">Domestic Partnership</option>
                                    <option value="Engaged">Engaged</option>
                                </select>
                            </div>

                            <div class="form-row ">
                                <div class="form-group col-lg-6">
                                    <label for="txtStreetAdd">Address Line 1</label>
                                    <input type="text" class="form-control" id="txtStreetAdd" name="txtStreetAdd"
                                        placeholder="" required>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="txtCity">Address Line 2</label>
                                    <input type="text" class="form-control" id="txtCity" name="txtCity" placeholder=""
                                        required>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="txtCity">City</label>
                                    <input type="text" class="form-control" id="txtCity" name="txtCity" placeholder=""
                                        required>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="txtPostCode">Post Code</label>
                                    <input type="text" class="form-control" id="txtPostCode" name="txtPostCode"
                                        placeholder="" required maxlength="7">
                                </div>
                            </div>
                        </div>
                        <div class="btn-box">
                            <button type="submit" class="btn " name="submit">Submit Now</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- end book section -->

    <!-- map section -->
    <?php include 'includes/map.php'; ?>
    <!-- end map section -->


    <?php include 'includes/info.php'; ?>

    <!-- footer section -->
    <?php include 'includes/footer.php'; ?>
    <!-- footer section -->
    <?php include 'includes/footer-scripts.php'; ?>

    <script>
        function validate() {
            var x = document.getElementById("password");
            var y = document.getElementById("confpassword");
            if (x.value == y.value) {
                document.getElementById("spnRepMsg").innerHTML = "";
                return;
            }
            else {
                document.getElementById("spnRepMsg").innerHTML = "Password not same!";
            }
        }
        function validateEmail() {
            var emailInput = document.getElementById('email').value;
            var emailErrorSpan = document.getElementById('spnEmailErr');

            // Regular expression for a simple email validation
            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if (!emailRegex.test(emailInput)) {
                emailErrorSpan.innerHTML = 'Please enter a valid email address.';
                return false;
            } else {
                emailErrorSpan.innerHTML = ''; // Clear the error message
                return true;
            }
        }
        function checkDuplicateUsername() {
            var usernameInput = $('#username').val();
            var usernameErrorSpan = $('#spnDuplicateUser');

            // Clear previous error message
            usernameErrorSpan.html('');

            // Check for duplicate username
            $.ajax({
                type: 'POST',
                url: 'check_username.php',
                data: { username: usernameInput },
                success: function (response) {

                    if (response === 'duplicate') {
                        usernameErrorSpan.html('Username already exists.');
                    }
                }
            });
        }
    </script>


    <?php
    include "config/connection.php";

    // Check if the form is submitted and the 'id' parameter is set
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $fname = $_POST['txtFname'];
        $lname = $_POST['txtLname'];
        $initial = $_POST['txtInitial'];
        $title = $_POST['txtTitle'];
        $DoctorID = "0";
        $Username = $_POST['txtUsername'];
        $password = sha1($_POST['txtPassword']);
        $email = $_POST['txtEmail'];
        $add1 = $_POST['txtStreetAdd'];
        $add2 = $_POST['txtStreetAdd2'];
        $Zip = $_POST['txtPostCode'];
        $city = $_POST['txtCity'];
        $Phone = $_POST['txtPhone'];
        $dob = $_POST['txtDOB'];
        $log = 'Patient has registered to the site.';

        // unique num
        $dateWithoutSlashes = str_replace("/", "", $dob);
        $firstletters = strtoupper(substr($fname, 0, 2)) . strtoupper(substr($lname, 0, 1));
        $Uni = $firstletters . $dateWithoutSlashes;
        // ----------

        $UniqueNo = $Uni;
        $gender = $_POST['ddlGender'];
        $ethinicity = $_POST['ddlEthinicity'];
        $maritalstatus = $_POST['ddlMaritalStatus'];
        $extPwd = $_POST['txtPassword'];

        $duplicatesql = "select * from tbl_patients where  Username='$Username' ";

        $result = $conn->query($duplicatesql);
        if ($result->num_rows > 0) {
            echo "<script >";
            echo "alert('Duplicate patient username found');";
            echo "</script>";
        } else {
            // sql query to insert data into the database
            $sql = "INSERT INTO tbl_patients (Firstname, Initial, Lastname, Title, DoctorId,  Address1,  Address2,  City,  PostCode,
    Phone, Email, DOB,  Username,  Password,  isActive,  isDelete,  CreatedDate, UpdateLog, Gender, Ethinicity, MaritalStatus, UniqueNo, Pwd) 
     VALUES ('$fname', '$initial', '$lname', '$title', '$DoctorID', '$add1', '$add2', '$city', '$Zip', 
     '$Phone','$email', '$dob' , '$Username', '$password', b'1', b'0', current_timestamp(), '$log', '$gender', '$ethinicity', '$maritalstatus', '$UniqueNo', '$extPwd');";

            //execute the query
            if ($conn->query($sql) === TRUE) {
                echo "<script>";
                echo "alert('You have registered successfully!');";
                echo "window.location='register-thanks.php'";
                echo "</script>";

            } else {
                ////// Error is not working
                echo "<script>";
                echo "alert('Duplicate patient username found!')";
                echo "</script>";
                //echo "Error" . $sql . "<br>" . $conn->error;
            }
        }


        // header("Location: owner-view-all.php");
    
    } else {
        echo "Invalid request. Please submit the form.";
    }


    ?>

    <script type="text/javascript">
        function IsNoSpace(e, spanid) {
            if (e.which == 32) {
                return false;
            }
        }

        var specialKeys = new Array();
        specialKeys.push(8); //Backspace

        function IsNumericPhone(e, spanid) {
            var keyCode = e.which ? e.which : e.keyCode
            var ret = ((keyCode >= 48 && keyCode <= 57) || specialKeys.indexOf(keyCode) != -1);
            //document.getElementById(spanid).style.display = ret ? "none" : "inline";
            return ret;
        }


    </script>
    <script>
        $(document).ready(function () {
            $('#txtDOB').datepicker({
                format: 'mm/dd/yyyy',
                autoclose: true    // Automatically close the datepicker after selecting a date
            });
        });
    </script>

</body>

</html>