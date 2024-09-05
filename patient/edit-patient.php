<!doctype html>


<html lang="en">
<?php include 'includes/header.php'; ?>

<?php
include "../config/connection.php";

// Check if the form is submitted and the 'id' parameter is set
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET['id'])) {
    $id = $_GET['id'];
    $fname = $_POST['txtFname'];
    $lname = $_POST['txtLname'];
    $initial = $_POST['txtInitial'];
    $title = $_POST['txtTitle'];
    $DoctorID = $_POST['ddlDoctor'];
    $Username = $_POST['txtUsername'];
    $password = $_POST['txtPassword'];

    $PwdQRY = "";
    if (strlen($password) > 0) {
        $PwdQRY = ", password='" . $password . "' ";
    }

    $email = $_POST['txtEmail'];
    $add1 = $_POST['txtStreetAdd'];
    $add2 = $_POST['txtStreetAdd2'];
    $Zip = $_POST['txtPostCode'];
    $city = $_POST['txtCity'];
    $Phone = $_POST['txtPhone'];
    $dob = $_POST['txtDOB'];
    
    $log = $AdminName . ' has updated this patient';

    $UniqueNo = $_POST['txtUniqueNum'];
    $gender = $_POST['ddlGender'];
    $ethinicity = $_POST['ddlEthinicity'];
    $maritalstatus = $_POST['ddlMaritalStatus'];

    $isActive = 0;
    if (isset($_POST['chkActive'])) {
        $isActive = '1';
    } else {
        $isActive = '0';
    }


    $duplicatesql = "select * from tbl_patients where  Username='$Username' and PatientId<>$id";

    $result = $conn->query($duplicatesql);
    if ($result->num_rows > 0) {
        echo "<script >";
        echo "alert('Duplicate patient username found');";
        echo "</script>";
    } else {

        // Update customer details in the database
        $sql = "UPDATE tbl_patients SET Firstname='$fname', Initial='$initial', Lastname='$lname', Title='$title', RoleType='$roletype',
                Address1='$add1', Address2='$add2',City='$city', PostCode='$Zip', 
                Email='$email',Phone='$Phone', Username='$Username', DOB='$dob', Specialization='$specialization',
                Notes='$notes', UpdateLog='$log', isActive=b'$isActive'  $PwdQRY 
                WHERE DoctorId=$id";

        echo $sql;
        $result = $conn->query($sql);

        if ($conn->query($sql) === TRUE) {
            echo "patient details updated successfully";
            header("Location: patient-view-all.php");
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
                            include "../config/connection.php";

                            // Check if the 'id' parameter is set in the query string
                            if (isset($_GET['id']) && $_GET['id'] > 0) {
                                $id = $_GET['id'];

                                // Fetch customer details based on the provided ID
                                $sql = "SELECT * FROM tbl_patients WHERE PatientId = $id";

                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    $row = $result->fetch_assoc();

                                    ?>
                                    <div class="card">
                                        <h5 class="card-header"> Patient Details</h5>
                                        <div class="card-body">

                                            <form action="" method="POST" id="basicform" data-parsley-validate="">
                                                <div class="form-row">
                                                    <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 col-12 mb-2">
                                                        <label for="txtTitle">Title</label>
                                                        <select id="txtTitle" name="txtTitle" required class="form-control">
                                                            <option value="">--Select--</option>
                                                            <option value="Mr" <?php if ($row['Title'] == "Mr") {
                                                                echo 'selected';
                                                            } ?>>Mr</option>
                                                            <option value="Miss" <?php if ($row['Title'] == "Miss") {
                                                                echo 'selected';
                                                            } ?>>Miss</option>
                                                            <option value="Ms" <?php if ($row['Title'] == "Ms") {
                                                                echo 'selected';
                                                            } ?>>Miss</option>
                                                            <option value="Dr" <?php if ($row['Title'] == "Dr") {
                                                                echo 'selected';
                                                            } ?>>Dr</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-2">
                                                        <label for="txtFname">First Name</label>
                                                        <input type="text" class="form-control" id="txtFname" name="txtFname"
                                                            value="<?php echo $row['Firstname']; ?>"
                                                            placeholder="Enter First name" required>
                                                    </div>
                                                    <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 col-12 mb-2">
                                                        <label for="txtInitial">Initial</label>
                                                        <input type="text" class="form-control" id="txtInitial"
                                                            name="txtInitial" value="<?php echo $row['Initial']; ?>"
                                                            placeholder="Enter Initial" required>
                                                    </div>
                                                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-2">
                                                        <label for="txtLname">Last Name</label>
                                                        <input type="text" class="form-control" id="txtLname" name="txtLname"
                                                            value="<?php echo $row['Lastname']; ?>"
                                                            placeholder="Enter Last name" required>
                                                    </div>
                                                </div>
                                                <div class="form-row mt-2">
                                                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-2">
                                                        <label for="txtSeats">Email</label>
                                                        <input type="email" class="form-control" id="txtEmail" name="txtEmail"
                                                            placeholder="Enter email" required
                                                            value="<?php echo $row['Email']; ?>">
                                                    </div>
                                                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-2">
                                                        <label for="txtUsername">User Name</label>
                                                        <input type="text" class="form-control" id="txtUsername"
                                                            name="txtUsername" value="<?php echo $row['Username']; ?>"
                                                            placeholder="Enter User Name" required>
                                                    </div>
                                                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-2">
                                                        <label for="txtPassword">Password</label>
                                                        <input type="text" class="form-control" id="txtPassword"
                                                            name="txtPassword" placeholder="Enter Password">
                                                    </div>
                                                </div>
                                                <div class="form-row mt-2">
                                                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-6 mb-2">
                                                        <label for="ddlDoctor">Oncologist</label>
                                                        <select id="ddlDoctor" name="ddlDoctor" required class="form-control">
                                                            <option value="">--Select--</option>
                                                            <?php
                                                            $sql = "select * from tbl_physicians where roletype='Oncologist' and isActive='1' and isDelete='0' ";
                                                            $result = $conn->query($sql);
                                                            if ($result->num_rows > 0) {
                                                                while ($ddlrow = $result->fetch_assoc()) {
                                                                    ?>
                                                                    <option value='<?php echo $ddlrow['DoctorId'] ?>' <?php if ($row['DoctorId'] == $ddlrow['DoctorId']) {
                                                                           echo 'selected';
                                                                       } ?>>
                                                                        <?php echo 'Dr. ' . $ddlrow['Firstname'] . $ddlrow['Initial'] . ' ' . $ddlrow['Lastname'] ?>
                                                                    </option>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>

                                                        </select>
                                                    </div>

                                                    <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 col-12 mb-2">
                                                        <label for="txtPhone">Phone #</label>
                                                        <input type="text" class="form-control" id="txtPhone" name="txtPhone"
                                                            placeholder="Enter Phone" maxlength="12" required
                                                            value="<?php echo $row['Phone']; ?>">
                                                    </div>
                                                    <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 col-12 mb-2">
                                                        <label for="txtDOB">Date of birth</label>
                                                        <input type="date" class="form-control" id="txtDOB" name="txtDOB"
                                                            required value="<?php echo $row['DOB']; ?>">
                                                    </div>
                                                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-2">
                                                        <label for="txtUniqueNum">Unique No</label>
                                                        <input type="text" class="form-control" id="txtUniqueNum"
                                                            value="<?php echo $row['UniqueNo']; ?>" name="txtUniqueNum"
                                                            placeholder="Enter Unique No" maxlength="12" required>
                                                    </div>


                                                </div>
                                                <div class="form-row mb">
                                                    <?php
                                                    $whetherisActive = $row['isActive'];
                                                    //echo $whetherisActive;
                                                    ?>
                                                    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 mb-2  mt-3">
                                                        <div class="form-group">
                                                            <label class="custom-control custom-checkbox">
                                                                <input class="custom-control-input" type="checkbox" <?php echo ($whetherisActive == 1 ? 'checked' : ''); ?>
                                                                    name="chkActive"><span
                                                                    class="custom-control-label">Active</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-row mt-2">
                                                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-2">
                                                        <label for="ddlGender">Gender</label>
                                                        <select id="ddlGender" name="ddlGender" required class="form-control">
                                                            <option value="">--Select Gender--</option>
                                                            <option value="Male" <?php if ($row['Gender'] == "Male") { echo 'selected'; } ?>>Male</option>
                                                            <option value="Female" <?php if ($row['Gender'] == "Female") { echo 'selected'; } ?>>Female</option>
                                                            <option value="N/A" <?php if ($row['Gender'] == "N/A") { echo 'selected'; } ?>>Prefer not to say</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-2">
                                                        <label for="ddlEthinicity">Ethinicity</label>
                                                        <select id="ddlEthinicity" name="ddlEthinicity" required
                                                            class="form-control">
                                                            <option value="">--Select Ethinicity--</option>
                                                            <option value="Hispanic/Latino" <?php if ($row['Ethinicity'] == "Hispanic/Latino") { echo 'selected'; } ?>>Hispanic/Latino</option>
                                                            <option value="White/Caucasian" <?php if ($row['Ethinicity'] == "White/Caucasian") { echo 'selected'; } ?>>White/Caucasian</option>
                                                            <option value="Black/African American" <?php if ($row['Ethinicity'] == "Black/African American") { echo 'selected'; } ?>>Black/African American
                                                            </option>
                                                            <option value="Asian" <?php if ($row['Ethinicity'] == "Asian") { echo 'selected'; } ?>>Asian</option>
                                                            <option value="Native American/Alaska Native" <?php if ($row['Ethinicity'] == "Native American/Alaska Native") { echo 'selected'; } ?>>Native American/Alaska
                                                                Native</option>
                                                            <option value="Pacific Islander" <?php if ($row['Ethinicity'] == "Pacific Islander") { echo 'selected'; } ?>>Pacific Islander</option>
                                                            <option value="Middle Eastern/North African (MENA)" <?php if ($row['Ethinicity'] == "Middle Eastern/North African (MENA)") { echo 'selected'; } ?>>Middle
                                                                Eastern/North African (MENA)</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-2">
                                                        <label for="ddlMaritalStatus">Marital Status</label>
                                                        <select id="ddlMaritalStatus" name="ddlMaritalStatus" required
                                                            class="form-control">
                                                            <option value="">--Select Marital Status--</option>
                                                            <option value="Single" <?php if ($row['MaritalStatus'] == "Single") { echo 'selected'; } ?>>Single</option>
                                                            <option value="Married" <?php if ($row['MaritalStatus'] == "Married") { echo 'selected'; } ?>>Married</option>
                                                            <option value="Divorced" <?php if ($row['MaritalStatus'] == "Divorced") { echo 'selected'; } ?>>Divorced</option>
                                                            <option value="Widowed" <?php if ($row['MaritalStatus'] == "Widowed") { echo 'selected'; } ?>>Widowed</option>
                                                            <option value="Separated" <?php if ($row['MaritalStatus'] == "Separated") { echo 'selected'; } ?>>Separated</option>
                                                            <option value="Domestic Partnership" <?php if ($row['MaritalStatus'] == "Domestic Partnership") { echo 'selected'; } ?>>Domestic Partnership</option>
                                                            <option value="Engaged"<?php if ($row['MaritalStatus'] == "Engaged") { echo 'selected'; } ?>>Engaged</option>
                                                        </select>
                                                    </div>

                                                </div>
                                                <hr />
                                                <div class="form-row mb">
                                                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2">
                                                        <label for="txtStreetAdd">Address Line 1</label>
                                                        <input type="text" class="form-control" id="txtStreetAdd"
                                                            value="<?php echo $row['Address1']; ?>" name="txtStreetAdd"
                                                            placeholder="Enter address line 1" required>
                                                    </div>
                                                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2">
                                                        <label for="txtStreetAdd2">Address Line 2</label>
                                                        <input type="text" class="form-control" id="txtStreetAdd2"
                                                            value="<?php echo $row['Address2']; ?>" name="txtStreetAdd2"
                                                            placeholder="Enter address line 2" required>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6 mb-2">
                                                        <label for="txtCity">City</label>
                                                        <input type="text" class="form-control" id="txtCity" name="txtCity"
                                                            placeholder="Enter city" required
                                                            value="<?php echo $row['City']; ?>">
                                                    </div>
                                                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6 mb-2">
                                                        <label for="txtPostCode">Post code</label>
                                                        <input type="text" class="form-control" id="txtPostCode"
                                                            value="<?php echo $row['PostCode']; ?>" name="txtPostCode"
                                                            placeholder="Enter post code" maxlength="8" required>
                                                    </div>
                                                </div>


                                                <div class="form-row mt-2">
                                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-2">
                                                        <p class="text-center">
                                                            <button type="submit" class="btn btn-space btn-primary">Update
                                                            </button>
                                                        </p>
                                                    </div>
                                                </div>

                                            </form>

                                        </div>
                                    </div>
                                    <?php
                                } else {
                                    echo "patient not found.";
                                }
                            } else {
                                echo "Invalid request. Please provide a patient ID.";
                                header("Location: patient-view-all.php");
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            var today = new Date();
            var eighteenYearsAgo = new Date();
            eighteenYearsAgo.setFullYear(today.getFullYear() - 18);

            var formattedEighteenYearsAgo = eighteenYearsAgo.toISOString().split('T')[0];

            $('#txtDOB').attr('max', formattedEighteenYearsAgo);
        });
    </script>

</body>



</html>