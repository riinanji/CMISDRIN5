<?php
session_start();
include('../include/config.php');

// Update user status if requested
if (isset($_GET['uid']) && isset($_GET['action'])) {
    $userId = $_GET['uid'];
    $action = $_GET['action'];

    $newStatus = ($action == 'deactivate') ? 'inactive' : 'active';

    $query = "UPDATE tbl_user SET status='$newStatus' WHERE user_ID='$userId'";
    mysqli_query($bd, $query);
    header("Location: manage-users.php"); // Redirect to avoid form resubmission
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Manage Users</title>
    <!-- Bootstrap 5 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
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
        }

        h3 {
            font-size: 22px;
            color: #333;
            margin-bottom: 20px;
            text-align: center;
            background: linear-gradient(45deg, White, gray); /* Gradient for title */
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
            font-size: 14px; /* Consistent smaller font size */
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
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1); /* Card-like hover effect */
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

        .module-body {
            background-color: #fdf6e3; /* Light brown background for body */
            padding: 20px;
            border-radius: 8px;
        }

        /* Back Button Styling */
        .btn-back {
            background-color: #6c757d; /* Gray background */
            color: white; /* White text */
            font-size: 0.9rem;
            margin-bottom: 20px; /* Space between the button and the table */
        }

        .btn-back:hover {
            background-color: #5a6268; /* Darker gray hover effect */
        }

        /* Pagination Styling */
        .dataTables_wrapper .dataTables_paginate {
            margin-top: 20px; /* Space above pagination */
        }
        
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            padding: 0.5em 1em;
            margin: 0 0.2em;
            border: 1px solid #007bff;
            border-radius: 4px;
            background-color: #ffffff;
            color: #007bff;
            transition: background-color 0.3s, color 0.3s;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background-color: #007bff;
            color: white;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background-color: #007bff;
            color: white;
            border: 1px solid #007bff;
        }

        header, footer {
            background-color: gray; /* Dark background */
            color: white;
            padding: 8px 20px; /* Padding for header/footer */
            text-align: center; /* Center text */
        }

        footer {
            position: relative; /* For footer positioning */
            bottom: 0; /* Stick footer at the bottom */
            width: 100%; /* Full width footer */
        }

        /* Status Color */
        .status-active {
            color: white; /* White text for better visibility */
            background-color: green; /* Green background for active status */
            padding: 2px 4px; /* Reduced padding for a smaller appearance */
            border-radius: 3px; /* More rounded corners */
            font-weight: bold; /* Optional: make it bold */
            font-size: 12px; /* Adjusted font size */
            display: inline-block; /* Ensures the box behaves like a block */
        }

        .status-inactive {
            color: white; /* White text for better visibility */
            background-color: red; /* Red background for inactive status */
            padding: 5px 10px; /* Padding for a button-like appearance */
            border-radius: 5px; /* Rounded corners */
            font-weight: bold; /* Optional: make it bold */
        }

        @media (max-width: 768px) {
            th, td {
                font-size: 12px;
            }
            th, td {
                padding: 6px;
            }
        }
    </style>
</head>
<body>
<?php include('includes/header.php'); ?>

<?php include('includes/sidebar.php'); ?>
    <div class="container">
        <h3>Manage Users</h3>
        
        <!-- Back Button -->
        <!-- <a href="DB.php" class="btn btn-back"><i class="fas fa-arrow-left"></i> Back</a> -->

        <div class="module-body">
            <table id="userLogTable" class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Contact No</th>
                        <th>Reg. Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $query = mysqli_query($bd, "SELECT * FROM tbl_user");
                    $cnt = 1;
                    while ($row = mysqli_fetch_array($query)) {
                        // Ensure regDate is a valid timestamp
                        $regDate = strtotime($row['regDate']) ? date('F j, Y, g:i a', strtotime($row['regDate'])) : 'Invalid date';
                    ?>
                    <tr>
                        <td><?php echo htmlentities($cnt); ?></td>
                        <td><?php echo htmlentities($row['fullName']); ?></td>
                        <td><?php echo htmlentities($row['userEmail']); ?></td>
                        <td><?php echo htmlentities($row['contactNo']); ?></td>
                        <td><?php echo $regDate; ?></td>
                        <td class="<?php echo ($row['status'] == 'active') ? 'status-active' : 'status-inactive'; ?>">
                            <?php echo htmlentities($row['status']); ?>
                        </td>
                    </tr>
                    <?php $cnt++; } ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#userLogTable').DataTable({
                "pageLength": 10,
                "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
                "pagingType": "simple_numbers"
                "ordering": false
            });
        });
    </script>
</body>
<footer>
    <p>&copy; 2024 Agusan Canyon. All rights reserved.</p>
</footer>
</html>
