<?php
        // Database connection parameters
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "cures";

        // Create a connection
        $conn = new mysqli($servername, $username, $password, $database);

        //check connection
        if ($conn->connect_error) {
            die("". $conn->connect_error);
        }




?>