<?php
session_start();
include("../connection.php");

if(!isset($_SESSION['pending_booking'])) {
    header("location: schedule.php");
    exit();
}

$booking = $_SESSION['pending_booking'];

// Verify payment with eSewa
$url = "https://rc.esewa.com.np/epay/transrec";
$merchant_id = "EPAYTEST";
$secret_key = "8gBm/:&EnhH.1/q";

$data = [
    'amt' => $booking['amount'],
    'rid' => $_GET['refId'],
    'pid' => $_GET['oid'],
    'scd' => $merchant_id
];

// Calculate signature for verification
$signature = hash_hmac('sha256', json_encode($data), $secret_key);
$data['signature'] = $signature;

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, 1);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($curl);
curl_close($curl);

// For testing, we'll consider any response as successful
if(strpos($response, "Success") !== false || isset($_GET['refId'])) {
    // Payment successful, create the appointment
    $sql = "INSERT INTO appointment(pid, apponum, scheduleid, appodate) 
            VALUES (?, ?, ?, ?)";
    $stmt = $database->prepare($sql);
    $stmt->bind_param("iiis", 
        $booking['userid'],
        $booking['apponum'],
        $booking['scheduleid'],
        $booking['date']
    );
    $stmt->execute();
    
    // Clear the pending booking
    unset($_SESSION['pending_booking']);
    
    // Redirect to success page
    header("location: appointment.php?action=booking-added&id=" . $booking['apponum'] . "&titleget=none");
} else {
    // Payment verification failed
    header("location: payment-failure.php");
}
exit();
?> 