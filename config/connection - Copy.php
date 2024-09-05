<?php
        // Database connection parameters
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "car_rento";

        // Create a connection
        $conn = new mysqli($servername, $username, $password, $database);

        //check connection
        if ($conn->connect_error) {
            die("". $conn->connect_error);
        }




?>