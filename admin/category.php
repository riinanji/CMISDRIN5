<?php
session_start();
include('../include/config.php'); // Ensure the correct path and the database connection is set up in config.php

// Set timezone
date_default_timezone_set('Asia/Manila');
$currentTime = date('d-m-Y h:i:s A', time());

// Handle form submission
if (isset($_POST['submit'])) {
    $category = $_POST['category'];
    $user_ID = 1; // Adjust based on your application's logic, e.g., from session

    // Insert new category
    $sql = mysqli_query($bd, "INSERT INTO category (categoryName, user_ID) VALUES ('$category', '$user_ID')");
    $_SESSION['msg'] = "Category Created !!";
}

// Handle category deletion
if (isset($_GET['del']) && isset($_GET['id'])) {
    mysqli_query($bd, "DELETE FROM category WHERE category_ID = '" . $_GET['id'] . "'");
    $_SESSION['delmsg'] = "Category deleted !!";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Category</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/theme.css">
    <link rel="stylesheet" href="images/icons/css/font-awesome.css">
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            margin: 0;
            padding: 0;
        }
        .wrapper {
            max-width: 100%;
            max-height: 100vh;
            padding: 0;
            margin-right: 0;
            border-radius: 10px !important;
        }
        .content {
            margin-top: 0 !important;
        }
        .module-body {
            padding: 20px;
            background-color: #fdf6e3; /* Light brown background */
            border-radius: 8px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 8px;
            text-align: center;
            border: 1px solid #ddd;
            font-size: 14px;
        }
        th {
            background-color: #f7e7ce;
            font-weight: bold;
        }
        td {
            background-color: #fff;
        }
        .btn {
            font-size: 13px;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
            color: white;
        }
        .btn-close {
            float: right;
        }
        .alert {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<?php include('includes/header.php'); ?>
<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <?php include('includes/sidebar.php'); ?>
            <div class="col-9">
                <div class="content">
                    <div class="module">
                        <div class="module-head">
                            <h3>Category</h3>
                        </div>
                        <div class="module-body">
                            <?php if (isset($_SESSION['msg'])) { ?>
                                <div class="alert alert-success">
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                    <strong>Well done!</strong> <?php echo htmlentities($_SESSION['msg']); ?>
                                    <?php $_SESSION['msg'] = ""; ?>
                                </div>
                            <?php } ?>
                            <form class="form-horizontal row-fluid" name="Category" method="post">
                                <div class="mb-3">
                                    <label for="basicinput" class="form-label">Category Name</label>
                                    <input type="text" placeholder="Enter category Name" name="category" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <button type="submit" name="submit" class="btn btn-primary">Create</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="module">
                        <div class="module-head">
                            <h3>Manage Categories</h3>
                        </div>
                        <div class="module-body table-responsive">
                            <table class="datatable-1 table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Category</th>
                                        <th>Creation date</th>
                                        <th>Last Updated</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $query = mysqli_query($bd, "SELECT * FROM category");
                                    $cnt = 1;
                                    while ($row = mysqli_fetch_array($query)) { ?>
                                        <tr>
                                            <td><?php echo htmlentities($cnt); ?></td>
                                            <td><?php echo htmlentities($row['categoryName']); ?></td>
                                            <td><?php echo htmlentities($row['creationDate']); ?></td>
                                            <td><?php echo htmlentities($row['updationDate']); ?></td>
                                            <td>
                                                <a href="edit-category.php?id=<?php echo $row['category_ID']; ?>" class="text-primary" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="category.php?id=<?php echo $row['category_ID']; ?>&del=delete" onClick="return confirm('Are you sure you want to delete this category?')" class="text-danger" title="Delete">
                                                    <i class="fas fa-trash-alt"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php $cnt++; } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>                        
                </div><!--/.content-->
            </div><!--/.col-9-->
        </div><!--/.row-->
    </div><!--/.container-fluid-->
</div><!--/.wrapper-->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="scripts/datatables/jquery.dataTables.js"></script>
<script>
    $(document).ready(function() {
        $('.datatable-1').DataTable();
    });
</script>
</body>
</html>
