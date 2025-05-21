<?php
session_start();

if(!isset($_SESSION['pending_booking'])) {
    header("location: schedule.php");
    exit();
}

$booking = $_SESSION['pending_booking'];
$amount = 2000; // Get the actual amount from booking data
$merchant_id = "EPAYTEST";
$secret_key = "8gBm/:&EnhH.1/q";
$url = "https://rc.esewa.com.np/epay/main"; // Using RC environment for testing
$success_url = "http://localhost/project-ttm-online-therapy-system/patient/payment-success.php";
$failure_url = "http://localhost/project-ttm-online-therapy-system/patient/payment-failure.php";

// Generate a unique product ID
$pid = "TTM_" . $booking['scheduleid'] . "_" . time();

// Calculate signature
$data = [
    'amt' => $amount,
    'pid' => $pid,
    'scd' => $merchant_id,
    'su' => $success_url,
    'fu' => $failure_url
];

$signature = hash_hmac('sha256', json_encode($data), $secret_key);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment - eSewa</title>
    <link rel="stylesheet" href="../css/main.css">
    <style>
        .payment-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .payment-details {
            margin: 20px 0;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 5px;
        }
        .payment-button {
            background: #5cb85c;
            color: white;
            padding: 15px 30px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
        }
        .payment-button:hover {
            background: #4cae4c;
        }
    </style>
</head>
<body>
    <div class="payment-container">
        <h2>Complete Your Payment</h2>
        
        <div class="payment-details">
            <h3>Session Details:</h3>
            <p><strong>Title:</strong> <?php echo htmlspecialchars($booking['title']); ?></p>
            <p><strong>Doctor:</strong> <?php echo htmlspecialchars($booking['docname']); ?></p>
            <p><strong>Date:</strong> <?php echo htmlspecialchars($booking['scheduledate']); ?></p>
            <p><strong>Time:</strong> <?php echo htmlspecialchars($booking['scheduletime']); ?></p>
            <p><strong>Amount:</strong> NPR <?php echo number_format($amount, 2); ?></p>
        </div>

        <form action="<?php echo $url; ?>" method="POST">
            <input value="<?php echo $amount; ?>" name="tAmt" type="hidden">
            <input value="<?php echo $amount; ?>" name="amt" type="hidden">
            <input value="0" name="txAmt" type="hidden">
            <input value="0" name="psc" type="hidden">
            <input value="0" name="pdc" type="hidden">
            <input value="<?php echo $merchant_id; ?>" name="scd" type="hidden">
            <input value="<?php echo $pid; ?>" name="pid" type="hidden">
            <input value="<?php echo $success_url; ?>" type="hidden" name="su">
            <input value="<?php echo $failure_url; ?>" type="hidden" name="fu">
            <input value="<?php echo $signature; ?>" type="hidden" name="signature">
            <button type="submit" class="payment-button">Pay with eSewa</button>
        </form>
    </div>
</body>
</html> 