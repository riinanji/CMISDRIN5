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

    <!-- Custom styles for this page -->
    <style>
        body {
            background-color: #f0f4f8;
            font-family: 'Open Sans', sans-serif;
        }

        .wrapper {
            padding: 30px;
        }

        .module {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .module-head {
            background-color: #4b6f89;
            color: #ffffff;
            padding: 15px 20px;
            border-radius: 10px 10px 0 0;
            text-align: center;
            font-weight: bold;
        }

        .module-body {
            padding: 20px;
        }

        .table {
            margin-bottom: 0;
            width: 100%;
        }

        .table th, .table td {
            padding: 12px;
            color: #333333;
        }

        .remarks-table th, .remarks-table td {
            border-top: 1px solid #ddd;
            padding: 10px;
        }

        .remarks-table td {
            padding: 10px;
            vertical-align: top;
        }

        .btn-primary {
            background-color: #4b6f89;
            color: #ffffff;
            font-weight: bold;
        }

        .btn-primary:hover {
            background-color: #3a5c76;
        }

        .btn-back, .btn-print {
            background-color: #4b6f89;
            color: #ffffff;
            font-weight: bold;
            border: none;
            cursor: pointer;
            padding: 10px 15px;
            border-radius: 5px;
            margin-top: 20px;
            margin-right: 10px;
        }

        .btn-back:hover, .btn-print:hover {
            background-color: #3a5c76;
        }

        /* Hide buttons when printing */
        @media print {
            .btn-back,
            .btn-print {
                display: none;
            }
        }

        /* Responsive Tables */
        @media (max-width: 767px) {
            .table th, .table td {
                font-size: 12px;
                padding: 8px;
            }
        }

    </style>
</head>

<body>
    <section id="container">
        <?php include('includes/header.php'); ?>
        <?php include('includes/sidebar.php'); ?>

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

                <!-- Unified Table for All Information -->
                <div class="module">
                    <div class="module-head">
                        <span>Complaint Information</span>
                    </div>
                    <div class="module-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>Complainant Name:</th>
                                <td><?php echo htmlentities($row['complainantName']); ?></td>
                                <th>Respondent Name:</th>
                                <td><?php echo htmlentities($row['respondentName']); ?></td>
                            </tr>
                            <tr>
                                <th>Complainant Number:</th>
                                <td><?php echo htmlentities($row['complainantContact']); ?></td>
                                <th>Respondent Number:</th>
                                <td><?php echo htmlentities($row['respondentContact']); ?></td>
                            </tr>
                            <tr>
                                <th>Complainant Address:</th>
                                <td><?php echo htmlentities($row['complainantAddress']); ?></td>
                                <th>Respondent Address:</th>
                                <td><?php echo htmlentities($row['respondentAddress1']); ?></td>
                            </tr>
                            <tr>
                                <th>Reg. Date:</th>
                                <td><?php echo htmlentities(date("Y-m-d G:i A", strtotime($row['regDate']))); ?></td>
                                <th>Category:</th>
                                <td><?php echo htmlentities($row['noc']); ?></td>
                            </tr>
                            <tr>
                                <th>Nature of Complaint:</th>
                                <td colspan="3"><?php echo htmlentities($row['noc']); ?></td>
                            </tr>
                            <tr>
                                <th>Complaint Details:</th>
                                <td colspan="3"><?php echo htmlentities($row['complaintDetails']); ?></td>
                            </tr>
                        </table>
                    </div>
                </div>

                <?php 
                // Fetch remarks sorted by remark date in descending order
                $ret = mysqli_query($bd, "SELECT complaintremark.remark AS remark, complaintremark.status AS sstatus, complaintremark.remarkDate AS rdate 
                                          FROM complaintremark 
                                          JOIN tblcomplaints ON tblcomplaints.complaint_ID = complaintremark.complaint_ID 
                                          WHERE complaintremark.complaint_ID = '".$_GET['cid']."' 
                                          ORDER BY complaintremark.remarkDate DESC");

                if (mysqli_num_rows($ret) > 0) {
                ?>
                    <div class="module">
                        <div class="module-head">
                            <span>Remarks</span>
                        </div>
                        <div class="module-body">
                            <table class="table table-bordered remarks-table">
                                <thead>
                                    <tr>
                                        <th>Remark</th>
                                        <th>Remark Date</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    while ($remark = mysqli_fetch_array($ret)) { ?>
                                        <tr>
                                            <td><?php echo htmlentities($remark['remark']); ?></td>
                                            <td><?php echo htmlentities($remark['rdate']); ?></td>
                                            <td><?php echo htmlentities($remark['sstatus']); ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php } else { ?>
                    <p>No remarks available for this complaint.</p>
                <?php } ?>

                <!-- Action Section -->
                <div class="module">
                    <div class="module-body">
                        <table class="table">
                            <tr>
                                <td><b>ACTION</b></td>
                                <td> 
                                    <?php if ($row['status'] == "closed") { ?>
                                        <button class="btn-print" onclick="printRecord();">Print Record</button>
                                    <?php } else { ?>
                                        <a href="updatecomplaint.php?cid=<?php echo urlencode($row['complaint_ID']); ?>" target="_blank" title="Update complaint">
                                            <button type="button" class="btn btn-primary">Take Action</button>
                                        </a>
                                    <?php } ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div style="text-align: center; margin-top: 20px;">
                    <button class="btn-back" onclick="history.back(); return false;">Back</button>
                </div>

                <?php } ?>
            </section>
        </section>
    </section>

    <!-- Scripts -->
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script>
        function printRecord() {
            window.print();
        }
    </script>
</body>
</html>
<?php } ?>
