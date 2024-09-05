<!DOCTYPE html>
<html>

<head>
    <?php include 'includes/head.php'; 
    $_SESSION['sess_active_nav'] = "contact";
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
                            Contact Us
                        </h4>
                        <div class="form-row ">
                            <div class="form-group col-lg-4">
                                <label for="txtFullname">Full Name </label>
                                <input type="text" class="form-control" id="txtFullname" name="txtFullname" placeholder="" required>
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="txtPhone">Phone Number</label>
                                <input type="text" class="form-control" id="txtPhone" name="txtPhone" placeholder="" required>
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="txtEmail">Email</label>
                                <input type="email" class="form-control" id="txtEmail" name="txtEmail" placeholder="" required>
                            </div>
                        </div>
                        <div class="form-row ">
                            
                            <div class="form-group col-lg-12">
                                <label for="txtMessage">Message</label>
                                <input type="text" class="form-control" id="txtMessage" placeholder="" required>
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
        $phone = $_POST['txtPhone'];
        $email = $_POST['txtEmail'];
        $message = $_POST['txtMessage'];

        $sql = "INSERT INTO tbl_contacts (Fullname, Phone, Email, Message, CreatedDate) 
        VALUES ('$fullname', '$phone', '$email', '$message', current_timestamp());";

        //echo $sql;
    
        //execute the query
        if ($conn->query($sql) === TRUE) {
            echo "<script>";
            echo "alert('Contacting details submitted successfully.');";
            echo "window.location='contact-thanks.php'";
            echo "</script>";

        } else {
            ////// Error is not working
            echo "<script>";
            echo "alert('Error submitting data!')";
            echo "</script>";
        }


    } else {
        echo "Invalid request. Please submit the form.";
    }

    ?>

</body>

</html>