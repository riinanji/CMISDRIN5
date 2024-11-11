<?php 
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('../include/config.php');

if (!isset($_SESSION['id'])) {
    header('location:index.php');
    exit();
} else { ?>

<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>CMS | Complaint Details</title>
        <!-- CSS Stylesheets -->
        <link href="assets/css/bootstrap.css" rel="stylesheet">
        <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet">
        <link href="assets/css/style.css" rel="stylesheet">
        <link href="assets/css/style-responsive.css" rel="stylesheet">
        <style>
            body {
                font-family: 'Arial', sans-serif;
                background-color: #f4f6f9;
            }

            .card {
                border-radius: 10px;
                margin-bottom: 20px;
            }

            .card-header {
                background-color: #6c757d; /* Changed to gray */
                color: white;
                text-align: center;
                font-size: 18px;
                font-weight: bold;
                border-radius: 10px 10px 0 0;
            }

            .card-body {
                padding: 20px;
                background-color: #ffffff;
                border-radius: 0 0 10px 10px;
            }

            table {
                width: 100%;
                margin-bottom: 20px;
            }

            table th {
                background-color: #f8f9fa;
                color: #495057;
                text-align: left;
                font-weight: bold;
            }
            table td {
                padding: 8px;
                color: #495057;
            }

            .btn {
                border-radius: 5px;
                padding: 10px 20px;
                font-size: 16px;
            }

            .btn-primary {
                background-color: #007bff;
                border: none;
            }

            .btn-success {
                background-color: #28a745;
                border: none;
            }

            .remarks-section {
                background-color: #f8f9fa;
            }

            .table-header th {
                background-color: #007bff;
                color: white;
            }

            .highlight {
                background-color: #d1ecf1;
            }

            .text-center {
                text-align: center;
            }

            /* Responsive Design for smaller screens */
            @media (max-width: 768px) {
                .card-body {
                    padding: 15px;
                }

                .btn {
                    width: 100%;
                    margin: 5px 0;
                }
            }
        </style>
    </head>
    
    <body>
    <section id="container">
        <?php include('../include/header.php'); ?>
        <?php include('../include/sidebar.php'); ?>
    
        <section id="main-content">
    <section class="wrapper site-min-height">
        <h3 class="mb-4"><i class="fa fa-angle-right"></i> Complaint Details</h3>
        <hr />

        <?php 
            $stmt = mysqli_prepare($bd, "
                SELECT tblcomplaints.*, 
                       tblcomplaints.complainantContact AS complainantContact,
                       tblcomplaints.respondentContact AS respondentContact,
                       state.complainantAddress AS complainantAddress,
                       state.respondentAddress1 AS respondentAddress1
                FROM tblcomplaints 
                JOIN state ON state.user_ID = tblcomplaints.state
                WHERE tblcomplaints.user_ID = ? 
                AND tblcomplaints.complaint_ID = ?");
            
            mysqli_stmt_bind_param($stmt, 'ii', $_SESSION['id'], $_GET['cid']);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_array($result);
        ?>

        <!-- Complainant Information Section -->
        <div class="table-section">
            <div class="section-title">Complainant Information</div>
            <table class="table table-bordered">
                <tr>
                    <th>Complainant Name:</th>
                    <td><?php echo htmlentities($row['complainantName']); ?></td>
                    <th>Complainant Number:</th>
                    <td><?php echo htmlentities($row['complainantContact']); ?></td>
                </tr>
                <tr>
                    <th>Complainant Address:</th>
                    <td colspan="3"><?php echo htmlentities($row['complainantAddress']); ?></td>
                </tr> 
            </table>
        </div>

        <!-- Respondent Information Section -->
        <div class="table-section">
            <div class="section-title">Respondent Information</div>
            <table class="table table-bordered">
                <tr>
                    <th>Respondent Name:</th>
                    <td><?php echo htmlentities($row['respondentName']); ?></td>
                    <th>Respondent Number:</th>
                    <td><?php echo htmlentities($row['respondentContact']); ?></td>
                </tr>
                <tr>
                    <th>Respondent Address:</th>
                    <td colspan="3"><?php echo htmlentities($row['respondentAddress1']); ?></td>
                </tr> 
            </table>
        </div>

        <!-- Complaint Information Section -->
        <div class="table-section">
            <div class="section-title">Complaint Information</div>
            <table class="table table-bordered">
                <tr>
                    <th>Reg. Date:</th>
                    <td><?php echo htmlentities(date("Y-m-d G:i A", strtotime($row['regDate']))); ?></td>
                    <th>Category:</th>
                    <td><?php echo htmlentities($row['noc']); ?></td>
                </tr>
                <tr>
                    <th>Nature of Complaint:</th>
                    <td><?php echo htmlentities($row['noc']); ?></td>
                    <th>File:</th>
                    <td>File NA</td>
                </tr>
                <tr>
                    <th>Complaint Details:</th>
                    <td colspan="3"><?php echo htmlentities($row['complaintDetails']); ?></td>
                </tr>
            </table>
        </div>

       <!-- Remarks & Status Section -->
<div class="card">
    <div class="card-header bg-secondary text-white">
        <strong>Remarks & Status</strong>
    </div>
    <div class="card-body">
        <?php 
            // Query to fetch remarks, status, and date
            $stmt_remark = mysqli_prepare($bd, "SELECT remark, status, remarkDate FROM complaintremark WHERE complaint_ID = ?");
            mysqli_stmt_bind_param($stmt_remark, 'i', $_GET['cid']);
            mysqli_stmt_execute($stmt_remark);
            $result_remark = mysqli_stmt_get_result($stmt_remark);

            // Check if there are remarks
            if (mysqli_num_rows($result_remark) > 0) { ?>
                <table class="table table-bordered">
                    <thead class="table-secondary">
                        <tr>
                            <th>Remark</th>
                            <th>Status</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        // Fetch each remark and display it
                        while ($rw = mysqli_fetch_array($result_remark)) { ?>
                            <tr class="table-light">
                                <td><?php echo htmlentities($rw['remark']); ?></td>
                                <td><?php echo htmlentities($rw['status']); ?></td>
                                <td><?php echo htmlentities(date("Y-m-d h:i A", strtotime($rw['remarkDate']))); ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            <?php } else {
                // If no remarks, display a message
                echo '<p>No remarks found.</p>';
            } ?>
    </div>
</div>


        <!-- Action Buttons -->
        <div class="text-center mb-4">
            <?php if (isset($row['status']) && strtolower($row['status']) === 'closed') { ?>
                <a href="print_complaint.php?cid=<?php echo $_GET['cid']; ?>" target="_blank" class="btn btn-primary mr-2">
                    Print Complaint Details
                </a>
            <?php } ?>
            <a href="sms.php?cid=<?php echo $_GET['cid']; ?>" target="_blank" class="btn btn-success">
                Send SMS Notification
            </a>
        </div>

        <?php } else {
            echo "<p class='text-center'>No complaint details found.</p>";
        } ?>
    </section>
</section>

<?php include('../include/footer.php'); ?>

    
    <!-- JavaScript Files -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/common-scripts.js"></script>
    </body>
    </html>
    
<?php } ?>
