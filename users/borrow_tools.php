<?php
// Include the database connection
include '../include/config.php'; // Adjust the path to where your config.php is located

// Initialize notification variable
$notification = "";

// Handle Borrow Tool Form Submission
if (isset($_POST['borrow_tool'])) {
    $id = $_POST['tool_id']; // Get the tool ID from the selected tool
    $borrowed_by = $_POST['borrowed_by'];
    $phone_number = $_POST['phone_number']; // Retrieve contact number
    $date_borrowed = $_POST['date_borrowed'];
    $date_to_return = $_POST['date_to_return'];
    $quantity = $_POST['quantity']; // Get quantity from the form

    // Check current quantity
    $sql_check_quantity = "SELECT quantity FROM tools_equipment WHERE id = $id";
    $result_check = mysqli_query($bd, $sql_check_quantity);
    $tool = mysqli_fetch_assoc($result_check);

    if ($tool && $tool['quantity'] >= $quantity) {
        // Update quantity in tools_equipment
        $sql_update_quantity = "UPDATE tools_equipment SET quantity = quantity - $quantity WHERE id = $id";
        mysqli_query($bd, $sql_update_quantity);

        // Insert the borrow record into borrowed_tools
        $sql_insert_borrow = "INSERT INTO borrowed_tools (tool_id, borrowed_by, phone_number, date_borrowed, date_to_return, quantity) 
                              VALUES ($id, '$borrowed_by', '$phone_number', '$date_borrowed', '$date_to_return', $quantity)";
        
        if (mysqli_query($bd, $sql_insert_borrow)) {
            $notification = "Tool successfully borrowed."; // Success message
        } else {
            $notification = "Error: " . mysqli_error($bd); // Error message
        }
    } else {
        $notification = "Insufficient quantity available."; // Error message
    }
}

// Fetch tools for the dropdown
$sql_tools = "SELECT id, name FROM tools_equipment";
$result_tools = mysqli_query($bd, $sql_tools);

mysqli_close($bd);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borrow Tool</title>
    <!-- Latest Bootstrap 5.3.2 CDN links -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-p0y0sfRnn/sa6mghZZ6OflRmJZOA5h/9QwxbDS56v1h9yipSENL0xDE7DYe9dyyp" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qfFq2j/ca0EZNLxzrfuS5rFaITTFx9HKk6r9bY3B1WBtM9lKtozkIaDnCWzMlR9C" crossorigin="anonymous"></script>

    <link type="text/css" href="css/theme.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #e2e2e2, #ffffff);
            font-family: 'Open Sans', sans-serif;
            margin: 0;
            padding: 20px;
            font-weight: normal;
            font-size: 0.85rem;
        }

        .container {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }

        h2 {
            font-size: 1.25rem;
            font-weight: 700;
            color: #343a40;
            margin-bottom: 20px;
            text-align: center;
        }

        label {
            font-weight: bold;
            margin-top: 10px;
            font-size: 0.85rem;
        }

        input[type="number"],
        input[type="text"],
        input[type="date"],
        select {
            width: 100%;
            padding: 6px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 0.85rem;
        }

        button {
            padding: 8px 12px;
            background-color: #add8e6;
            color: #343a40;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 0.85rem;
            font-weight: bold;
            margin-top: 10px;
            transition: background-color 0.3s;
            display: block;
            width: 100%;
        }

        button:hover {
            background-color: #87ceeb;
        }

        .notification {
            width: 100%;
            padding: 6px;
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            border-radius: 5px;
            text-align: center;
            margin-bottom: 20px;
            font-size: 0.85rem;
        }

        .back-button {
            background-color: gray;
            margin-top: 10px;
            text-align: center;
            display: block;
            padding: 8px 12px;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            font-size: 0.85rem;
        }

        .back-button:hover {
            background-color: #a9a9a9;
        }
    </style>
</head>
<body>

    <div class="container">
        <?php if ($notification): ?>
            <div class="notification"><?php echo $notification; ?></div>
        <?php endif; ?>

        <h2>Borrow Tool</h2>
        <form method="POST">
            <label for="tool_id">Select Tool:</label>
            <select id="tool_id" name="tool_id" required>
                <option value="">-- Select a Tool --</option>
                <?php
                if ($result_tools->num_rows > 0) {
                    while ($row = $result_tools->fetch_assoc()) {
                        echo "<option value='{$row['id']}'>{$row['name']}</option>";
                    }
                } else {
                    echo "<option value=''>No tools available</option>";
                }
                ?>
            </select>

            <label for="borrowed_by">Borrowed By:</label>
            <input type="text" id="borrowed_by" name="borrowed_by" required>

            <label for="phone_number">Contact Number:</label>
            <input type="text" id="phone_number" name="phone_number" required>

            <label for="date_borrowed">Date Borrowed:</label>
            <input type="date" id="date_borrowed" name="date_borrowed" required>

            <label for="date_to_return">Date to Return:</label>
            <input type="date" id="date_to_return" name="date_to_return" required>

            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity" required min="1">

            <button type="submit" name="borrow_tool">Borrow Tool</button>
        </form>
        
        <!-- Back Button -->
        <a href="tool_equipment.php" class="back-button">Back</a>
    </div>

</body>
</html>
