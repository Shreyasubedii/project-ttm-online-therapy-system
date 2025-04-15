<?php
session_start();

if(isset($_SESSION["user"])){
    if(($_SESSION["user"])=="" or $_SESSION['usertype']!='p'){
        header("location: ../login.php");
    }else{
        $useremail=$_SESSION["user"];
    }

}else{
    header("location: ../login.php");
}exit;
 

$user_id = $_SESSION['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $problem = strtolower(trim($_POST['problem']));

    // Define keywords for specialties
    $keywords = [
        1 => ['depression', 'anxiety', 'therapy', 'mental health', 'stress'],
        2 => ['child', 'teen', 'adolescent', 'kids'],
        3 => ['counseling', 'relationship', 'career advice'],
        6 => ['sports', 'athlete', 'performance'],
        8 => ['abnormal', 'disorder', 'hallucination', 'delusion'],
    ];

    $conn = new mysqli("localhost", "root", "", "talktome");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $matched_specialties = [];

    // Match problem text to specialties
    foreach ($keywords as $spec_id => $words) {
        foreach ($words as $word) {
            if (strpos($problem, $word) !== false) {
                $matched_specialties[] = $spec_id;
                break;
            }
        }
    }

    // Store history regardless of match
    $matched_str = implode(',', $matched_specialties);
    $stmt = $conn->prepare("INSERT INTO history (user_id, problem, matched_specialties) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $user_id, $problem, $matched_str);
    $stmt->execute();
    $stmt->close();

    // Display doctor results
    if (!empty($matched_specialties)) {
        $ids = implode(',', $matched_specialties);
        $sql = "SELECT docname, specialties, sname FROM doctor 
                JOIN specialties ON doctor.specialties = specialties.id 
                WHERE doctor.specialties IN ($ids)";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<h3>Recommended Doctors:</h3><ul>";
            while ($row = $result->fetch_assoc()) {
                echo "<li>" . htmlspecialchars($row['docname']) . " - " . htmlspecialchars($row['sname']) . "</li>";
            }
            echo "</ul>";
        } else {
            echo "<p>No matching doctors found.</p>";
        }
    } else {
        echo "<p>Couldn't match your problem to any specialties.</p>";
    }

    $conn->close();
} else {
    echo "<p>Invalid request.</p>";
}
?>