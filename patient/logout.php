<?php

  // Inialize session
  session_start();

// Delete certain session
  unset($_SESSION['admin_uid']);
  unset($_SESSION['admin_name']);
  unset($_SESSION['admin_email']);
  // Delete all session variables
  
  session_destroy();

 // Jump to login page
 header('Location: login.php');

  ?>