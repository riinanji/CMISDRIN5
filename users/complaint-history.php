<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('../include/config.php');

// Check if the session ID is set
if (!isset($_SESSION['id'])) {
    die('Session ID not found.');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CMS | Complaint History</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">
    <link href="assets/css/table-responsive.css" rel="stylesheet">
    <style>
        .hidden-complaint-number {
            display: none;
        }
    </style>
</head>
<body>
<section id="container">
    <?php include("../include/header.php"); ?>
    <?php include("../include/sidebar.php"); ?>

    <section id="main-content">
        <section class="wrapper">
            <h3><i class="fa fa-angle-right"></i> Your Complaint History</h3>
            <div class="row mt">
                <div class="col-lg-12">
                    <div class="content-panel">
                        <section id="unseen">
                            <table class="table table-bordered table-striped table-condensed">
                                <thead>
                                <tr>
                                    <th class="hidden-complaint-number">Complaint Number</th>
                                    <th>Reg Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                // Query to fetch the complaints for the logged-in user
                                $query = mysqli_query($bd, "SELECT * FROM tblcomplaints WHERE user_ID='" . $_SESSION['id'] . "'");
                                if (!$query) {
                                    die('Query failed: ' . mysqli_error($bd));
                                }

                                while ($row = mysqli_fetch_array($query)) {
                                    // Format regDate and lastUpdationDate
                                    $regDate = date('Y-m-d h:i A', strtotime($row['regDate']));
                                    $lastUpdationDate = !empty($row['lastUpdationDate']) && $row['lastUpdationDate'] != "0000-00-00 00:00:00" 
                                        ? date('Y-m-d h:i A', strtotime($row['lastUpdationDate'])) 
                                        : "Not Updated Yet"; // Fallback message
                                ?>
                                <tr>
                                    <td class="hidden-complaint-number" align="center"><?php echo htmlentities($row['complaint_ID']); ?></td>
                                    <td align="center"><?php echo htmlentities($regDate); ?></td>
                                    <td align="center">
                                        <?php
                                        $status = $row['status'];
                                        if ($status == "" || $status == "NULL") { ?>
                                            <button type="button" class="btn btn-theme04">Not Processed Yet</button>
                                        <?php } elseif ($status == "in process") { ?>
                                            <button type="button" class="btn btn-warning">In Process</button>
                                        <?php } elseif ($status == "closed") { ?>
                                            <button type="button" class="btn btn-success">Closed</button>
                                        <?php } ?>
                                    </td>
                                    <td align="center">
                                        <a href="complaint-details.php?cid=<?php echo htmlentities($row['complaint_ID']); ?>">
                                            <button type="button" class="btn btn-primary">View Details</button>
                                        </a>
                                    </td>
                                </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </section>
                    </div>
                </div>
            </div>
        </section>
    </section>

    <?php include("../include/footer.php"); ?>
</section>

<script src="assets/js/jquery.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
<script src="assets/js/jquery.scrollTo.min.js"></script>
<script src="assets/js/jquery.nicescroll.js"></script>
<script src="assets/js/common-scripts.js"></script>
</body>
</html>
