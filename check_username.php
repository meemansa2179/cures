<?php
include "config/connection.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];

    // Check if the username already exists in the database
    $checkQuery = "SELECT COUNT(*) FROM tbl_patients WHERE Username = '$username'";
    $result = $conn->query($checkQuery);

    if ($result->fetch_row()[0] > 0) {
        echo 'duplicate';
    } else {
        echo 'unique';
    }
}
?>