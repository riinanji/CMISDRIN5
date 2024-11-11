<?php
ob_start(); // Start output buffering

// Include the database connection configuration
include '../include/config.php'; // Ensure the correct path to the config file

// Handle Borrow Tool Form Submission
if (isset($_POST['borrow_tool'])) {
    $id = $_POST['id'];
    $borrowed_by = $_POST['borrowed_by'];
    $phone_number = $_POST['phone_number']; // New phone number field
    $date_borrowed = $_POST['date_borrowed'];
    $date_to_return = $_POST['date_to_return'];
    $quantity = $_POST['quantity'];

    // Check available quantity before borrowing
    $sql_check_quantity = "SELECT quantity FROM tools_equipment WHERE id = $id";
    $result_check = mysqli_query($bd, $sql_check_quantity);
    $tool = mysqli_fetch_assoc($result_check);

    if ($tool['quantity'] >= $quantity) {
        // Update tool status to borrowed and insert into borrowed_tools table
        $sql_borrow_tool = "INSERT INTO borrowed_tools (tool_id, borrowed_by, phone_number, date_borrowed, date_to_return, quantity) 
                            VALUES ($id, '$borrowed_by', '$phone_number', '$date_borrowed', '$date_to_return', $quantity)";
        mysqli_query($bd, $sql_borrow_tool);

        // Update the original quantity in the tools_equipment table
        $sql_update_quantity = "UPDATE tools_equipment SET quantity = quantity - $quantity WHERE id = $id";
        mysqli_query($bd, $sql_update_quantity);
    } else {
        echo "<script>alert('Cannot borrow tool. Not enough quantity available.');</script>";
    }
}

// Handle Update Tool
if (isset($_POST['update_tool'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $quantity = $_POST['quantity'];
    $status = $_POST['status'];

    $sql_update = "UPDATE tools_equipment SET name='$name', quantity='$quantity', status='$status' WHERE id=$id";
    if (mysqli_query($bd, $sql_update)) {
        header("Location: tools_equipment.php?message=Tool updated successfully");
        exit();
    } else {
        header("Location: tools_equipment.php?error=Error updating tool");
        exit();
    }
}

// Handle Delete Tool
if (isset($_POST['delete_tool'])) {
    $id = $_POST['id'];
    $sql_delete = "DELETE FROM tools_equipment WHERE id=$id";
    if (mysqli_query($bd, $sql_delete)) {
        header("Location: tools_equipment.php?message=Tool deleted successfully");
        exit();
    } else {
        header("Location: tools_equipment.php?error=Error deleting tool");
        exit();
    }
}

// Fetch available tools
$sql_available = "SELECT * FROM tools_equipment WHERE quantity > 0";
$result_available = mysqli_query($bd, $sql_available);

// Fetch borrowed tools
$sql_borrowed = "SELECT bt.*, te.name FROM borrowed_tools bt JOIN tools_equipment te ON bt.tool_id = te.id";
$result_borrowed = mysqli_query($bd, $sql_borrowed);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tools & Equipment List</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link type="text/css" href="css/theme.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #e2e2e2, #ffffff);
            font-family: 'Open Sans', sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            
            max-width: 1200px;
            margin: auto;
            display: flex;
            flex-direction: column;
        }

        h2 {
            font-size: 2rem;
            font-weight: 700;
            color: #343a40;
            margin-bottom: 20px;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            padding: 15px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #6c757d;
            color: white;
            font-size: 1.2rem;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .redirect-button {
            padding: 12px 20px;
            background-color: #add8e6;
            color: #343a40;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            font-size: 1.1rem;
            font-weight: bold;
            margin: 5px;
            transition: background-color 0.3s;
        }

        .redirect-button:hover {
            background-color: #87ceeb;
            text-decoration: none;
        }

        .row {
            display: flex;
            justify-content: space-between;
        }

        .column {
            width: 48%;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .button-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .left-buttons {
            display: flex;
        }

        .right-buttons {
            margin-left: auto;
        }

        .alert {
            margin: 15px 0;
        }

header, footer {
            background-color: #696666; /* Dark background */
            color: white;
            padding: 8px 10px; /* Padding for header/footer */
            text-align: center; /* Center text */
        }

        footer {
            position: relative; /* For footer positioning */
            bottom: 0; /* Stick footer at the bottom */
            width: 100%; /* Full width footer */
        }


    </style>
    
    <script>
        // Function to hide alert messages after 3 seconds
        function hideAlerts() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                setTimeout(() => {
                    alert.style.display = 'none';
                }, 2000); // Change the time here (2000 ms = 2 seconds)
            });
        }

        window.onload = hideAlerts; // Call the function when the window loads
    </script>
    
</head>

<body>
<?php include('includes/header.php');?>
<?php include('includes/sidebar.php');?>
    <div class="container">
        <!-- Success/Error Messages -->
        <?php if (isset($_GET['message'])): ?>
            <div class="alert alert-success" role="alert">
                <?php echo htmlspecialchars($_GET['message']); ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo htmlspecialchars($_GET['error']); ?>
            </div>
        <?php endif; ?>

        <h2>Tools & Equipment List</h2>

        <div class="button-container mb-3">
            <div class="left-buttons">
                <a href="add_tool.php" class="redirect-button">Add Tool</a>
                <!-- <a href="borrow_tools.php" class="redirect-button">Borrow Tools</a>
                <a href="return_tool.php" class="redirect-button">Return Tool</a> -->
            </div>
            <div class="right-buttons">
                <a href="tools_history.php" class="redirect-button">Borrowed History</a>
            </div>
        </div>

        <div class="row">
            <div class="column">
                <h2>Available Tools & Equipment</h2>
                <table id="availableTools">
                    <thead>
                        <tr>
                            <th>Tool/Equipment Name</th>
                            <th>Quantity</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    if ($result_available->num_rows > 0) {
                        while($row = $result_available->fetch_assoc()) {
                            echo "<tr>
                                    <td>{$row['name']}</td>
                                    <td>{$row['quantity']}</td>
                                    <td>{$row['status']}</td>
                                    <td>
                                        <button type='button' class='btn btn-warning' data-toggle='modal' data-target='#editToolModal{$row['id']}'>Edit</button>
                                        <form method='post' style='display:inline;'>
                                            <input type='hidden' name='id' value='{$row['id']}'>
                                            <button type='submit' name='delete_tool' class='btn btn-danger'>Delete</button>
                                        </form>
                                    </td>
                                  </tr>";

                            // Modal for Editing Tool
                            echo "<div class='modal fade' id='editToolModal{$row['id']}' tabindex='-1' role='dialog' aria-labelledby='editToolModalLabel' aria-hidden='true'>
                                    <div class='modal-dialog' role='document'>
                                        <div class='modal-content'>
                                            <div class='modal-header'>
                                                <h5 class='modal-title' id='editToolModalLabel'>Edit Tool</h5>
                                                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                                    <span aria-hidden='true'>&times;</span>
                                                </button>
                                            </div>
                                            <form method='post'>
                                                <div class='modal-body'>
                                                    <input type='hidden' name='id' value='{$row['id']}'>
                                                    <div class='form-group'>
                                                        <label for='name'>Tool/Equipment Name</label>
                                                        <input type='text' class='form-control' name='name' value='{$row['name']}' required>
                                                    </div>
                                                    <div class='form-group'>
                                                        <label for='quantity'>Quantity</label>
                                                        <input type='number' class='form-control' name='quantity' value='{$row['quantity']}' required>
                                                    </div>
                                                    <div class='form-group'>
                                                        <label for='status'>Status</label>
                                                        <select class='form-control' name='status' required>
                                                            <option value='available' " . ($row['status'] === 'available' ? 'selected' : '') . ">Available</option>
                                                            <option value='borrowed' " . ($row['status'] === 'borrowed' ? 'selected' : '') . ">Borrowed</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class='modal-footer'>
                                                    <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
                                                    <button type='submit' name='update_tool' class='btn btn-primary'>Save changes</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                  </div>";
                        }
                    } else {
                        echo "<tr><td colspan='4'>No available tools found.</td></tr>";
                    }
                    ?>
                    </tbody>
                </table>
            </div>

            <div class="column">
                <h2>Borrowed Tools</h2>
                <table id="borrowedTools">
                    <thead>
                        <tr>
                            <th>Tool/Equipment Name</th>
                            <th>Borrowed By</th>
                            <th>Phone Number</th> <!-- New Phone Number column -->
                            <th>Date Borrowed</th>
                            <th>Date to Return</th>
                            <th>Quantity</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    if ($result_borrowed->num_rows > 0) {
                        while($row = $result_borrowed->fetch_assoc()) {
                            echo "<tr>
                                    <td>{$row['name']}</td>
                                    <td>{$row['borrowed_by']}</td>
                                    <td>{$row['phone_number']}</td> <!-- Display phone number -->
                                    <td>{$row['date_borrowed']}</td>
                                    <td>{$row['date_to_return']}</td>
                                    <td>{$row['quantity']}</td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>No borrowed tools found.</td></tr>";
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <!-- Bootstrap JavaScript -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
<footer>
    <p>&copy; 2024 Agusan Canyon. All rights reserved.</p>
</footer>
<?php
ob_end_flush(); // End output buffering and flush output
?>
