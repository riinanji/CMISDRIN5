<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('../include/config.php');

// Check if user ID is in session
if (!isset($_SESSION['id'])) {
    die('User ID not found in session.');
}

$uid = $_SESSION['id'];

// Redirect if not logged in
if (strlen($_SESSION['login']) == 0) { 
    header('location:index.php');
    exit();
} else {
    if (isset($_POST['submit'])) {
        $complainantName = $_POST['complainantName'];
        $complainantContact = $_POST['complainantContact'];
        $category = $_POST['category'];
        $state = $_POST['state'];
        $noc = $_POST['noc'];
        $complaintDetails = $_POST['complaindetails'];
        $respondentName = $_POST['respondentName'];
        $respondentContact = $_POST['respondentContact'];
        $compfile = $_FILES["compfile"]["name"];

        // File upload handling
        if (!empty($compfile)) {
            $target_dir = "complaintdocs/";
            $target_file = $target_dir . basename($compfile);
            if (!move_uploaded_file($_FILES["compfile"]["tmp_name"], $target_file)) {
                echo '<script>alert("File upload failed.")</script>';
            }
        }

        // Insert complaint details
        $query = "INSERT INTO tblcomplaints (user_ID, complainantName, complainantContact, category, state, noc, complaintDetails, complaintFile, respondentName, respondentContact) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $bd->prepare($query);

        if ($stmt === false) {
            die('Prepare failed: ' . htmlspecialchars($bd->error));
        }

        $stmt->bind_param("isssssssss", $uid, $complainantName, $complainantContact, $category, $state, $noc, $complaintDetails, $compfile, $respondentName, $respondentContact);

        if ($stmt->execute()) {
            $sql = "SELECT complaint_ID FROM tblcomplaints ORDER BY complaint_ID DESC LIMIT 1";
            $result = $bd->query($sql);
            if ($result) {
                $row = $result->fetch_assoc();
                $complainno = $row['complaint_ID'];
                echo '<script>alert("Your complaint has been successfully filed, and your complaint number is ' . $complainno . '")</script>';
            } else {
                echo '<script>alert("Error fetching complaint number: ' . $bd->error . '")</script>';
            }
        } else {
            echo '<script>alert("Error executing query: ' . $stmt->error . '")</script>';
        }

        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CMS | User Register Complaint</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="assets/js/bootstrap-datepicker/css/datepicker.css" />
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>
<section id="container">
    <?php include("../include/header.php");?>
    <?php include("../include/sidebar.php");?>
    <section id="main-content">
        <section class="wrapper">
            <h3><i class="fa fa-angle-right"></i> Add Complaint</h3>
            <div class="row mt">
                <div class="col-lg-12">
                    <div class="form-panel">
                        <form class="form-horizontal style-form" method="post" name="complaint" enctype="multipart/form-data">
                            <div class="row">
                                <!-- Complainant Column -->
                                <div class="col-md-6">
                                    <h4>Complainant Details</h4>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Complainant Name</label>
                                        <div class="col-sm-8">
                                            <input type="text" name="complainantName" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Complainant Zone</label>
                                        <div class="col-sm-8">
                                            <select name="state" required="required" class="form-control">
                                                <option value="">Select Zone</option>
                                                <?php 
                                                $sql = mysqli_query($bd, "SELECT complainantAddress FROM state");
                                                while ($rw = mysqli_fetch_array($sql)) { ?>
                                                    <option value="<?php echo htmlentities($rw['complainantAddress']);?>"><?php echo htmlentities($rw['complainantAddress']);?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Complainant Contact</label>
                                        <div class="col-sm-8">
                                            <input type="text" name="complainantContact" class="form-control" required>
                                        </div>
                                    </div>
                                </div>

                                <!-- Respondent Column -->
                                <div class="col-md-6">
                                    <h4>Respondent Details</h4>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Respondent Name</label>
                                        <div class="col-sm-8">
                                            <input type="text" name="respondentName" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Respondent Zone</label>
                                        <div class="col-sm-8">
                                            <select name="state" required="required" class="form-control">
                                                <option value="">Select Zone</option>
                                                <?php 
                                                $sql = mysqli_query($bd, "SELECT respondentAddress1 FROM state");
                                                while ($rw = mysqli_fetch_array($sql)) { ?>
                                                    <option value="<?php echo htmlentities($rw['respondentAddress1']);?>"><?php echo htmlentities($rw['respondentAddress1']);?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Respondent Contact</label>
                                        <div class="col-sm-8">
                                            <input type="text" name="respondentContact" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <!-- Additional Complaint Information -->
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Category</label>
                                <div class="col-sm-4">
                                    <select name="category" id="category" class="form-control" onChange="getCat(this.value);" required="">
                                        <option value="">Select Category</option>
                                        <?php 
                                        $sql = mysqli_query($bd, "SELECT category_ID, categoryName FROM category");
                                        while ($rw = mysqli_fetch_array($sql)) { ?>
                                            <option value="<?php echo htmlentities($rw['category_ID']);?>"><?php echo htmlentities($rw['categoryName']);?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Nature of Complaint</label>
                                <div class="col-sm-4">
                                    <input type="text" name="noc" required="required" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Complaint Details (max 2000 words)</label>
                                <div class="col-sm-6">
                                    <textarea name="complaindetails" required="required" cols="10" rows="10" class="form-control" maxlength="2000"></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Complaint Related Doc (if any)</label>
                                <div class="col-sm-6">
                                    <input type="file" name="compfile" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-10" style="padding-left:25%">
                                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </section>
    <?php include("../include/footer.php");?>
</section>

<!-- JS scripts -->
<script src="assets/js/jquery.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/bootstrap-datepicker.js"></script>
<script src="assets/js/custom.js"></script>
</body>
</html>
