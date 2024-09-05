<!doctype html>
<html lang="en">
<?php include 'includes/header.php'; 
include "../config/connection.php";
?>

<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.0/xlsx.full.min.js"></script>
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

                    <?php

                            // Check if the 'id' parameter is set in the query string
                            if (isset($_GET['id'])) {

                                $sid = $_GET['id'];

                                // Fetch customer details based on the provided ID
                                $sql = "SELECT * FROM tbl_surveyresponses
                                        WHERE SR_Id = $sid";

                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    $row = $result->fetch_assoc();
                                    ?>

                    <div class="row" id="myTable">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="card">
                                <h5 class="card-header"> Survey Answers of - <?php echo $row['RespondantName']; ?> </h5>
                                <div class="card-body">
                                <div class='text-right'>
                                        <button onclick='generateExcel()'
                                            class='btn btn-space btn-sm btn-success'> Export Excel</button>
                                    </div>
                                <?php
                                   
                                   
                                   $grp_sql = "select b.*,
                                   (select Question from question_master qm where qm.Qid= b.QuesId) as QuestionTxt
                                   from 
                                   (
                                   SELECT QuesId, GROUP_CONCAT(Answer SEPARATOR ', ') AS Answers
                                   FROM tbl_surveyanswers
                                   WHERE SR_Id = $sid AND Answer <> ''
                                   GROUP BY QuesId
                                   ) as b;";
                                   
                                   $resultQry = $conn->query($grp_sql);

                                   // Check if there are rows in the result
                                   if ($resultQry->num_rows > 0) {
                                       echo '<table class="table table-hover" id=""> <thead><tr><th scope="col">#</th>
                                   <th scope="col">Question</th> <th scope="col">Answer</th> 
                                   </tr></thead><tbody>';

                                        $indID = 1;
                                        
                                       while ($rowqr = $resultQry->fetch_assoc()) {
                                           echo "<tr>
                                       <th scope='row'>" . $indID . "</th>
                                       <td>" . $rowqr["QuestionTxt"] . "</td>
                                       <td>" . $rowqr["Answers"] . "</td>
                                       </tr>";

                                       $indID = $indID + 1;
                                       }

                                       echo "</tbody></table>";
                                   } else {
                                       echo "<div class='p-3 mb-2 bg-danger text-white'>No data found.</p>";
                                   }
                                   ?>
                                </div>
                            </div>
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

    <script>
    function generateExcel() {
        const table = document.getElementById('myTable');

        // Hide "View Response" column
        const viewResponseColumn = table.querySelectorAll('.view-response');
        viewResponseColumn.forEach(function(column) {
            column.style.display = 'none';
        });

        const wb = XLSX.utils.table_to_book(table, {
            sheet: "SheetJS"
        });

        // Show "View Response" column again for the design
        viewResponseColumn.forEach(function(column) {
            column.style.display = ''; // Reset to default display value
        });

        XLSX.writeFile(wb, 'surveyanswer_list.xlsx');
    }
    </script>
</body>

</html>