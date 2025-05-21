<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Failed</title>
    <link rel="stylesheet" href="../css/main.css">
    <style>
        .error-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            text-align: center;
        }
        .error-icon {
            font-size: 48px;
            color: #dc3545;
            margin-bottom: 20px;
        }
        .error-message {
            color: #dc3545;
            margin-bottom: 20px;
        }
        .back-button {
            background: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            display: inline-block;
        }
        .back-button:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
    <div class="error-container">
        <div class="error-icon">❌</div>
        <h2>Payment Failed</h2>
        <p class="error-message">Sorry, your payment could not be processed. Please try again.</p>
        <a href="schedule.php" class="back-button">Back to Schedule</a>
    </div>
</body>
</html>
<?php
// Clear the pending booking
unset($_SESSION['pending_booking']);
?> 