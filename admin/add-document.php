<!doctype html>
<html lang="en">
<?php include 'includes/header.php'; ?>
<?php include "../config/connection.php"; ?>

<?php
$OCid = 0;
if (isset($_GET['id'])) {
    $OCid = $_GET['id'];

    $sql = "select Title from mas_lifestylefactors where FId=$OCid;";

    $result = $conn->query($sql);

    $carNm = "";
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $carNm = $row['Title'];
    }
} else {
    header("Location: documents-view-all.php");
    exit();
}
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
                            <div class="card">
                                <h5 class="card-header"> Add Document for -
                                    <b><?php echo $carNm ?></b> | <a href="documents-view-all.php">Back to list</a>
                                </h5>
                                <div class="card-body">
                                    <form method="post" action="#" id="basicform" data-parsley-validate=""
                                        enctype="multipart/form-data">
                                        <div class="form-row">
                                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-2">
                                                <label for="txtName">Document Name</label>
                                                <input type="text" class="form-control" id="txtName" name="txtName"
                                                    data-parsley-trigger="change" placeholder="Enter Document name"
                                                    required>
                                            </div>
                                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-6 mb-2">
                                                <label for="uplFile">Select PDF</label>
                                                <input type="file" class="form-control" id="uplFile" name="uplFile">

                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-2 mt-2">
                                                <label for=""> </label>
                                                <button name="submit" type="submit"
                                                    class="btn btn-space btn-primary btn-sm">Add Document</button>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="card">
                                <h5 class="card-header">Document List</h5>
                                <div class="card-body">
                                    <?php

                                    $sql = "SELECT * FROM `tbl_documents` where Fid=$OCid";

                                    $result = $conn->query($sql);

                                    // Check if there are rows in the result
                                    if ($result->num_rows > 0) {
                                        echo '<table class="table table-hover"> <thead><tr class="greyhead"><th scope="col">#</th>
                                    <th scope="col">Name</th><th scope="col">File</th><th scope="col">Delete</th>
                                    </tr></thead><tbody>';

                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>
                                        <td scope='row'>" . $row["DocId"] . "</td>
                                        <td>" . $row["DocTitle"] . "</td>
                                        <td><a href='../siteimages/docs/" . $row["DocPath"] . "' target='_blank' > <i class='fa fa-fw fa-file-pdf'></i></a></td>
                                        <td><a onclick='deleteRow(" . $row["DocId"] . ")'><i class='fa fa-fw fa-trash'></i></a></td></tr>";

                                        }

                                        echo "</tbody></table>";
                                    } else {
                                        echo "<div class='p-3 mb-2 bg-danger text-white'>No data found.</p>";
                                    }


                                    // Check if the 'id' parameter is set in the POST request
                                    if (isset($_POST['id'])) {
                                        $id = $_POST['id'];

                                        // Perform the deletion in the database -- delete mate
                                    
                                        $deleteSql = "DELETE FROM tbl_documents WHERE DocId = $id"; //not working correctly
                                    
                                        if ($conn->query($deleteSql) === TRUE) {
                                            echo "<script>";
                                            echo "alert('Document Deleted Successfully');";
                                            echo "window.location='add-document.php?id=" . $OCid . "'";
                                            echo "</script>";

                                        } else {
                                            echo "Error deleting row: " . $conn->error;
                                        }
                                    }

                                    ?>

                                </div>
                            </div>
                        </div>
                        <!-- ============================================================== -->
                        <!-- end hoverable table -->
                        <!-- ============================================================== -->
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

</body>

<?php

// Check if the form is submitted and the 'id' parameter is set
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['txtName'];

    if (isset($_POST['submit'])) {
        $target_dir = "../siteimages/docs/";
        $file_name = $_FILES['uplFile']['name'];
        $file_tmp = $_FILES['uplFile']['tmp_name'];

        $unique_filename = $OCid . time() . '_' . $file_name;

        $sql = "INSERT INTO tbl_documents (DocTitle, DocPath , Fid, CreatedDate) 
                VALUES ('$name','$unique_filename', $OCid, current_timestamp());";

        //execute the query
        if ($conn->query($sql) === TRUE) {
            // Now let's move the uploaded image into the folder: image
            if (move_uploaded_file($file_tmp, $target_dir . $unique_filename)) {
                echo "<script>";
                echo "alert('Document Added Successfully');";
                echo "window.location='add-document.php?id=" . $OCid . "'";
                echo "</script>";
            }
        }
    }


} else {
    echo "Invalid request. Please submit the form.";
}

?>

<script>
    function deleteRow(rowId) {
        var confirmDelete = confirm("Are you sure you want to delete this document?");
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

</html>