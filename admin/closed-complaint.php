<?php
session_start();
include('../include/config.php');

date_default_timezone_set('Asia/Manila'); // Set the timezone
$currentTime = date('d-m-Y h:i:s A', time());
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Closed Complaints</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/theme.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">

    <style>
        body {
            background: linear-gradient(to right, #e2e2e2, #ffffff);
            font-family: 'Open Sans', sans-serif;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 900px;
            margin: auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }

        h3 {
            font-size: 2rem;
            font-weight: 700;
            color: #343a40;
            margin-bottom: 20px;
            text-align: center;
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

        .btn {
            border-radius: 5px;
            font-weight: bold;
        }

        .btn-warning {
            background-color: #ffc107;
            color: white;
        }

        .btn-secondary {
            background-color: #6c757d;
            color: white;
        }

        .dataTables_filter {
            text-align: left;
            float: left;
        }

        .dataTables_length {
            float: right;
            margin-right: 10px;
        }

        @media screen and (max-width: 768px) {
            .container {
                max-width: 100%;
                padding: 10px;
            }

            table, th, td {
                font-size: 0.9rem;
            }
        }

        header, footer {
            background-color: #2c3e50; /* Dark background */
            color: white;
            padding: 10px 20px; /* Padding for header/footer */
            text-align: center; /* Center text */
        }

        footer {
            position: relative; /* For footer positioning */
            bottom: 0; /* Stick footer at the bottom */
            width: 100%; /* Full width footer */
        }

    </style>
</head>
<body>

<div class="wrapper">
    <div class="container">
        <?php include('includes/sidebar.php'); ?>

        <h3>Closed Complaints</h3>
        <div class="module-body table">
            <table id="closedComplaintsTable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Staff Account</th>
                        <th>Reg Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $st = 'closed';
                    $query = mysqli_query($bd, "SELECT tblcomplaints.*, tbl_user.fullName AS name FROM tblcomplaints 
                                                JOIN tbl_user ON tbl_user.user_ID = tblcomplaints.user_ID 
                                                WHERE tblcomplaints.status = '$st'");

                    if (!$query) {
                        echo "<tr><td colspan='4'>Error: " . mysqli_error($bd) . "</td></tr>";
                    } elseif (mysqli_num_rows($query) == 0) {
                        echo "<tr><td colspan='4'>No Closed Complaints Found</td></tr>";
                    } else {
                        while ($row = mysqli_fetch_assoc($query)) {
                    ?>                                        
                    <tr>
                        <td><?php echo htmlentities($row['name']); ?></td>
                        <td><?php echo htmlentities($row['regDate']); ?></td>
                        <td><span class="btn btn-secondary">Closed</span></td>
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

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function() {
        $('#closedComplaintsTable').DataTable();
    });
</script>

<footer>
    <p>&copy; 2024 Agusan Canyon. All rights reserved.</p>
</footer>
</body>
</html>
