<!DOCTYPE html>
<html>

<head>
<?php include 'includes/head.php'; 
$_SESSION['sess_active_nav'] = "contact"; 
?>
</head>

<body class="sub_page">
  <div class="hero_area">
    <!-- header section strats -->
    <?php include 'includes/navbar.php'; ?>
    <!-- end header section -->
  </div>

  <!-- about section -->
  <section class="about_section layout_padding">
    <div class="container">
      <div class="col-md-7 mx-auto px-0">
        <div class="img-box b2">
          <img src="front/images/thank-you.png" alt="" style="width: 300px;" />
        </div>
      </div>
      <div class="col-md-9 mx-auto px-0">
        <div class="detail-box">
          <p>
          Thank you for registering with us we will assign and contact you for hospital appointment and also let you know about the assigned the doctor for you.
          </p>
          <p>
            You can complete your health questionnaire before visiting us at the hospital by login in the patient portal
          </p>
          <p>
            <a href="patient/login.php">Click here for Patient Portal <i class="fa fa-user"></i> </a>
          </p>
        </div>
      </div>
    </div>
  </section>

  <!-- end about section -->

  <?php include 'includes/info.php'; ?>

  <!-- footer section -->
  <?php include 'includes/footer.php'; ?>
  <!-- footer section -->
  <?php include 'includes/footer-scripts.php'; ?>

</body>

</html>