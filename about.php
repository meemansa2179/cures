<!DOCTYPE html>
<html>

<head>
<?php include 'includes/head.php'; 
$_SESSION['sess_active_nav'] = "about"; 
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
      <div class="heading_container heading_center">
        <h2>
          <span class="design_dot"></span>
          About Our Hospital
        </h2>
      </div>
      <div class="col-md-7 mx-auto px-0">
        <div class="img-box b2">
          <img src="front/images/about-img.png" alt="" />
        </div>
      </div>
      <div class="col-md-9 mx-auto px-0">
        <div class="detail-box">
          <p>
          At Cures Cancer Treatment Hospital and Support Center, we are committed to providing comprehensive, compassionate, and cutting-edge care to all our patients. Our mission is to make the journey through cancer as manageable and supportive as possible, by offering a range of innovative services designed with your needs in mind.
          </p>
          <p>
          <b>Sophisticated, Easy-to-Understand Health Reports</b><br/>
        We believe in transparency and empowerment through knowledge. Our advanced health reports are designed to be easily understandable, providing you with clear insights into your condition and progress. With detailed charts displaying your health results, we ensure that you have the information you need to make informed decisions about your care.
          </p>
          <p>
          <b>Initial Low-Cost Screening Without Any Registration Fee</b><br/>
Early detection is key to successful treatment, and at Cures Cancer Treatment Center and Support, we make it accessible for everyone. We offer initial low-cost cancer screenings with no registration fee, making it easier for you to take the first step towards your health and well-being.
          </p>
          <p>
          <b>Online Portal with Mental Health Assistance</b><br/>
          We understand that the emotional challenges of cancer can be just as demanding as the physical ones. Our online portal offers comprehensive mental health support, ensuring that you receive the care you need, whenever and wherever you need it. From counseling sessions to stress management resources, we are here to support your mental well-being every step of the way.
          </p>
          <p>
          <b>Direct Contact with Physicians</b><br/>
          At Cures, we believe in building strong, supportive relationships between patients and their healthcare providers. Through our online platform, you can directly connect with your physician, ensuring that your concerns are addressed promptly and that your treatment plan is personalized to your needs.
          </p>
          <p>
          <b>Your Health, Our Priority</b><br/>
          Our dedicated team of specialists is here to provide you with the highest standard of care, utilizing the latest technology and treatment options. Whether you are accessing our services in person or through our online portal, you can trust that we are committed to your health, recovery, and peace of mind.
          </p>
          <p>
          Thank you for choosing Cures Cancer Treatment Hospital and Support Center—where your care is our commitment.
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