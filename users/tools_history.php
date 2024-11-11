<?php
// Include the database configuration
include '../include/config.php'; // Ensure the path is correct

// Now you can use $bd for your queries
// Example: Fetching data
$sql = "SELECT * FROM tools_history";
$result = mysqli_query($bd, $sql);

if ($result === false) {
    echo "Error: " . mysqli_error($bd);
    exit;
}

// Check if there are any rows returned
if (mysqli_num_rows($result) === 0) {
    echo "No records found.";
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borrowed Tools/Equipment History</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link type="text/css" href="css/theme.css" rel="stylesheet">
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
            padding: 15px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        }

        h2 {
            font-size: 1.5rem;
            font-weight: 700;
            color: #343a40;
            margin-bottom: 20px;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            font-size: 0.9rem;
        }

        th, td {
            padding: 8px;
            text-align: left;
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
            background-color: gray;
            margin-top: 10px;
            text-align: center;
            display: block;
            padding: 10px 15px;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            font-size: 0.9rem;
        }

        .back-button:hover {
            background-color: #a9a9a9;
            text-decoration: none;
        }

        .search-input {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            font-size: 0.9rem;
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
                font-size: 0.8rem;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Borrowed Tools/Equipment History</h2>

        <!-- Search Bar -->
        <input type="text" class="form-control search-input" placeholder="Search Borrowed Tools..." onkeyup="filterTools()">

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Tool/Equipment Name</th>
                    <th>Quantity</th>
                    <th>Borrowed By</th>
                    <th>Phone Number</th>
                    <th>Date Borrowed</th>
                    <th>Date to Return</th>
                    <th>Date Returned</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody id="tools-table-body">
                <?php while($row = $result->fetch_assoc()): ?>
                    <tr class="tool-row">
                        <td class="tool-name"><?php echo $row['tool_name']; ?></td>
                        <td><?php echo $row['quantity']; ?></td>
                        <td class="borrowed-by"><?php echo $row['borrowed_by']; ?></td>
                        <td><?php echo $row['phone_number']; ?></td>
                        <td><?php echo $row['date_borrowed']; ?></td>
                        <td><?php echo $row['date_to_return']; ?></td>
                        <td><?php echo $row['date_returned']; ?></td>
                        <td><?php echo $row['status']; ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <a href="tool_equipment.php" class="back-button">Back to Tools & Equipments</a> 
    </div>

    <script>
        // JavaScript function to filter tools based on search input
        function filterTools() {
            let filter = document.querySelector('.search-input').value.toLowerCase();
            let toolRows = document.querySelectorAll('.tool-row');

            toolRows.forEach(row => {
                let toolName = row.querySelector('.tool-name').textContent.toLowerCase();
                let borrowedBy = row.querySelector('.borrowed-by').textContent.toLowerCase();

                if (toolName.includes(filter) || borrowedBy.includes(filter)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }
    </script>

</body>
</html>

<?php
// Close the connection after all records have been fetched
$bd->close();
?>
