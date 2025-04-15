<?php
// book.php
$mysqli = new mysqli("localhost", "root", "", "your_database_name");

$name = $_POST['name'];
$date = $_POST['date'];
$time = $_POST['time'];

// Check if already booked
$stmt = $mysqli->prepare("SELECT * FROM appointments WHERE appointment_date = ? AND appointment_time = ?");
$stmt->bind_param("ss", $date, $time);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    echo "already_booked";
} else {
    $stmt = $mysqli->prepare("INSERT INTO appointments (patient_name, appointment_date, appointment_time) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $date, $time);
    $stmt->execute();
    echo "success";
}
?>