<!doctype html>
<html lang="en">
<?php include 'includes/header.php'; 
include "../config/connection.php";
?>

<style>
    
</style>

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
                                <h2 class="pageheader-title">Document Management</h2>
                               
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="card">
                                <h5 class="card-header"> Manage Documents of Lifestyle Factors</h5>
                                
                                <div class="card-body">

                                    <?php
                                    
                                    $sql = "SELECT * FROM mas_lifestylefactors where  isActive=1 ";
                                    
                                    $result = $conn->query($sql);

                                    // Check if there are rows in the result
                                    if ($result->num_rows > 0) {
                                        echo '<table class="table table-hover"> <thead>
                                        <tr class="greyhead"><th scope="col">#</th>
                                    <th scope="col">Lifestyle Factor Title</th>
                                    <th scope="col">Documents</th>
                                    </tr></thead><tbody>';

                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>
                                        <th scope='row'>" . $row["FId"] . "</th>
                                        <td>" .$row["Title"]."</td>
                                        <td><a href='add-document.php?id=" . $row["FId"] . "'><i class='fa fa-fw fa-cubes'></i> View & Add</a></td>
                                        </tr>";

                                        }

                                        echo "</tbody></table>";
                                    } else {
                                        echo "<div class='p-3 mb-2 bg-danger text-white'>No data found.</p>";
                                    }


                                    // Check if the 'id' parameter is set in the POST request
                                    if (isset($_POST['id'])) {
                                        $id = $_POST['id'];

                                        // Perform the deletion in the database -- delete mate
                                        //$deleteSql = "DELETE FROM tbl_owners WHERE LoginId = $id";

                                        $log = $AdminName . ' has deleted this physician';
                                        // Perform the deletion in the database -- soft delete mate
                                        $deleteSql = "update tbl_physicians set isDelete=1, DeleteDate=current_timestamp(), UpdateLog='$log' WHERE DoctorId = $id"; //not working correctly

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
        // function deleteRow(rowId) {
        //     var confirmDelete = confirm("Are you sure you want to delete this owner?");
        //     if (confirmDelete) {
        //         // You can use AJAX to send an asynchronous request to delete the row from the database
        //         // For simplicity, let's reload the page for now
        //         window.location.href = 'delete.php?id=' + rowId + '&type=owner';
        //     }
        // }
        function deleteRow(rowId) {
            var confirmDelete = confirm("Are you sure you want to delete this row?");
            if (confirmDelete) {
                // Use AJAX to send an asynchronous request to delete the row
                $.ajax({
                    type: "POST",
                    url: "delete.php", // Create a separate PHP file to handle the deletion
                    data: { id: rowId, type: 'owner' },
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
    </script> -->
    <script>
    function deleteRow(rowId) {
        var confirmDelete = confirm("Are you sure you want to delete this row?");
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