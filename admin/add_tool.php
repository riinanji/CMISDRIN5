<?php
// Include configuration file
include '../include/config.php'; // Ensure the path is correct

// Initialize notification variable
$notification = "";

// Handle Add Tool Form Submission
if (isset($_POST['add_tool'])) {
    $name = $_POST['name'];
    $quantity = $_POST['quantity']; // Get quantity from the form
    $sql_add_tool = "INSERT INTO tools_equipment (name, quantity, status) VALUES ('$name', $quantity, 'available')";

    if (mysqli_query($bd, $sql_add_tool)) {
        $notification = "Successfully added the tool/equipment."; // Success message
    } else {
        $notification = "Error: " . mysqli_error($bd); // Error message
    }
}

mysqli_close($bd);
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Tool/Equipment</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link type="text/css" href="css/theme.css" rel="stylesheet">
    <style>
        /* Your existing styles */
        body {
            background: linear-gradient(to right, #e2e2e2, #ffffff);
            font-family: 'Open Sans', sans-serif;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
        }

        .notification {
            width: 100%;
            padding: 10px;
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            border-radius: 5px;
            text-align: center;
            margin-bottom: 20px;
        }

        .container {
            max-width: 600px;
            padding: 20px;
            margin: auto;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        h2 {
            font-size: 2rem;
            font-weight: 700;
            color: #343a40;
            margin-bottom: 20px;
            text-align: center;
        }

        label {
            font-size: 1.1rem;
            color: #343a40;
        }

        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 15px;
        }

        button {
            padding: 12px 20px;
            background-color: #add8e6;
            color: #343a40;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1.1rem;
            transition: background-color 0.3s;
            width: 100%;
        }

        button:hover {
            background-color: #87ceeb;
            text-decoration: none;
        }

        .back-button {
            display: block;
            margin-top: 15px;
            padding: 12px 20px;
            background-color: gray;
            color: white;
            border: none;
            border-radius: 5px;
            text-align: center;
            font-size: 1.1rem;
            transition: background-color 0.3s;
        }

        .back-button:hover {
            background-color: darkgray;
        }
    </style>
</head>
<body>

    <?php if ($notification): ?>
        <div class="notification"><?php echo $notification; ?></div>
    <?php endif; ?>

    <div class="container">
        <form method="POST">
            <h2>Add Tool/Equipment</h2>
            <label for="name">Tool/Equipment Name:</label>
            <input type="text" id="name" name="name" required>
            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity" required min="1">
            <button type="submit" name="add_tool">Add Tool/Equipment</button>
        </form>
        <a href="tools_equipment.php" class="back-button">Back</a>
    </div>

</body>
</html>
