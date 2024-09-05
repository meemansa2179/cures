<!doctype html>
<html lang="en">
<?php include 'includes/header.php'; 
include "../config/connection.php";
?>



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
                                <h2 class="pageheader-title">Physician Management</h2>
                               
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
                                                    data-parsley-trigger="change" placeholder="Search by Physician name, email or role"
                                                    required>

                                            </div>
                                            <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-2">
                                                <button type="submit" class="btn btn-space btn-sm btn-success">Search</button>
                                                <!-- <label for=""> </label>
                                                <p class="text-center">
                                                    
                                                </p> -->
                                            </div>
                                        </div>

                                    </div>
                                </div>
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <a href="add-physician.php" class="btn btn-sm btn-space btn-success">Add Physician</a>
                            </div>
                        
                    </div>
                    </form>
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="card">
                                <h5 class="card-header"> Physician List</h5>
                                
                                <div class="card-body">

                                    <?php
                                    // Handle the search
                                    $searchTerm = isset($_POST['txtSearch']) ? $_POST['txtSearch'] : '';

                                    $sql = "SELECT * FROM tbl_physicians where  (firstname like '%$searchTerm%' or lastname like '%$searchTerm%' or email like '%$searchTerm%' or roletype like '%$searchTerm%')
                                    and isDelete=0 ";
                                    
                                    $result = $conn->query($sql);

                                    // Check if there are rows in the result
                                    if ($result->num_rows > 0) {
                                        echo '<table class="table table-hover"> <thead><tr><th scope="col">#</th>
                                    <th scope="col">Fullname</th> <th scope="col">Email</th> <th scope="col">Specialization</th>
                                    <th scope="col">Role Type</th><th scope="col">Edit</th> <th scope="col">Delete</th>
                                    </tr></thead><tbody>';

                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>
                                        <th scope='row'>" . $row["DoctorId"] . "</th>
                                        <td>" .$row["Firstname"]. " " .$row["Initial"]." " .$row["Lastname"]. "</td>
                                        <td>" . $row["Email"] . "</td>
                                        <td>" . $row["Specialization"] . "</td>
                                        <td>" . $row["RoleType"] . "</td>
                                        <td><a href='edit-physician.php?id=" . $row["DoctorId"] . "'><i class='fa fa-fw fa-edit'></i></a></td>
                                        <td><a onclick='deleteRow(" . $row["DoctorId"] . ")'><i class='fa fa-fw fa-trash'></i></a></td></tr>";

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