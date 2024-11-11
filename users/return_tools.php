<?php
// Include the database connection
include '../include/config.php'; // Adjust the path to your config.php file

// Handle Return Tool Form Submission
if (isset($_POST['return_tool'])) {
    $borrowed_id = $_POST['borrowed_id'];

    // Fetch the borrowed tool's details, including the phone number and tool name
    $sql_fetch = "SELECT bt.*, te.name AS tool_name, bt.phone_number 
                  FROM borrowed_tools bt 
                  JOIN tools_equipment te ON bt.tool_id = te.id 
                  WHERE bt.id = $borrowed_id";
    $result_fetch = mysqli_query($bd, $sql_fetch);
    
    if (mysqli_num_rows($result_fetch) > 0) {
        $tool = mysqli_fetch_assoc($result_fetch);

        // Check if tool name is available
        if (isset($tool['tool_name'])) {
            // Update the quantity in tools_equipment
            $sql_update_quantity = "UPDATE tools_equipment SET quantity = quantity + {$tool['quantity']} WHERE id = {$tool['tool_id']}";
            mysqli_query($bd, $sql_update_quantity);

            // Add an entry to tools_history with the phone_number
            $sql_history = "INSERT INTO tools_history (tool_id, tool_name, quantity, borrowed_by, phone_number, date_borrowed, date_to_return, date_returned, status) 
                            VALUES ({$tool['tool_id']}, '{$tool['tool_name']}', {$tool['quantity']}, '{$tool['borrowed_by']}', '{$tool['phone_number']}', '{$tool['date_borrowed']}', '{$tool['date_to_return']}', NOW(), 'Returned')";
            mysqli_query($bd, $sql_history);

            // Delete the record from borrowed_tools
            $sql_delete = "DELETE FROM borrowed_tools WHERE id = $borrowed_id";
            mysqli_query($bd, $sql_delete);

            echo "<script>alert('Tool returned successfully!');</script>";
        } else {
            echo "<script>alert('Tool name not found!');</script>";
        }
    } else {
        echo "<script>alert('Tool not found!');</script>";
    }
}

// Fetch borrowed tools for the dropdown
$sql_borrowed = "SELECT bt.*, te.name FROM borrowed_tools bt JOIN tools_equipment te ON bt.tool_id = te.id";
$result_borrowed = mysqli_query($bd, $sql_borrowed);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Return Tool</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link type="text/css" href="css/theme.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #e2e2e2, #ffffff);
            font-family: 'Open Sans', sans-serif;
            margin: 0;
            padding: 40px;
        }
        .container {
            max-width: 1000px;
            margin: auto;
            padding: 40px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            text-align: center;
        }
        h2 {
            font-size: 2.5rem;
            font-weight: 700;
            color: #343a40;
            margin-bottom: 30px;
        }
        .form-group label {
            font-weight: bold;
            color: #333;
            font-size: 1.2rem;
        }
        select.form-control {
            border-radius: 5px;
            border: 1px solid #007bff;
            font-size: 1.1rem;
        }
        .button-container {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 20px;
            margin-top: 30px;
        }
        .return-button,
        .back-button {
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1.1rem;
            display: inline-block;
            width: 160px;
            text-align: center;
            text-decoration: none;
            transition: background-color 0.3s;
        }
        .return-button:hover {
            background-color: #218838;
        }
        .back-button {
            background-color: #6c757d;
        }
        .back-button:hover {
            background-color: #5a6268;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
            margin-top: 30px;
        }
        th, td {
            padding: 15px;
            text-align: left;
            border: 1px solid #ddd;
            font-size: 1.1rem;
        }
        th {
            background-color: #007bff;
            color: white;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Return Tools</h2>
        <form method="post" action="">
            <div class="form-group">
                <label for="borrowed_id">Select Borrowed Tool:</label>
                <select name="borrowed_id" id="borrowed_id" class="form-control" required>
                    <option value="">-- Select a Tool --</option>
                    <?php
                    if (mysqli_num_rows($result_borrowed) > 0) {
                        while ($row = mysqli_fetch_assoc($result_borrowed)) {
                            echo "<option value='{$row['id']}'>{$row['name']} (Borrowed by: {$row['borrowed_by']})</option>";
                        }
                    } 
                    ?>
                </select>
            </div>
            <div class="button-container">
                <button type="submit" name="return_tool" class="return-button">Return Tool</button>
                <a href="tool_equipment.php" class="back-button">Back to Tools</a> <!-- Back button -->
            </div>
        </form>
    </div>

</body>
</html>

<?php
// Close the database connection
mysqli_close($bd);
?>
