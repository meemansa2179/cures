<!DOCTYPE html>
<html>

<head>
    <?php include 'includes/head.php';
    $_SESSION['sess_active_nav'] = "appointment";
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
                            Book Cancer Screening Appointment
                        </h4>
                        <div class="form-row ">
                            <div class="form-group col-lg-4">
                                <label for="txtFullname">Full Name </label>
                                <input type="text" class="form-control" id="txtFullname" name="txtFullname" required
                                    placeholder="">
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="ddlGender">Gender</label>
                                <select class="form-control wide" id="ddlGender" name="ddlGender"  required>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="ddlLocation">CURES Location</label>
                                <select class="form-control wide" id="ddlLocation" name="ddlLocation"  required>
                                    <option value="Euston (London)">Euston (London)</option>
                                    <option value="Liverpool Street (London)">Liverpool Street (London)</option>
                                    <option value="Hammersmith (London)">Hammersmith (London)</option>
                                    <option value="Sudbury (London)">Sudbury (London)</option>
                                    <option value="Manchester">Manchester</option>
                                    <option value="Birmingham">Birmingham</option>
                                    <option value="Bristol">Bristol</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row ">
                            <div class="form-group col-lg-4">
                                <label for="txtPhone">Phone Number</label>
                                <input type="text" class="form-control" id="txtPhone" name="txtPhone" placeholder=""  required>
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="txtSymptoms">Symptoms</label>
                                <input type="text" class="form-control" id="txtSymptoms" name="txtSymptoms" required placeholder="">
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="txtDate">Choose Date </label>
                                <div class="input-group date" id="txtDate"  data-date-format="mm-dd-yyyy">
                                    <input type="text" class="form-control" name="txtDate">
                                    <span class="input-group-addon date_icon">
                                        <i class="fa fa-calendar" aria-hidden="true"></i>
                                    </span>
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

    <?php
    include "config/connection.php";

    // Check if the form is submitted and the 'id' parameter is set
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $fullname = $_POST['txtFullname'];
        $gender = $_POST['ddlGender'];
        $location = $_POST['ddlLocation'];
        $phone = $_POST['txtPhone'];
        $bookdate = $_POST['txtDate'];
        $symptoms = $_POST['txtSymptoms'];

        $sql = "INSERT INTO tbl_screening_booking (Fullname, Gender, Location, Phone, Symptoms, 
        BookingDate, CreatedDate) 
        VALUES ('$fullname', '$gender', '$location', '$phone', '$symptoms', 
        '$bookdate', current_timestamp());";

        //execute the query
        if ($conn->query($sql) === TRUE) {
            echo "<script>";
            echo "alert('Cancer screening booking done successfully');";
            echo "window.location='booking-thanks.php'";
            echo "</script>";

        } else {
            ////// Error is not working
            echo "<script>";
            echo "alert('Error submitting data!')";
            echo "</script>";
            //echo "Error" . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Invalid request. Please submit the form.";
    }

    ?>



    <script>
        $(document).ready(function () {
            $('#txtDate').datepicker({
                format: 'mm/dd/yyyy',
                startDate: '+3d',  // Sets the start date to the next day
                autoclose: true    // Automatically close the datepicker after selecting a date
            });
        });
    </script>
</body>

</html>