<!doctype html>
<html lang="en">
<?php
include 'includes/header.php';
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
                                <h2 class="pageheader-title">Customer Management</h2>
                            </div>
                        </div>
                    </div>

                    <form action="" method="post">
                        <div class="row">

                            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">
                                <div class="card">
                                    <h5 class="card-header"> Search</h5>
                                    <div class="card-body">

                                        <div class="form-row">
                                            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-8 mb-2">

                                                <input type="text" class="form-control" id="txtSearch" Name="txtSearch"
                                                    data-parsley-trigger="change"
                                                    placeholder="Search by Full name, email or company name">

                                            </div>
                                            <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-2">
                                                <button type="submit"
                                                    class="btn btn-space btn-sm btn-success">Search</button>
                                                <!-- <label for=""> </label>
                                                <p class="text-center">
                                                    
                                                </p> -->
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
                                <h5 class="card-header"> Customer List</h5>

                                <div class="card-body">
                                    <div class='text-right'>
                                        <button onclick='generateExcel()' class='btn btn-space btn-sm btn-success'>
                                            Export Excel</button>
                                    </div>
                                    <?php

                                    // Handle the search
                                    $searchTerm = isset($_POST['txtSearch']) ? $_POST['txtSearch'] : '';

                                    $sql = "SELECT * FROM tbl_customer where ( fullname like '%$searchTerm%' or email like '%$searchTerm%'  or CompanyName like '%$searchTerm%') ";
                                    $result = $conn->query($sql);

                                    // Check if there are rows in the result
                                    if ($result->num_rows > 0) {
                                        echo '<table class="table table-hover" id="myTable"> <thead><tr><th scope="col">#</th>
                                    <th scope="col">Fullname</th> <th scope="col">Email</th><th scope="col">Comapny Name</th>
                                    <th scope="col">Register Date</th> <th scope="col">Delete</th>
                                    </tr></thead><tbody>';

                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>
                                        <th scope='row'>" . $row["CustomerId"] . "</th>
                                        <td>" . $row["Fullname"] . "</td>
                                        <td>" . $row["Email"] . "</td>
                                        <td>" . $row["CompanyName"] . "</td>
                                        <td>" . date("m/d/Y H:i:s", strtotime($row["CreatedDate"])) . "</td>
                                        <td><a onclick='deleteRow(" . $row["CustomerId"] . ")'><i class='fa fa-fw fa-trash'></i></a></td></tr>";
                                        }
                                        echo "</tbody></table>";
                                    } else {
                                        echo "<div class='p-3 mb-2 bg-danger text-white'>No data found.</p>";
                                    }


                                    // Check if the 'id' parameter is set in the POST request
                                    if (isset($_POST['id'])) {
                                        $id = $_POST['id'];

                                        // Perform the deletion in the database -- delete mate
                                        $deleteSql = "DELETE FROM tbl_Customers WHERE LoginId = $id";

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


    <script>
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
    <script>
        function generateExcel() {
            const table = document.getElementById('myTable');

            // Hide "View Response" column
            const viewResponseColumn = table.querySelectorAll('.view-response');
            viewResponseColumn.forEach(function (column) {
                column.style.display = 'none';
            });

            const wb = XLSX.utils.table_to_book(table, {
                sheet: "SheetJS"
            });

            // Show "View Response" column again for the design
            viewResponseColumn.forEach(function (column) {
                column.style.display = ''; // Reset to default display value
            });

            XLSX.writeFile(wb, 'respondent_list.xlsx');
        }
    </script>


</body>

</html>