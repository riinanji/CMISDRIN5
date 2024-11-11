<?php
session_start();
include('../include/config.php');

date_default_timezone_set('Asia/Manila'); // Change according to timezone
$currentTime = date('d-m-Y g:i:s A', time());

// Handle adding a new zone
if (isset($_POST['submit'])) {
    // Get the user ID from the session
     // Assuming user_ID is stored in the session

    $respondentAddress1 = $_POST['respondentName'];
    $complainantAddress = $_POST['complainantName'];
    
    
    // Insert the new zone along with the user_ID
    $sql = mysqli_query($bd, "INSERT INTO state(respondentAddress1, complainantAddress) VALUES('$respondentAddress1', '$complainantAddress')");
    
    // Check if the query was successful
    if ($sql) {
        $_SESSION['msg'] = "Zone added successfully!";
    } else {
        $_SESSION['msg'] = "Error adding zone!";
    }
}

// Handle the delete action
if (isset($_GET['del'])) {
    $id = $_GET['id'];
    mysqli_query($bd, "DELETE FROM state WHERE state_ID = '$id'");
    $_SESSION['delmsg'] = "Zone deleted!";
    header('Location: state.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Zone</title>
    <!-- Bootstrap 5 CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="css/theme.css">
    <link rel="stylesheet" href="images/icons/css/font-awesome.css">
    <link rel="stylesheet" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Custom CSS for Presentability */
        body {
            font-family: 'Open Sans', sans-serif;
            background-color: #f8f9fa;
            margin: 0 !important;
            padding: 0 !important;
        }
        .container-fluid {
            padding: 0;
        }
        .module {
            background-color: #ffffff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-top: -90px !important;
            width: 1000px;
        }
        .module-head {
            text-align: center;
        }
        .module-head h3 {
            font-weight: bold;
            color: #343a40;
        }
        .form-horizontal {
            max-width: 600px;
            margin: 0 auto;
        }
        .table thead {
            background-color: #007bff;
            color: white;
        }
        .table th, .table td {
            vertical-align: middle;
        }
        .btn-primary, .btn-warning, .btn-danger {
            border-radius: 50px;
            padding: 5px 15px;
        }
        .alert {
            margin-top: 20px;
        }
        .module-body {
            padding: 15px;
        }
        @media (max-width: 768px) {
            .container-fluid {
                padding: 10px;
            }
            .form-horizontal {
                width: 100%;
            }
            .module {
                padding: 15px;
            }
        }
    </style>
</head>

<body>
    <?php include('includes/header.php'); ?>

    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <?php include('includes/sidebar.php'); ?>
                <div class="col-md-12 ms-3">
                    <div class="content">

                        <div class="module">
                            <div class="module-head">
                                <h3>Zone</h3>
                            </div>
                            <div class="module-body">
                                <?php if (isset($_SESSION['msg'])) { ?>
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <strong>Well done!</strong> <?php echo htmlentities($_SESSION['msg']); ?>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                    <?php unset($_SESSION['msg']); ?>
                                <?php } ?>

                                <?php if (isset($_SESSION['delmsg'])) { ?>
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>Oh snap!</strong> <?php echo htmlentities($_SESSION['delmsg']); ?>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                    <?php unset($_SESSION['delmsg']); ?>
                                <?php } ?>

                                <form class="form-horizontal" name="Category" method="post">
                                    <div class="mb-3">
                                        <label for="respondentName" class="form-label">Respondent State</label>
                                        <input type="text" id="respondentName" placeholder="Enter Respondent State" name="respondentName" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="complainantName" class="form-label">Complainant State</label>
                                        <input type="text" id="complainantName" placeholder="Enter Complainant State" name="complainantName" class="form-control" required>
                                    </div>
                                    <button type="submit" name="submit" class="btn btn-primary w-100">Add Zone</button>
                                </form>
                            </div>
                        </div>

                        <div class="module mt-4">
                            <div class="module-head">
                                <h3>Manage Zones</h3>
                            </div>
                            <div class="module-body table-responsive">
                                <table class="table table-bordered table-striped" id="stateTable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Respondent State</th>
                                            <th>Complainant State</th>
                                            <th>Creation Date</th>
                                            <th>Last Updated</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $query = mysqli_query($bd, "SELECT * FROM state");
                                        $cnt = 1;
                                        while ($row = mysqli_fetch_array($query)) {
                                        ?>
                                            <tr>
                                                <td><?php echo htmlentities($cnt); ?></td>
                                                <td><?php echo htmlentities($row['respondentAddress1']); ?></td>
                                                <td><?php echo htmlentities($row['complainantAddress']); ?></td>
                                                <td><?php echo htmlentities($row['postingDate']); ?></td>
                                                <td><?php echo htmlentities($row['updationDate']); ?></td>
                                                <td>
                                                    <a href="edit-state.php?id=<?php echo $row['state_ID']; ?>" class="btn btn-warning"><i class="fas fa-edit"></i> </a>
                                                    <a href="state.php?id=<?php echo $row['state_ID']; ?>&del=delete" class="btn btn-danger" onClick="return confirm('Are you sure you want to delete?')"><i class="fas fa-trash-alt"></i> </a>
                                                </td>
                                            </tr>
                                        <?php
                                            $cnt++;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div><!--/.content-->
                </div><!--/.col-->
            </div><!--/.row-->
        </div><!--/.container-fluid-->
    </div><!--/.wrapper-->

    <?php include('includes/footer.php'); ?>

    <!-- Bootstrap 5 JS and Popper.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#stateTable').DataTable();
        });
    </script>
</body>

</html>
