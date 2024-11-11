<?php
// Include the database connection configuration
include '../include/config.php';

// Fetch the month value from the URL or use the current month as default
$month = isset($_GET['month']) ? $_GET['month'] : date("Y-m");

// Query to fetch the tools history filtered by the month
$sql = "SELECT * FROM tools_history WHERE date_format(date_borrowed,'%Y-%m') = '{$month}' ORDER BY unix_timestamp(date_borrowed) DESC";
$result = mysqli_query($bd, $sql);

if ($result === false) {
    echo "Error: " . mysqli_error($bd);
    exit;
}

// Close the connection (optional, can be closed after the while loop)
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monthly Tools History Report</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
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

        .btn-primary {
            background-color: #d3a87e;
            border: none;
            font-size: 0.9rem;
        }

        .btn-primary:hover {
            background-color: #c7996a;
        }

        .btn-light {
            font-size: 0.9rem;
        }

        .btn-back {
            background-color: #6c757d;
            color: white;
            font-size: 0.9rem;
            margin-bottom: 20px;
        }

        .btn-back:hover {
            background-color: #5a6268;
        }

        .table {
            font-size: 0.9rem;
            border-radius: 5px;
            overflow: hidden;
            margin-top: 20px;
        }

        .table-bordered th, .table-bordered td {
            border: 1px solid #ddd;
        }

        .table thead {
            background-color: #f8f9fa;
            font-size: 1rem;
        }

        .table tbody tr:hover {
            background-color: #f1f1f1;
        }

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
                        <h5 class="card-title">Monthly Tools History Report</h5>
                    </div>
                    <div class="card-body">
                        <!-- Back Button -->
                        <a href="tools_equipment.php" class="btn btn-back"><i class="fas fa-arrow-left"></i> Back</a>

                        <!-- Filter Form -->
                        <form action="" method="get" id="filter">
                            <div class="row g-3">
                                <div class="col-lg-3 col-md-4">
                                    <label for="month" class="form-label">Month</label>
                                    <input type="month" name="month" id="month" value="<?= $month ?>" class="form-control" required>
                                </div>
                                <div class="col-lg-3 col-md-4 d-flex align-items-end">
                                    <button type="submit" class="btn btn-primary me-2"><i class="fa fa-filter"></i> Filter</button>
                                    <button type="button" class="btn btn-light border" id="printButton"><i class="fa fa-print"></i> Print</button>
                                </div>
                            </div>
                        </form>

                        <!-- Tools History Table -->
                        <div class="table-responsive" id="printContent">
                            <table class="table table-bordered table-striped">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Tool/Equipment Name</th>
                                        <th>Quantity</th>
                                        <th>Borrowed By</th>
                                        <th>Phone Number</th>
                                        <th>Date Borrowed</th>
                                        <th>Date to Return</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $i = 1;
                                    $total_borrowed_tools = 0;

                                    if (mysqli_num_rows($result) > 0) {
                                        while($row = mysqli_fetch_assoc($result)): 
                                            $total_borrowed_tools++; 
                                    ?>
                                    <tr>
                                        <td class="text-center"><?= $i++; ?></td>
                                        <td><?= $row['tool_name'] ?></td>
                                        <td><?= $row['quantity'] ?></td>
                                        <td><?= $row['borrowed_by'] ?></td>
                                        <td><?= $row['phone_number'] ?></td>
                                        <td><?= $row['date_borrowed'] ?></td>
                                        <td><?= $row['date_to_return'] ?></td>
                                        <td><?= $row['status'] ?></td>
                                    </tr>
                                    <?php 
                                        endwhile;
                                    } else {
                                        echo "<tr><td colspan='8' class='text-center'>No tools borrowed for this month.</td></tr>";
                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="7">Total Borrowed Tools</th>
                                        <th class="text-end"><?= $total_borrowed_tools ?></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Print Section -->
                <noscript id="print-header">
                    <div class="text-center">
                        <h3>Tools Borrowed Report for <?= date("F Y", strtotime($month)) ?></h3>
                    </div>
                </noscript>

                <!-- Integrated Print Script -->
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        document.getElementById('printButton').addEventListener('click', function() {
                            const printContent = document.getElementById('printContent').innerHTML;
                            const printHeader = document.getElementById('print-header').innerHTML;

                            const printWindow = window.open('', '_blank', 'width=800,height=600');
                            printWindow.document.write('<html><head><title>Print</title>');
                            printWindow.document.write('<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">');
                            printWindow.document.write('</head><body>');
                            printWindow.document.write(printHeader);
                            printWindow.document.write(printContent);
                            printWindow.document.write('</body></html>');

                            printWindow.document.close();

                            printWindow.onload = function() {
                                printWindow.print();
                                printWindow.close();
                            };
                        });
                    });
                </script>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
