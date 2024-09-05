<!doctype html>
<html lang="en">
<?php include 'includes/header.php'; ?>
<?php
include "../config/connection.php";
$TotalCnt = 0;

if (isset($_GET['sid'])) {

    $sid = $_GET['sid'];

    // Fetch customer details based on the provided ID
    $sql = "SELECT count(*) as TotalResp FROM tbl_surveyresponses 
            WHERE Surveyid = $sid";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $qrrow = $result->fetch_assoc();

        $TotalCnt = $qrrow['TotalResp']; 

    } else {
        echo "Survey not found.";
    }
} else {
    echo "Invalid request. Please provide a Survey id.";
}
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
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="page-header">
                                <h2 class="pageheader-title">Respondants Management</h2>
                                <h4> Total Respondants - <?php echo $TotalCnt; ?></h4>

                            </div>
                        </div>
                    </div>

                    <form action="" method="post">
                        <div class="row">

                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="card">
                                    <h5 class="card-header"> Search</h5>
                                    <div class="card-body">

                                        <div class="form-row">
                                            <div class="col-xl-10 col-lg-10 col-md-10 col-sm-10 col-10 mb-2">

                                                <input type="text" class="form-control" id="txtSearch" Name="txtSearch"
                                                    data-parsley-trigger="change"
                                                    placeholder="Search by Respondant Name or Email">

                                            </div>
                                            <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-2">
                                                <button type="submit"
                                                    class="btn btn-space btn-sm btn-success">Search</button>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </form>
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="card">
                                <h5 class="card-header"> Respondant List</h5>

                                <div class="card-body">
                                    <div class='text-right'>
                                        <button onclick='generateExcel()'
                                            class='btn btn-space btn-sm btn-success'> Export Excel</button>
                                    </div>
                                    <?php
                                    $Surveyid = $_GET['sid'];
                                    // Handle the search
                                    $searchTerm = isset($_POST['txtSearch']) ? $_POST['txtSearch'] : '';
                                    $searchSQL = '';
                                    if (strlen($searchTerm)) {
                                        $searchSQL = " and ( sr.RespondantName like '%$searchTerm%' or sr.Email  like  '%$searchTerm%')";
                                    }

                                    $sql = "select b.*,
                                    ROUND(((b.AnswersCnt * 100)/ b.TotalQuestions)) as CompletePercentage
                                    from (
                                    SELECT sr.*,
                                       ( (SELECT COUNT(*) FROM question_master qm WHERE qm.isPredefined = '1' AND qm.CategoryId = (SELECT Categoryid FROM tbl_surveys WHERE sr.Surveyid LIMIT 1))
                                        + 
                                        (SELECT COUNT(*) FROM question_master qm WHERE qm.isPredefined = '0' AND qm.Surveyid = sr.Surveyid) )
                                        AS TotalQuestions,
                                         
                                        (SELECT COUNT(DISTINCT QuesId) FROM tbl_surveyanswers sa WHERE sa.SR_Id = sr.SR_Id and LENGTH(sa.Answer)>0 and sa.QuesId<>57) AS AnswersCnt
                                    FROM tbl_surveyresponses sr
                                    where Surveyid=$Surveyid 
                                    $searchSQL
                                        ) as b ;
                                      
                                     ";

                                    $result = $conn->query($sql);

                                    // Check if there are rows in the result
                                    if ($result->num_rows > 0) {
                                        echo '<table class="table table-hover" id="myTable"> <thead><tr><th scope="col">#</th>
                                    <th scope="col">Full Name</th> <th scope="col">Email</th> 
                                    <th scope="col">No. of Question Answered</th>
                                    <th scope="col">Completion %</th> <th scope="col" class="view-response">View Response</th>
                                    <th scope="col"> </th>
                                    </tr></thead><tbody>';

                                        $bID = 1;
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>
                                        <th scope='row'>" . $bID . "</th>
                                        <td>" . $row["RespondantName"] . "</td>
                                        <td>" . $row["Email"] . "</td>
                                        <td><b>" . $row["AnswersCnt"] . " </b></td>
                                        <td><b>" . $row["CompletePercentage"] . " </b></td>
                                        <td><a href='view-survey-answers.php?id=" . $row["SR_Id"] . "'><i class='fa fa-fw fa-eye'></i></a></td>
                                        <td><a onclick='deleteRow(".$row["SR_Id"].")'><i class='fa fa-fw fa-trash' title='Delete Respondant'></i></a></td>
                                        </tr>";
                                            $bID = $bID + 1;
                                        }

                                        echo "</tbody></table>";
                                    } else {
                                        echo "<div class='p-3 mb-2 bg-danger text-white'>No data found.</p>";
                                    }

                                    // Check if the 'id' parameter is set in the POST request
                                    if (isset($_POST['id'])) {
                                        $id = $_POST['id'];

                                        // Perform the deletion in the database -- delete mate
                                        $deleteSql = "DELETE FROM tbl_surveyresponses WHERE SR_Id=$id";

                                        if ($conn->query($deleteSql) === TRUE) {
                                            echo "Row deleted successfully";
                                        } else {
                                            echo "Error deleting row: " . $conn->error;
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
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

    <!-- <script>
    function generateExcel() {
        const table = document.getElementById('myTable');
        const wb = XLSX.utils.table_to_book(table, {
            sheet: "SheetJS"
        });
        XLSX.writeFile(wb, 'respondent_list.xlsx');
    }

    </script> -->
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

        XLSX.writeFile(wb, 'respondent_list.xlsx');
    }
    </script>
     <script>
    function deleteRow(rowId) {
        var confirmDelete = confirm("Are you sure you want to delete this respondants?");
        if (confirmDelete) {
            // Use AJAX to send an asynchronous request to delete the row
            $.ajax({
                type: "POST",
                url: "", // Leave it empty to send the request to the same PHP file
                data: { id: rowId },
                success: function(response) {
                    // Reload the page or update the grid based on your needs
                    location.reload();
                },
                error: function() {
                    alert("Error deleting row.");
                }
            });
        }
    }
</script>



</body>

</html>