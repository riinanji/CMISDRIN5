<?php
session_start();
include('../include/config.php');

date_default_timezone_set('Asia/Manila'); // Set the timezone
$currentTime = date('d-m-Y h:i:s A', time());
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Not Processed Complaints</title>
    <link type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.1/css/bootstrap.min.css" rel="stylesheet"> <!-- Updated Bootstrap CSS -->
    <link type="text/css" href="css/theme.css" rel="stylesheet">
    <link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
    <link type="text/css" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet"> <!-- Updated DataTables CSS -->
    <link type="text/css" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet"> <!-- Updated DataTables Bootstrap CSS -->
    <style>
        body {
            background: linear-gradient(to right, #e2e2e2, #ffffff);
            font-family: 'Open Sans', sans-serif;
            margin: 0;
            padding: 20px;
        }

        .module {
            width: 100%;
            max-width: 800px; /* Set max width for the table container */
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }

        .module-head h3 {
            text-align: center;
            font-weight: 700;
            color: #343a40;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            padding: 12px;
            text-align: center;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f8f9fa;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .btn-danger:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }

        .dataTables_filter {
            text-align: left;
            float: left;
        }

        .dataTables_length {
            float: right;
            margin-right: 10px;
        }

        .hidden {
            display: none;
        }

        th.sorting:after, th.sorting_asc:after, th.sorting_desc:after {
            display: none;
        }

        @media screen and (max-width: 768px) {
            table, th, td {
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>

    <div class="wrapper">
        <?php include('includes/sidebar.php'); ?>
        <div class="content">
            <div class="module">
                <div class="module-head">
                    <h3>Not Processed Complaints</h3>
                </div>
                <div class="module-body table">
                    <table id="complaintsTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="hidden">Complaint No</th>
                                <th>Staff acc</th>
                                <th>Registration Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $query = "SELECT tblcomplaints.*, tbl_user.fullName as name 
                                FROM tblcomplaints 
                                JOIN tbl_user ON tbl_user.user_ID = tblcomplaints.user_ID 
                                WHERE tblcomplaints.status IS NULL OR tblcomplaints.status = '' 
                                ORDER BY tblcomplaints.complaint_ID DESC";

                            $result = mysqli_query($bd, $query);

                            if (!$result) {
                                echo "<tr><td colspan='5'>Error: " . mysqli_error($bd) . "</td></tr>";
                            } elseif (mysqli_num_rows($result) == 0) {
                                echo "<tr><td colspan='5'>No Not Processed Complaints Found</td></tr>";
                            } else {
                                while ($row = mysqli_fetch_assoc($result)) {
                            ?>                                          
                                <tr>
                                    <td class="hidden"><?php echo htmlentities($row['complaint_ID']); ?></td>
                                    <td><?php echo htmlentities($row['name']); ?></td>
                                    <td><?php echo htmlentities($row['regDate']); ?></td>
                                    <td><button type="button" class="btn btn-danger">Not Processed</button></td>
                                    <td><a href="complaint-details.php?cid=<?php echo htmlentities($row['complaint_ID']); ?>" class="btn btn-warning">View Details</a></td>
                                </tr>
                            <?php 
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Updated jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.1/js/bootstrap.bundle.min.js"></script> <!-- Updated Bootstrap JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script> <!-- Updated DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script> <!-- Updated DataTables Bootstrap JS -->
    
    <script>
        $(document).ready(function() {
            $('#complaintsTable').DataTable(); // Initialize DataTable
        });
    </script>
</body>
</html>
