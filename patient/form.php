<?php
session_start();  // Start session to access patient ID
include("../connection.php");  // Database connection

// Check if the patient is logged in
if (!isset($_SESSION['pid'])) {
    header("Location: ../login.php");
    exit();
}

// if(isset($_SESSION["user"])){
//     if(($_SESSION["user"])=="" or $_SESSION['usertype']!='p'){
//         header("location: ../login.php");
//     }else{
//         $useremail=$_SESSION["user"];
//     }

// }else{
//     header("location: ../login.php");
// }

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $problem = $_POST['problem_description'] ?? '';  // Get the description from the form
    $user_id = $_SESSION['pid'];  // Logged in patient's ID

    if ($problem) {
        $query = "INSERT INTO history (user_id, problem) VALUES (?, ?)";

        if ($stmt = $database->prepare($query)) {
            $stmt->bind_param("is", $user_id, $problem);

            if ($stmt->execute()) {
                header("Location: schedule.php");
                exit();
            } else {
                echo "Error inserting data: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Error preparing statement: " . $database->error;
        }
    } else {
        echo "Please describe your problem.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Describe Your Problem</title>
</head>

<body>
    <div class="form-container">
        <form method="post">
            <label for="problem_description">Describe your problem:</label><br>
            <textarea id="problem_description" name="problem_description" rows="5" cols="40"
                required></textarea><br><br>
            <button type="submit">Submit</button>
        </form>
    </div>
</body>

</html>