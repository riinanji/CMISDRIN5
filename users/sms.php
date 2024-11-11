<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Replace with your actual API token
    $api_token = 'bc08b489706237d3660a4dd9e166c8d74a9575c3';

    // Get the form inputs
    $phone_number = $_POST['phone_number'];
    $message = $_POST['message'];

    // Verify that both fields are filled out
    if ($phone_number && $message) {
        // Prepare data for API request
        $data = [
            'api_token' => $api_token,
            'phone_number' => $phone_number,
            'message' => $message,
        ];

        // Convert data to JSON format
        $jsonData = json_encode($data);

        // Initialize cURL session
        $ch = curl_init('https://sms.iprogtech.com/api/v1/sms_messages'); // Replace with actual endpoint

        // Set cURL options
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json'
        ]);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);

        // Execute cURL request and get the response
        $response = curl_exec($ch);

        // Check for cURL errors
        if (curl_errno($ch)) {
            $feedback = 'Error: ' . curl_error($ch);
        } else {
            // Decode the response
            $response_data = json_decode($response, true);

            // Check if the response contains the expected "message"
            if (isset($response_data['message']) && $response_data['status'] == 200) {
                $feedback = "Your SMS message has been successfully added to the queue and will be processed shortly.";
            } else {
                $feedback = "Error: Unexpected response format. Raw response: " . htmlspecialchars($response);
            }
        }

        // Close cURL session
        curl_close($ch);
    } else {
        $feedback = "Error: Please enter both phone number and message.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMS Form</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Gray background for the entire page */
        body {
            background-color: gray; /* Light gray background */
            color: #333;
            font-family: Arial, sans-serif;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
        }
        .container {
            max-width: 800px;
        }
        .form-container {
            background-color: #fff;
            color: #333;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            padding: 2rem;
        }
        .form-container h2 {
            color: #333;
        }
        .btn-primary {
            background-color: gray;
            border: none;
            transition: background-color 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #2575fc;
        }
        /* Styling for input fields */
        .form-control {
            border-radius: 5px;
            border: 1px solid #ddd;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h2 class="text-center mb-4">SMS Form</h2>

            <form action="SMS.php" method="POST" class="p-4">
                <div class="mb-3">
                    <label for="phone_number" class="form-label">Phone Number</label>
                    <input type="text" name="phone_number" class="form-control" id="phone_number" placeholder="" required>
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label">Text Message</label>
                    <textarea name="message" class="form-control" id="message" rows="4" placeholder="Enter Your Message" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary w-100">Send SMS</button>
            </form>
        </div>
    </div>

    <?php if (isset($feedback)) : ?>
        <script>
            // Display feedback as a JavaScript alert
            alert("<?= $feedback; ?>");
        </script>
    <?php endif; ?>

    <!-- Bootstrap JS (optional, if you need JS components) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
