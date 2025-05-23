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
    <?php
session_start();

if(isset($_SESSION["user"])){
    if($_SESSION["user"] == "" || $_SESSION['usertype'] != 'p'){
        header("location: ../login.php");
    } else {
        $useremail = $_SESSION["user"];
    }
} else {
    header("location: ../login.php");
    exit();
}

include("../connection.php");
include("../recommendation/index.php");

$sqlmain = "SELECT * FROM patient WHERE pemail = ?";
$stmt = $database->prepare($sqlmain);
$stmt->bind_param("s", $useremail);
$stmt->execute();
$result = $stmt->get_result();
$userfetch = $result->fetch_assoc();
$userid = $userfetch["pid"];
$username = $userfetch["pname"];

date_default_timezone_set('Asia/kathmandu');
$today = date('Y-m-d');

$recommended_doctors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $problem = $_POST['description'];
    $recommended_doctors = getRecommendation($problem);
}

?>

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

        <div class="dash-body" style="margin-top:15px;">

            <?php if($recommended_doctors === []) { ?>
            <center>
                <table border="0" width="80%" class="sub-table scrolldown" style="padding:50px;border:none;">
                    <tr>
                        <td colspan="2">
                            <p class="heading-main12">Submit some description so we can help you find a best therapist
                                for yourself.
                            </p>
                            <!-- <p class="heading-sub12">Please fill the form below.</p> -->
                            <br>
                            <form method="post">
                                <label for="description" class="form-label">Give us your short Problem
                                    Description: </label><br>
                                <textarea name="description" rows="5" class="input-text" required></textarea><br><br>

                                <input type="submit" name="submit" value="Submit" class="login-btn btn-primary btn">
                            </form>
                        </td>
                    </tr>
                </table>
            </center>
            <?php } else { ?>
            <div>
                <h2>Here are the doctors recommended for you: </h2>
                <ul>
                    <?php foreach($recommended_doctors as $doctor) { ?>
<<<<<<< Updated upstream
                    <li>
                        <form action="addSchedule.php" method="post">
                            <h3><?php echo $doctor['docname']; ?></h3>
                            <input type="submit" value="Schedule Session" />
                        </form>
                    </li>
=======
                        <li>
                            <form action="addSchedule.php" method="post">
                                <h3><?php echo $doctor['docname']; ?></h3>
                                <input type="hidden" name="docid" value="<?php echo $doctor['docid']; ?>" />
                                <input type="submit" value="Schedule Session" />
                            </form>
                        </li>
>>>>>>> Stashed changes
                    <?php } ?>
                </ul>
            </div>
            <?php } ?>
        </div>
    </div>
</body>

</html>