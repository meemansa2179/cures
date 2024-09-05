<!doctype html>
<html lang="en">
<?php include 'includes/header.php'; ?>
<?php
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
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="page-header">
                                <h2 class="pageheader-title">Survey Management</h2>

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
                                                    placeholder="Search by Survey Name or Category Name" required>

                                            </div>
                                            <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-2">
                                                <button type="submit"
                                                    class="btn btn-space btn-sm btn-success">Search</button>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <a href="add-new-survey.php" class="btn btn-sm btn-space btn-success">Add Survey</a>
                            </div>

                        </div>
                    </form>
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="card">
                                <h5 class="card-header"> Survey List</h5>

                                <div class="card-body">
                                <div class='text-right'>
                                        <button onclick='generateExcel()'
                                            class='btn btn-space btn-sm btn-success'> Export Excel</button>
                                    </div>
                                    <?php

                                    // Handle the search
                                    $searchTerm = isset($_POST['txtSearch']) ? $_POST['txtSearch'] : '';

                                    $sql = "SELECT sur.*, cm.* ,
                                    (select count(*) from tbl_surveyresponses sr where sr.Surveyid= sur.Surveyid ) as ResponseCnt
                                    ,(select Fullname  from tbl_customer cs where cs.CustomerId = sur.CustomerId ) as CustomerName
                                    FROM `tbl_surveys` sur left join category_master cm on cm.MasId = sur.CategoryId 
                                    WHERE  
                                    ( sur.Name like '%$searchTerm%' or cm.Title  like  '%$searchTerm%') ";

                                    $result = $conn->query($sql);

                                    // Check if there are rows in the result
                                    if ($result->num_rows > 0) {
                                        echo '<table class="table table-hover"  id="myTable"> <thead><tr><th scope="col">#</th>
                                        <th scope="col">Customer Name</th><th scope="col">Survey Name</th> <th scope="col">Category</th> 
                                        <th scope="col">Total Responses</th> <th scope="col">Edit</th>
                                        </tr></thead><tbody>';

                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>
                                        <th scope='row'>" . $row["Surveyid"] . "</th>
                                        <td>" . $row["CustomerName"] . "</td>
                                        <td>" . $row["Name"] . "</td>
                                        <td>" . $row["Title"] . "</td>
                                        <td><a href='respondants-view-all.php?sid=" . $row["Surveyid"] . "'><b>" . $row["ResponseCnt"] . " <i class='fa fa-fw fa-cubes' title='View Respondants & Survey'></i></a></td>
                                        <td><a href='edit-survey.php?id=" . $row["Surveyid"] . "'><i class='fa fa-fw fa-edit'></i></a></td>
                                        </tr>";

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

        XLSX.writeFile(wb, 'survey_list.xlsx');
    }
    </script>


</body>

</html>