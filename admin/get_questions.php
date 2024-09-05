<?php
include "../config/connection.php";

// Get the question ID from the GET parameter
$CategoryId = $_GET['id'];

// SQL query to fetch data from question_master table based on category ID
$sql = "SELECT * FROM question_master WHERE CategoryId = $CategoryId and isPredefined='1' ";

$result = $conn->query($sql);

if ($result->num_rows > 0) {

    $indexId = 1;
    // Output data of the first row (assuming there's only one row for the selected category ID)
    while ($row = $result->fetch_assoc()) {
        echo "<div class='question'>Q:" . $indexId. ". " . $row["Question"]." </div>";
        $indexId++;
    }

} else {
    echo "Question data not found";
}