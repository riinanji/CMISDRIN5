<?php
session_start();
include('../include/config.php');

date_default_timezone_set('Asia/Manila'); // change according timezone
$currentTime = date('d-m-Y h:i:s A', time());

if (isset($_POST['submit'])) {
    $category = $_POST['category'];
    $description = $_POST['description'];
    $id = intval($_GET['id']);
    $sql = mysqli_query($bd, "UPDATE category SET categoryName='$category', categoryDescription='$description', updationDate='$currentTime' WHERE category_ID='$id'");
    $_SESSION['msg'] = "Category Updated !!";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Category</title>
    
    <!-- Bootstrap 5 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/theme.css">
    <link rel="stylesheet" href="images/icons/css/font-awesome.css">
    <link rel="stylesheet" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600'>

</head>
<body>
<?php include('includes/header.php'); ?>

<div class="wrapper">
    <div class="container">
        <div class="row">
            <?php include('includes/sidebar.php'); ?>
            <div class="span9">
                <div class="content">
                    <div class="module">
                        <div class="module-head">
                            <h3>Category</h3>
                        </div>
                        <div class="module-body">
                            <?php if (isset($_POST['submit'])) { ?>
                                <div class="alert alert-success">
                                    <button type="button" class="close" data-bs-dismiss="alert">×</button>
                                    <strong>Well done!</strong> <?php echo htmlentities($_SESSION['msg']); ?><?php echo htmlentities($_SESSION['msg'] = ""); ?>
                                </div>
                            <?php } ?>
                            <br />

                            <form class="form-horizontal row-fluid" name="Category" method="post">
                                <?php
                                $id = intval($_GET['id']);
                                $query = mysqli_query($bd, "SELECT * FROM category WHERE category_ID='$id'");
                                while ($row = mysqli_fetch_array($query)) {
                                ?>
                                    <div class="control-group">
                                        <label class="control-label" for="basicinput">Category Name</label>
                                        <div class="controls">
                                            <input type="text" placeholder="Enter category Name" name="category" value="<?php echo htmlentities($row['categoryName']); ?>" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="basicinput">Description</label>
                                        <div class="controls">
                                            <textarea class="form-control" name="description" rows="5"><?php echo htmlentities($row['categoryDescription']); ?></textarea>
                                        </div>
                                    </div>
                                <?php } ?>

                                <div class="control-group">
                                    <div class="controls">
                                        <button type="submit" name="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div><!--/.content-->
            </div><!--/.span9-->
        </div>
    </div><!--/.container-->
</div><!--/.wrapper-->

<?php include('includes/footer.php'); ?>

<!-- jQuery and Bootstrap 5 JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="scripts/flot/jquery.flot.js"></script>
<script src="scripts/datatables/jquery.dataTables.js"></script>
<script>
    $(document).ready(function () {
        $('.datatable-1').dataTable();
        $('.dataTables_paginate').addClass("btn-group datatable-pagination");
        $('.dataTables_paginate > a').wrapInner('<span />');
        $('.dataTables_paginate > a:first-child').append('<i class="icon-chevron-left shaded"></i>');
        $('.dataTables_paginate > a:last-child').append('<i class="icon-chevron-right shaded"></i>');
    });
</script>
</body>
</html>
