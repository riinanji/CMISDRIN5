<?php
// Include database connection
include('../include/config.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Dashboard</title>
    <link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
    <link type="text/css" href="css/theme.css" rel="stylesheet">
    <link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
    <link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
</head>
<body>

<?php include('../include/header.php');?>

<div class="wrapper">
    <div class="container">
        <div class="row">
<?php include('includes/sidebar.php');?>	
            <!-- Main content area -->
            <div class="span9">
                <div class="content">
                    <div class="module">
                        <div class="module-head">
                            <h3>Dashboard</h3>
                        </div>
                        <div class="module-body">
                            <h4>Welcome to the Admin Dashboard!</h4>
                            <p>Use the sidebar to navigate through the management options.</p>
                        </div>
                    </div>
                </div><!--/.content-->
            </div><!--/.span9-->
        </div><!--/.row-fluid-->
    </div><!--/.container-fluid-->

    <?php include('../include/footer.php');?>

<script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
<script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="scripts/flot/jquery.flot.js" type="text/javascript"></script>
<script src="scripts/datatables/jquery.dataTables.js"></script>
<script>
</body>
</html>
