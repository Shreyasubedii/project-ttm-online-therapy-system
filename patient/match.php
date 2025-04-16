<?php
session_start();

include("../recommendation/index.php");

if(isset($_SESSION["user"])){
    if(($_SESSION["user"])=="" or $_SESSION['usertype']!='p'){
        header("location: ../login.php");
    }else{
        $useremail=$_SESSION["user"];
    }

}else{
    header("location: ../login.php");
}

// $user_id = $_SESSION['id'];

$sqlmain = "SELECT * FROM patient WHERE pemail = ?";
$stmt = $conn->prepare($sqlmain);
$stmt->bind_param("s", $useremail);
$stmt->execute();
$result = $stmt->get_result();
$userfetch = $result->fetch_assoc();
$userid = $userfetch["pid"];
$username = $userfetch["pname"];

$matched_specialties = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $problem = $_POST['description'];
    // $problem = strtolower(trim($_POST['problem']));

    // Define keywords for specialties
    // $keywords = [
    //     1 => ['depression', 'anxiety', 'therapy', 'mental health', 'stress'],
    //     2 => ['child', 'teen', 'adolescent', 'kids'],
    //     3 => ['counseling', 'relationship', 'career advice'],
    //     6 => ['sports', 'athlete', 'performance'],
    //     8 => ['abnormal', 'disorder', 'hallucination', 'delusion'],
    // ];

    // $conn = new mysqli("localhost", "root", "", "talktome");
    // if ($conn->connect_error) {
    //     die("Connection failed: " . $conn->connect_error);
    // }

    $matched_specialties = getRecommendation($problem);


    // Match problem text to specialties
    // foreach ($keywords as $spec_id => $words) {
    //     foreach ($words as $word) {
    //         if (strpos($problem, $word) !== false) {
    //             $matched_specialties[] = $spec_id;
    //             break;
    //         }
    //     }
    // }

    // Store history regardless of match
    // $matched_str = implode(',', $matched_specialties);
    // $stmt = $conn->prepare("INSERT INTO history (user_id, problem, matched_specialties) VALUES (?, ?, ?)");
    // $stmt->bind_param("iss", $user_id, $problem, $matched_str);
    // $stmt->execute();
    // $stmt->close();

    // Display doctor results
//     if (!empty($matched_specialties)) {
//         $ids = implode(',', $matched_specialties);
//         $sql = "SELECT docname, specialties, sname FROM doctor 
//                 JOIN specialties ON doctor.specialties = specialties.id 
//                 WHERE doctor.specialties IN ($ids)";
//         $result = $conn->query($sql);

//         if ($result->num_rows > 0) {
//             echo "<h3>Recommended Doctors:</h3><ul>";
//             while ($row = $result->fetch_assoc()) {
//                 echo "<li>" . htmlspecialchars($row['docname']) . " - " . htmlspecialchars($row['sname']) . "</li>";
//             }
//             echo "</ul>";
//         } else {
//             echo "<p>No matching doctors found.</p>";
//         }
//     } else {
//         echo "<p>Couldn't match your problem to any specialties.</p>";
//     }

//     $conn->close();
} else {
    echo "<p>Invalid request.</p>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/animations.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/admin.css">
    <title>Form</title>
    <style>
    .popup {
        animation: transitionIn-Y-bottom 0.5s;
    }

    .sub-table {
        animation: transitionIn-Y-bottom 0.5s;
    }
    </style>
</head>
<body>
<div class="container">
        <div class="menu">
            <table class="menu-container" border="0">
                <tr>
                    <td style="padding:10px" colspan="2">
                        <table border="0" class="profile-container">
                            <tr>
                                <td width="30%" style="padding-left:20px">
                                    <img src="../img/user.png" alt="" width="100%" style="border-radius:50%">
                                </td>
                                <td style="padding:0px;margin:0px;">
                                    <p class="profile-title"><?php echo substr($username, 0, 13) ?>..</p>
                                    <p class="profile-subtitle"><?php echo substr($useremail, 0, 22) ?></p>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <a href="../logout.php">
                                        <input type="button" value="Log out" class="logout-btn btn-primary-soft btn">
                                    </a>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <tr class="menu-row">
                    <td class="menu-btn menu-icon-home">
                        <a href="index.php" class="non-style-link-menu">
                            <div>
                                <p class="menu-text">Home</p>
                            </div>
                        </a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-doctor">
                        <a href="doctors.php" class="non-style-link-menu">
                            <div>
                                <p class="menu-text">All Doctors</p>
                            </div>
                        </a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-session">
                        <a href="schedule.php" class="non-style-link-menu">
                            <div>
                                <p class="menu-text">Scheduled Sessions</p>
                            </div>
                        </a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-appoinment">
                        <a href="appointment.php" class="non-style-link-menu">
                            <div>
                                <p class="menu-text">My Bookings</p>
                            </div>
                        </a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-settings">
                        <a href="settings.php" class="non-style-link-menu">
                            <div>
                                <p class="menu-text">Settings</p>
                            </div>
                        </a>
                    </td>
                </tr>
            </table>
        </div>
        
</body>
</html>