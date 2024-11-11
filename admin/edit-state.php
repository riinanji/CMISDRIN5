<?php
session_start();
include('../include/config.php');

date_default_timezone_set('Asia/Manila');
$currentTime = date('d-m-Y h:i:s A', time());

// Adding a new Sitio
if (isset($_POST['add'])) {
    $state = mysqli_real_escape_string($bd, $_POST['state']);
    $description = mysqli_real_escape_string($bd, $_POST['description']);

    $sql = mysqli_query($bd, "INSERT INTO state (stateName, stateDescription, creationDate) VALUES ('$state', '$description', '$currentTime')");

    if ($sql) {
        $_SESSION['msg'] = "New Sitio added!";
        header("Location: user-register-complaints.php?state=" . urlencode($state)); // Redirect after adding
        exit();
    } else {
        $_SESSION['msg'] = "Error adding new Sitio!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Add State</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/theme.css" rel="stylesheet">
    <link href="images/icons/css/font-awesome.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
</head>
<body>

<?php include('includes/header.php');?>


<div class="wrapper">
    <div class="container">
        <div class="row">
            <?php include('includes/sidebar.php'); ?>                
            <div class="col-md-9">
                <div class="content">
                    <div class="module">
                        <div class="module-head">
                            <h3>Add New Sitio</h3>
                        </div>
                        <div class="module-body">
                            <?php if (isset($_SESSION['msg'])) { ?>
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <strong>Well done!</strong> <?php echo htmlentities($_SESSION['msg']); ?>
                                    <?php unset($_SESSION['msg']); // Clear message after displaying ?>
                                </div>
                            <?php } ?>

                            <br />

                            <form class="form-horizontal" name="Category" method="post">
                                <div class="mb-3">
                                    <label for="basicinput" class="form-label">Sitio Name</label>
                                    <input type="text" placeholder="Enter Sitio Name" name="state" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label for="basicinput" class="form-label">Description</label>
                                    <textarea class="form-control" name="description" rows="5"></textarea>
                                </div>

                                <div class="mb-3">
                                    <button type="submit" name="add" class="btn btn-primary">Add Sitio</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div><!--/.content-->
            </div><!--/.span9-->
        </div>
    </div><!--/.container-->
</div><!--/.wrapper-->

<!-- jQuery and Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha384-KyZXEAg3QhqLMpG8r+Knujsl5+zU5h4ZyT5ZT2/ty8O+XQgFALdVu9mo0e4G+eD5" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

<script src="scripts/flot/jquery.flot.js"></script>
<script src="scripts/datatables/jquery.dataTables.js"></script>
</body>
</html>
