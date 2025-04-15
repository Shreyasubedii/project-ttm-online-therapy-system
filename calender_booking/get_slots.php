<?php
// get_slots.php
$mysqli = new mysqli("localhost", "root", "", "your_database_name");

$date = $_GET['date'];
$all_slots = ["09:00", "10:00", "11:00", "13:00", "14:00", "15:00"];

$stmt = $mysqli->prepare("SELECT appointment_time FROM appointments WHERE appointment_date = ?");
$stmt->bind_param("s", $date);
$stmt->execute();
$result = $stmt->get_result();

$booked = [];
while ($row = $result->fetch_assoc()) {
    $booked[] = $row['appointment_time'];
}

$available = array_diff($all_slots, $booked);
echo json_encode(array_values($available));
?>