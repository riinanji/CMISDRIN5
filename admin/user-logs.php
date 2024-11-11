<?php
session_start();
include('../include/config.php');

// Ensure the logout time is updated when a user logs out
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $logout_time = date("Y-m-d H:i:s"); // Current time in 24-hour format

    // Update the logout time in the userlog table
    $query = "UPDATE userlog SET logout = '$logout_time' WHERE user_id = '$user_id' AND logout IS NULL";
    mysqli_query($bd, $query);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Users Log</title>
    <!-- Updated Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Updated DataTables CSS -->
    <link href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #e2e2e2, #ffffff);
            font-family: 'Open Sans', sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            position: relative;
            z-index: 1;
        }

        h3 {
            font-size: 22px;
            color: #333;
            margin-bottom: 20px;
            text-align: center;
            background: linear-gradient(45deg, white, gray);
            color: white;
            padding: 10px;
            border-radius: 8px;
        }

        table {
            width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse;
        }

        th, td {
            padding: 8px;
            text-align: center;
            border: 1px solid #ddd;
            font-size: 14px;
        }

        th {
            background-color: #f7e7ce;
            font-weight: bold;
        }

        td {
            background-color: #fff;
        }

        .table-hover tbody tr:hover {
            background-color: #f0f0f0;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        .btn {
            font-size: 13px;
        }

        .btn-warning {
            background-color: #ffc107;
            border: none;
            color: white;
        }

        .btn-success {
            background-color: #28a745;
            border: none;
            color: white;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            color: white;
        }

        .btn-primary:hover, .btn-warning:hover, .btn-success:hover {
            opacity: 0.85;
        }

        .back-btn {
            margin-bottom: 20px;
            background-color: #6c757d;
            border: none;
            color: white;
        }

        @media (max-width: 768px) {
            th, td {
                font-size: 12px;
            }
            th, td {
                padding: 6px;
            }
        }
        
        header, footer {
            background-color: gray;
            color: white;
            padding: 8px 10px;
            text-align: center;
        }

        footer {
            position: relative;
            bottom: 0;
            width: 100%;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 250px;
            background-color: #f8f9fa;
            z-index: 2;
            overflow-y: auto;
        }
    </style>
</head>

<body>

<?php include('includes/header.php'); ?>
<?php include('includes/sidebar.php'); ?>
    <div class="container">
        <h3>User Log</h3>
        <div class="module-body"> 
            <table id="userLogTable" class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>User Email</th>
                        <th>Login Time</th>
                        <th>Logout Time</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $query = mysqli_query($bd, "SELECT * FROM userlog");
                    $cnt = 1;
                    while ($row = mysqli_fetch_array($query)) {
                    ?>									
                        <tr>
                            <td><?php echo htmlentities($cnt); ?></td>
                            <td><?php echo htmlentities($row['username']); ?></td>
                            <td><?php echo date("Y-m-d g:i A", strtotime($row['loginTime'])); ?></td>
                            <td>
                                <?php 
                                $logoutTime = $row['logout'];
                                echo ($logoutTime) ? date("Y-m-d g:i A", strtotime($logoutTime)) : "Still Logged In";
                                ?>
                            </td>
                            <td>
                                <?php 
                                $st = $row['status'];
                                echo ($st == 1) ? "Successful" : "Failed";
                                ?>
                            </td>
                        </tr>
                    <?php $cnt++; } ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Updated jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!-- Updated Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <!-- Updated DataTables JavaScript -->
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#userLogTable').DataTable({
            "pageLength": 10,
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            "pagingType": "simple_numbers",
            "ordering": false // Disable sorting arrows
        });
    });
</script>
</body>
<footer>
    <p>&copy; 2024 Agusan Canyon. All rights reserved.</p>
</footer>
</html>
