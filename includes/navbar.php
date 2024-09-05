<header class="header_section">
      <div class="container-fluid">
        <nav class="navbar navbar-expand-lg custom_nav-container ">
          <a class="navbar-brand" href="index.php">
            <h3>
              <img src="front/images/logo2.png" alt="" width="250px">
            </h3>
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <?php $ActiveName = $_SESSION['sess_active_nav']; ?>

          <div class="collapse navbar-collapse ml-auto" id="navbarSupportedContent">
            <ul class="navbar-nav  ml-auto">
              <li class="nav-item <?php if ($ActiveName == "home") { echo 'active';} ?>">
              <!-- <?php if ($ActiveName == "home") { echo 'active';} ?> -->
                <a class="nav-link" href="index.php">Home <?php if ($ActiveName == "home") { echo "<span class='sr-only'>(current)</span>";} ?></a>
              </li>
              <li class="nav-item <?php if ($ActiveName == "about") { echo 'active';} ?>">
                <a class="nav-link" href="about.php"> About <?php if ($ActiveName == "home") { echo "<span class='sr-only'>(current)</span>";} ?></a>
              </li>
              <li class="nav-item <?php if ($ActiveName == "service") { echo 'active';} ?>">
                <a class="nav-link" href="service.php"> Services <?php if ($ActiveName == "service") { echo "<span class='sr-only'>(current)</span>";} ?></a>
              </li>
              <li class="nav-item <?php if ($ActiveName == "appointment") { echo 'active';} ?>">
                <a class="nav-link" href="appointment.php"> Book Cancer Screening <?php if ($ActiveName == "appointment") { echo "<span class='sr-only'>(current)</span>";} ?></a>
              </li>
              <li class="nav-item <?php if ($ActiveName == "contact") { echo 'active';} ?>">
                <a class="nav-link" href="contact.php"> Contact <?php if ($ActiveName == "contact") { echo "<span class='sr-only'>(current)</span>";} ?></a>
              </li>
              <li class="nav-item <?php if ($ActiveName == "register") { echo 'active';} ?>">
                <a class="nav-link" href="patient-register.php"> Register <?php if ($ActiveName == "register") { echo "<span class='sr-only'>(current)</span>";} ?></a>
              </li>
              
            </ul>
            
          </div>
        </nav>
      </div>
    </header>