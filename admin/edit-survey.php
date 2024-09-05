<!doctype html>


<html lang="en">
<?php include 'includes/header.php'; ?>

<?php
include "../config/connection.php";
$LiveUrl = "http://surveyfox-env.eba-qkqh8hse.eu-west-2.elasticbeanstalk.com/";
$id = $_GET['id'];
$CategoryId = 0;
$CustomerId =0;

?>
<?php
    // Check if the form is submitted and the 'id' parameter is set
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET['id'])) {


        if (isset($_POST["btnAddQue"])) {
            // Code to add survey data
            $Question = $_POST['txtQuestion'];
            $Type = $_POST['ddlType'];
            $OptionText = $_POST['txtOptions'];
            $Surveyid = $_GET['id'];

            if ($Type != 'Textbox' && strlen($OptionText) < 1) {
                echo "<script>";
                echo "alert('Option text value is missing!')";
                echo "</script>";
            } else {

                // sql query to insert data into the database
                $sql = "INSERT INTO question_master (Question, CategoryId, isPredefined, CustomerId, Type, OptionText, CreatedDate, Surveyid) 
            VALUES ('$Question', '$CategoryId', b'0', '$CustomerId', '$Type','$OptionText', current_timestamp(), '$Surveyid');";

                //execute the query
                if ($conn->query($sql) === TRUE) {

                    // Get the ID of the inserted row
                    $insertedId = $conn->insert_id;

                    echo "<script>";
                    echo "alert('Question Added!')";
                    echo "</script>";

                }
            }

        }

        // Check if the 'id' parameter is set in the POST request
        if (isset($_POST['id'])) {
            $id = $_POST['id'];

            // Perform the deletion in the database -- delete mate
            $deleteSql = "DELETE FROM question_master WHERE Qid = $id";

            if ($conn->query($deleteSql) === TRUE) {
                echo "Row deleted successfully";
            } else {
                echo "Error deleting row: " . $conn->error;
            }
        }


        if (isset($_POST["btnSubmit"])) {
            // Code to save survey data
            $SurveyTitle = $_POST['txtName'];
            $Desc = $_POST['txtDesc'];

            $updateSql = "update tbl_surveys set Name='$SurveyTitle', Description='$Desc' where Surveyid=$id;";
            //execute the query
            if ($conn->query($updateSql) === TRUE) {
                echo "<script>";
                echo "alert('Updated survey details!');";
                echo "window.location='survey-view-all.php'";
                echo "</script>";
            }
        }


        // header("Location: owner-view-all.php");
    
    } else {
        echo "Invalid request. Please submit the form.";
    }

    ?>

<head>
    <style>
        #questionContainer {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: 20px;
        }

        .question {
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <!-- ============================================================== -->
    <!-- main wrapper -->
    <!-- ============================================================== -->
    <div class="dashboard-main-wrapper">
        <!-- ============================================================== -->
        <!-- navbar -->
        <!-- ============================================================== -->

        <?php include 'includes/top-bar.php'; ?>
        <!-- ============================================================== -->
        <!-- end navbar -->
        <!-- ============================================================== -->
        <?php include 'includes/sidebar.php'; ?>



        <!-- ============================================================== -->
        <!-- wrapper  -->
        <!-- ============================================================== -->
        <div class="dashboard-wrapper">
            <div class="dashboard-ecommerce">
                <div class="container-fluid dashboard-content ">
                    <!-- ============================================================== -->
                    <!-- pageheader  -->
                    <!-- ============================================================== -->

                    <div class="row">


                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

                            <?php

                            // Check if the 'id' parameter is set in the query string
                            if (isset($_GET['id'])) {

                                $sid = $_GET['id'];

                                // Fetch customer details based on the provided ID
                                $sql = "SELECT s.*, c.*,
                                        (select Fullname  from tbl_customer cs where cs.CustomerId = s.CustomerId ) as CustomerName 
                                        FROM tbl_surveys  s 
                                        left join category_master c on c.MasId = s.CategoryId 
                                        WHERE s.Surveyid = $sid";

                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    $row = $result->fetch_assoc();
                                    ?>

                                    <div class="card">
                                        <h5 class="card-header"> Survey Details</h5>
                                        <div class="card-body">

                                            <form action="" method="POST">
                                                <div class="form-row">
                                                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-2">
                                                        <label for="txtName">Survey Title</label>
                                                        <input type="text" class="form-control" id="txtName" name="txtName"
                                                            value="<?php echo $row['Name']; ?>" placeholder="Enter Survey Title"
                                                            required>

                                                    </div>
                                                    <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12 mb-2">
                                                        <label for="txtDesc">Description</label>
                                                        <input type="text" class="form-control" id="txtDesc" name="txtDesc"
                                                        value="<?php echo $row['Description']; ?>" placeholder="Enter description">
                                                    </div>

                                                </div>

                                                <div class="form-row">
                                                    <hr />
                                                </div>
                                                <div class="form-row mt-2">
                                                <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-2">
                                                        <h5>Customer Name</h5>
                                                        <label>
                                                            <?php echo $row['CustomerName']; ?>
                                                        </label>

                                                    </div>
                                                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-2">
                                                        <h5>Type of Questions</h5>
                                                        <label>
                                                            <?php echo $row['QuestionType']; ?>
                                                        </label>

                                                    </div>
                                                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-2">
                                                        <label for="ddlCategory">Choosen Category</label>
                                                        <?php $CategoryId = $row['CategoryId'];
                                                        $CustomerId = $row['CustomerId']; ?>
                                                        <select id="ddlCategory" name="ddlCategory" required disabled="disabled"
                                                            class="form-control" onchange="getQuestions();">
                                                            <option value="">--Select--</option>
                                                            <?php
                                                            $sql = "select * from category_master";
                                                            $result = $conn->query($sql);
                                                            if ($result->num_rows > 0) {
                                                                while ($ddlrow = $result->fetch_assoc()) {
                                                                    ?>
                                                                    <option value='<?php echo $ddlrow['MasId'] ?>' <?php if ($ddlrow['MasId'] == $row['CategoryId']) {
                                                                           echo 'selected';
                                                                       } else {
                                                                           echo '';
                                                                       } ?>>
                                                                        <?php echo $ddlrow['Title'] ?>
                                                                    </option>
                                                                    <?php

                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>

                                                </div>

                                                <div class="form-row mt-2">
                                                    <div id="questionContainer">
                                                    </div>

                                                </div>
                                                <hr />


                                                <div class="form-row mt-2">

                                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-2">
                                                        <h5>Need to Add more questions?</h5>
                                                        <h5>Survey URL:
                                                            <?php
                                                            $urlNm = ($row['QuestionType'] == "String") ? $row['SurveyPageNm'] : $row['MultiChoice_PgNm'];
                                                            $urlNm = $LiveUrl . $urlNm . "/cid=" . $CustomerId . "&sid=" . $id;
                                                            echo "<a href='" . $urlNm . "' target='_blank' style='color: blue;' name='divsurveyurl' >" . $urlNm . "</a> <a onclick='copyContent();'><i class='fa fa-fw fa-copy' title='Copy URL'></i></a>";
                                                            ?>
                                                        </h5>

                                                    </div>
                                                </div>
                                                <div class="form-row">

                                                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-2">
                                                        <label for="txtQuestion">Question</label>
                                                        <input type="text" class="form-control" id="txtQuestion"
                                                            name="txtQuestion" placeholder="Enter Question" required>

                                                    </div>
                                                    <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 col-12 mb-2">
                                                        <label for="ddlType">Type</label>
                                                        <select id="ddlType" name="ddlType" required class="form-control">
                                                            <option value="">--Select--</option>
                                                            <option value="Textbox">Textbox</option>
                                                            <option value="Radio">Radio Button</option>
                                                            <option value="Checkbox">Multiple Choice</option>
                                                        </select>

                                                    </div>
                                                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2">
                                                        <label for="txtOptions">Option <small>(Add comma to separate options.
                                                                Eg. Yes,No,Maybe)</small></label>
                                                        <input type="text" class="form-control" id="txtOptions"
                                                            name="txtOptions"
                                                            placeholder="Enter Options, (Add comma to separate options. Eg. Yes,No,Maybe)">

                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <hr />
                                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-2">
                                                        <p class="text-center">
                                                            <button type="submit" name="btnAddQue"
                                                                class="btn btn-space btn-success">Add Question
                                                            </button>
                                                        </p>
                                                    </div>

                                                </div>


                                                <div class="form-row mb-2">
                                                    <?php
                                                    $SIds = $_GET['id'];
                                                    $sql = "SELECT * FROM question_master WHERE isPredefined=0 and CustomerId=$CustomerId and Surveyid=$SIds; ";

                                                    $result = $conn->query($sql);

                                                    // Check if there are rows in the result
                                                    if ($result->num_rows > 0) {
                                                        echo '<table class="table table-hover"> <thead><tr>
                                                        <th scope="col">Question</th> <th scope="col">Type</th> <th scope="col">Option Text</th> 
                                                        <th scope="col">Delete</th></tr></thead><tbody>';

                                                        while ($dbrow = $result->fetch_assoc()) {
                                                            echo "<tr>
                                                            <td>" . $dbrow["Question"] . "</td>
                                                            <td>" . $dbrow["Type"] . "</td>
                                                            <td>" . $dbrow["OptionText"] . "</td>
                                                            <td><a onclick='deleteRow(" . $dbrow["Qid"] . ")'><i class='fa fa-fw fa-trash'></i></a></td>
                                                            </tr>";

                                                        }

                                                        echo "</tbody></table>";
                                                    } else {
                                                        echo "<div class='p-3 mb-2 bg-danger text-white'>No data found.</p>";
                                                    }
                                                    ?>
                                                </div>


                                                <hr />
                                                <div class="form-row" name="Div_ManageQuestions">
                                                    <hr />
                                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-2">
                                                        <p class="text-center">
                                                            <button type="submit" name="btnSubmit"
                                                                class="btn btn-space btn-primary">Save Details
                                                            </button>
                                                        </p>
                                                    </div>

                                                </div>

                                            </form>

                                        </div>
                                    </div>

                                    <?php
                                } else {
                                    echo "Survey not found.";
                                }
                            } else {
                                echo "Invalid request. Please provide a Survey id.";
                            }
                            ?>
                        </div>
                    </div>


                </div>
            </div>
        </div>
        <!-- footer -->
        <?php include 'includes/footer.php'; ?>
    </div>
    <!-- ============================================================== -->
    <!-- end wrapper  -->
    <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- end main wrapper  -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <?php include 'includes/footer-js.php'; ?>



    <script type="text/javascript">
        var specialKeys = new Array();
        specialKeys.push(8); //Backspace

        function IsNumericPhone(e, spanid) {
            var keyCode = e.which ? e.which : e.keyCode
            var ret = ((keyCode >= 48 && keyCode <= 57) || specialKeys.indexOf(keyCode) != -1);
            //document.getElementById(spanid).style.display = ret ? "none" : "inline";
            return ret;
        }
    </script>
    <script>
        window.onload = function () {
            // Get the default selected category ID (you may adjust this as needed)
            var defaultCategoryId = document.getElementById('ddlCategory').value;

            // Call fetchQuestionData() with the default category ID
            fetchQuestionData(defaultCategoryId);
        };
        document.getElementById('ddlCategory').addEventListener('change', function () {
            var selectedValue = this.value;

            // Send selected value to server for fetching data
            fetchQuestionData(selectedValue);
        });

        function fetchQuestionData(CategoryID) {
            // AJAX request to fetch data from PHP script
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "get_questions.php?id=" + CategoryID, true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // Update the content of the div with fetched data
                    document.getElementById("questionContainer").innerHTML =
                        "<h4>Predefined set of questions for survey</h4><hr/>" + xhr.responseText;
                }
            };
            xhr.send();
        }
    </script>

    <script>
        function copyContent() {
            // Get the text field
            var link = document.querySelector('a[name="divsurveyurl"]');
            var href = link.getAttribute('href');

            // Create a temporary textarea element to copy the href
            var tempTextArea = document.createElement("textarea");
            tempTextArea.value = href;
            document.body.appendChild(tempTextArea);

            // Select the content of the textarea
            tempTextArea.select();
            tempTextArea.setSelectionRange(0, 99999); // For mobile devices

            // Copy the selected text to the clipboard
            document.execCommand("copy");

            // Remove the temporary textarea
            document.body.removeChild(tempTextArea);

            alert("Survey URL copied!");
        }
        function deleteRow(rowId) {
            var confirmDelete = confirm("Are you sure you want to delete this row?");
            if (confirmDelete) {
                // Use AJAX to send an asynchronous request to delete the row
                $.ajax({
                    type: "POST",
                    url: "", // Leave it empty to send the request to the same PHP file
                    data: { id: rowId },
                    success: function (response) {
                        // Reload the page or update the grid based on your needs
                        location.reload();
                    },
                    error: function () {
                        alert("Error deleting row.");
                    }
                });
            }
        }
    </script>



    

</body>



</html>