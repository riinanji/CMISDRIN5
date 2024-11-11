<?php 
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('../include/config.php');

// Fetch only closed complaints for admin
$sql = "SELECT * FROM tblcomplaints WHERE status = 'closed'";
$result = mysqli_query($bd, $sql);

if ($result === false) {
    echo "Error: " . mysqli_error($bd);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Closed Complaints</title>

    <!-- Updated Bootstrap 5.3.x CSS --> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <link type="text/css" href="css/theme.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #e2e2e2, #ffffff);
            font-family: 'Open Sans', sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 900px;
            margin: auto;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }

        h2 {
            font-size: 2rem;
            font-weight: 700;
            color: #343a40;
            margin-bottom: 30px;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            padding: 15px;
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

        .back-button {
            background-color: #6c757d;
            color: white;
            margin-top: 20px;
            text-align: center;
            padding: 12px;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
            width: 100%;
            font-weight: bold;
        }

        .back-button:hover {
            background-color: #5a6268;
            text-decoration: none;
        }

        .search-input {
            width: 100%;
            padding: 15px;
            margin-bottom: 20px;
            font-size: 1.1rem;
            border-radius: 5px;
            border: 1px solid #ced4da;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .search-input:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(38, 143, 255, 0.25);
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

        footer {
            background-color: #2c3e50;
            color: white;
            padding: 10px 20px;
            text-align: center;
            margin-top: 30px;
            width: 100%;
        }
    </style>
</head>
<body>

    <?php include('includes/header.php'); ?>
    <?php include('includes/sidebar.php'); ?>

    <div class="container">
    <h2>Transaction History</h2>

        <!-- Search Bar -->
        <input type="text" class="form-control search-input" placeholder="Search Complaints..." onkeyup="filterComplaints()">

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Complainant</th>
                    <th>Respondent</th>
                    <th>Date Filed</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody id="complaints-table-body">
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr class="complaint-row">
                        <td><?php echo htmlentities($row['complainantName']); ?></td>
                        <td><?php echo htmlentities($row['respondentName']); ?></td>
                        <td>
                            <?php 
                            // Convert to AM/PM format
                            $date = strtotime($row['regDate']);
                            echo date('Y-m-d h:i A', $date); 
                            ?>
                        </td>
                        <td>
                            <button type="button" class="btn btn-success">Closed</button>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <a href="report.php" class="back-button">Generate Report</a>
    </div>

    <!-- Updated Bootstrap 5.3.x JS and latest JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function filterComplaints() {
            let filter = document.querySelector('.search-input').value.toLowerCase();
            let complaintRows = document.querySelectorAll('.complaint-row');

            complaintRows.forEach(row => {
                let complainant = row.querySelector('td:nth-child(1)').textContent.toLowerCase();
                let respondent = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                let dateFilled = row.querySelector('td:nth-child(3)').textContent.toLowerCase();

                if (complainant.includes(filter) || respondent.includes(filter) || dateFilled.includes(filter)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }
    </script>

    <footer>
        <p>&copy; 2024 Agusan Canyon. All rights reserved.</p>
    </footer>

<?php
mysqli_close($bd);
?> 
</body>
</html>
