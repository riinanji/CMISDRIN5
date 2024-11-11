<?php 
include('../include/config.php');

// Check if the connection is successful
if ($bd->connect_error) { 
    die("Database connection failed: " . $bd->connect_error); 
}

// Fetch the month and status value from the URL or use defaults
$month = isset($_GET['month']) ? $_GET['month'] : date("Y-m");
$status = isset($_GET['status']) ? $_GET['status'] : '';

// Prepare the SQL query with status filtering
$query = "SELECT * FROM tblcomplaints WHERE date_format(regDate,'%Y-%m') = '{$month}'";
if ($status != '') {
    $query .= " AND complaintStatus = '{$status}'";
}
$query .= " ORDER BY unix_timestamp(regDate) DESC";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monthly Complaint Reports</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        /* Global Styling */
        body {
            background: linear-gradient(to right, #e2e2e2, #ffffff);
            font-family: 'Open Sans', sans-serif;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            padding: 20px;
        }

        h5 {
            font-size: 1.4rem; /* Larger heading font */
            color: #343a40;
            font-weight: 600;
        }

        /* Form and Button Styling */
        .form-label {
            font-weight: bold;
        }

        .btn-primary {
            background-color: #d3a87e; /* Light brown background */
            border: none;
            font-size: 0.9rem;
        }

        .btn-primary:hover {
            background-color: #c7996a; /* Darker brown hover effect */
        }

        .btn-light {
            font-size: 0.9rem;
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

        /* Table Styling */
        .table {
            font-size: 0.9rem;
            border-radius: 5px;
            overflow: hidden;
            margin-top: 20px; /* Adding space between the form and table */
        }

        .table-bordered th, .table-bordered td {
            border: 1px solid #ddd; /* Lighter borders */
        }

        .table thead {
            background-color: #f8f9fa; /* Light background for the header */
            font-size: 1rem;
        }

        .table tbody tr:hover {
            background-color: #f1f1f1; /* Row hover effect */
        }

        /* Badge Styling */
        .badge {
            padding: 8px 12px;
            border-radius: 12px;
            font-size: 0.85rem;
        }

        /* Print Button */
        #printButton {
            background-color: #ffffff;
            color: #333;
            border: 1px solid #ddd;
            padding: 6px 12px;
            transition: all 0.3s;
        }

        #printButton:hover {
            background-color: #e2e2e2;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card shadow-lg">
                    <div class="card-header">
                        <h5 class="card-title">Monthly Complaint Reports</h5>
                    </div>
                    <div class="card-body">
                        <!-- Back Button -->
                        <a href="complaint_history.php" class="btn btn-back"><i class="fas fa-arrow-left"></i> Back</a>
                        <form action="" method="get" id="filter">
                            <div class="row g-3">
                                <div class="col-lg-3 col-md-4">
                                    <label for="month" class="form-label">Month</label>
                                    <input type="month" name="month" id="month" value="<?= $month ?>" class="form-control" required>
                                </div>
                                <div class="col-lg-3 col-md-4">
                                    <label for="status" class="form-label">Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="">All</option>
                                        <option value="closed" <?= $status == 'closed' ? 'selected' : '' ?>>Closed</option>
                                        <option value="pending" <?= $status == 'pending' ? 'selected' : '' ?>>Pending</option>
                                    </select>
                                </div>
                                <div class="col-lg-3 col-md-4 d-flex align-items-end">
                                    <button type="submit" class="btn btn-primary me-2"><i class="fa fa-filter"></i> Filter</button>
                                    <button type="button" class="btn btn-light border" id="printButton"><i class="fa fa-print"></i> Print</button>
                                </div>
                            </div>
                        </form>
                        <div class="table-responsive" id="printContent">
                            <table class="table table-bordered table-striped">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Date Filed</th>
                                        <th>Complainant</th>
                                        <th>Respondent</th>
                                        <th>Contact Number</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $i = 1;
                                    $total_complaints = 0;

                                    $complaints = $bd->query($query);

                                    if ($complaints->num_rows > 0) {
                                        while($row = $complaints->fetch_assoc()): 
                                            $total_complaints++; 
                                    ?>
                                    <tr>
                                        <td class="text-center"><?= $i++; ?></td>
                                        <td><?= date("Y-m-d h:i A", strtotime($row['regDate'])) ?></td>
                                        <td><?= $row['complainantName'] ?></td>
                                        <td><?= $row['respondentName'] ?></td>
                                        <td><?= $row['contactNumber'] ?></td>
                                        <td>
                                            <?php if(isset($row['complaintStatus'])): ?>
                                                <span class="badge <?= $row['complaintStatus'] == 'closed' ? 'bg-success' : 'bg-warning' ?>">
                                                    <?= ucfirst($row['complaintStatus']) ?>
                                                </span>
                                            <?php else: ?>
                                                <span class="badge bg-secondary">closed</span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <?php 
                                        endwhile;
                                    } else {
                                        echo "<tr><td colspan='6' class='text-center'>No complaints found for this month.</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Print functionality
    $('#printButton').click(function() {
        var printWindow = window.open('', '', 'height=600,width=800');
        printWindow.document.write('<html><head><title>Complaint Report</title></head><body>');
        printWindow.document.write($('#printContent').html());
        printWindow.document.write('</body></html>');
        printWindow.document.close();
        printWindow.print();
    });
</script>

</body>
</html>
