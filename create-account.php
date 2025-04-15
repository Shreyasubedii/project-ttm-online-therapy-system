<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/animations.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/signup.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <title>Create Account</title>

    <style>
    .back-button {
        position: absolute;
        top: 10px;
        left: 10px;
        background-color: #007bff;
        color: white;
        border: none;
        padding: 8px 12px;
        font-size: 16px;
        cursor: pointer;
        border-radius: 5px;
        text-decoration: none;
    }

    .back-button:hover {
        background-color: #0056b3;
    }

    td.label-td {
        position: relative;
    }

    .toggle-password {
        position: absolute;
        right: 15px;
        top: 55%;
        transform: translateY(-50%);
        cursor: pointer;
        font-size: 13px;
        color: #666;
    }
    </style>
</head>
<style>
.container {
    animation: transitionIn-X 0.5s;
}
</style>

</head>

<body>
    <a href="javascript:history.back()" class="back-button">&#8592; Back</a>

    <?php

session_start();

$_SESSION["user"] = "";
$_SESSION["usertype"] = "";

date_default_timezone_set('Asia/kathmandu');
$date = date('Y-m-d');

$_SESSION["date"] = $date;

include("connection.php");

$error = '';

if ($_POST) {

    $result = $database->query("select * from webuser");

    $fname = $_SESSION['personal']['fname'];
    $lname = $_SESSION['personal']['lname'];
    $name = $fname . " " . $lname;
    $address = $_SESSION['personal']['address'];
    $dob = $_SESSION['personal']['dob'];
    $email = $_POST['newemail'];
    $tele = $_POST['tele'];
    $newpassword = $_POST['newpassword'];
    $cpassword = $_POST['cpassword'];

    // Email validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Invalid Email Address!</label>';
    } elseif (!preg_match('/^(98|97|96)\d{8}$/', $tele)) {  // Phone number validation
        $error = '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Invalid Phone Number! Enter a 10-digit number.</label>';
    } elseif (strlen($newpassword) < 8 || !preg_match('/[A-Z]/', $newpassword) || !preg_match('/[a-z]/', $newpassword) || !preg_match('/\d/', $newpassword) || !preg_match('/[@$!%*?&#]/', $newpassword)) {
        $error = '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Password must be at least 8 characters long and include uppercase, lowercase, a number, and a special character.</label>';
    } elseif ($newpassword != $cpassword) {
        $error = '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Password Confirmation Error! Reconfirm Password.</label>';
    } else {
        $sqlmain = "select * from webuser where email=?;";
        $stmt = $database->prepare($sqlmain);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows == 1) {
            $error = '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">An account with this Email already exists.</label>';
        } else {
            $database->query("insert into patient(pemail,pname,ppassword, paddress,pdob,ptel) values('$email','$name','$newpassword','$address','$dob','$tele');");
            $database->query("insert into webuser values('$email','p')");

            $_SESSION["user"] = $email;
            $_SESSION["usertype"] = "p";
            $_SESSION["username"] = $fname;

            header('Location: patient/index.php');
            exit();
        }
    }
} else {
    $error = '<label for="promter" class="form-label"></label>';
}

?>

    <center>
        <div class="container">
            <table border="0" style="width: 69%;">
                <tr>
                    <td colspan="2">
                        <p class="header-text">Let's Get Started</p>
                        <p class="sub-text">Create User Account.</p>
                    </td>
                </tr>
                <tr>
                    <form action="" method="POST">
                        <td class="label-td" colspan="2">
                            <label for="newemail" class="form-label">Email: </label>
                        </td>
                </tr>
                <tr>
                    <td class="label-td" colspan="2">
                        <input type="email" name="newemail" class="input-text" placeholder="Email Address" required>
                    </td>
                </tr>
                <tr>
                    <td class="label-td" colspan="2">
                        <label for="tele" class="form-label">Mobile Number: </label>
                    </td>
                </tr>
                <tr>
                    <td class="label-td" colspan="2">
                        <input type="tel" name="tele" class="input-text" placeholder="ex: 9876155141" required>
                    </td>
                </tr>
                <tr>
                    <td class="label-td" colspan="2">
                        <label for="newpassword" class="form-label">Create New Password: </label>
                    </td>
                </tr>
                <tr>
                    <td class="label-td" colspan="2">
                        <input type="password" id="newpassword" name="newpassword" class="input-text"
                            placeholder="New Password" required>
                        <span class="toggle-password" onclick="togglePassword('newpassword', 'eye-icon1')">
                            <i id="eye-icon1" class="fa fa-eye"></i>
                        </span>

                    </td>
                </tr>
                <tr>
                    <td class="label-td" colspan="2">
                        <label for="cpassword" class="form-label">Confirm Password: </label>
                    </td>
                </tr>
                <tr>
                    <td class="label-td" colspan="2">
                        <input type="password" name="cpassword" class="input-text" placeholder="Confirm Password"
                            required>
                        <span class="toggle-password" onclick="togglePassword('cpassword', 'eye-icon2')">
                            <i id="eye-icon2" class="fa fa-eye"></i>
                        </span>
                    </td>
                </tr>
                <style>
                .toggle-password {
                    position: absolute;
                    right: 10px;
                    top: 50%;
                    transform: translateY(-50%);
                    cursor: pointer;
                }
                </style>

                <script>
                function togglePassword(fieldId, iconId) {
                    const passwordField = document.getElementById(fieldId);
                    const icon = document.getElementById(iconId);
                    if (passwordField.type === "password") {
                        passwordField.type = "text";
                        icon.classList.remove("fa-eye");
                        icon.classList.add("fa-eye-slash");
                    } else {
                        passwordField.type = "password";
                        icon.classList.remove("fa-eye-slash");
                        icon.classList.add("fa-eye");
                    }
                }
                </script>
                <tr>
                    <td colspan="2">
                        <?php echo $error ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="reset" value="Reset" class="login-btn btn-primary-soft btn">
                    </td>
                    <td>
                        <input type="submit" value="Sign Up" class="login-btn btn-primary btn">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <br>
                        <label for="" class="sub-text" style="font-weight: 280;">Already have an account&#63; </label>
                        <a href="login.php" class="hover-link1 non-style-link">Login</a>
                        <br><br><br>
                    </td>
                </tr>
                </form>
                </tr>
            </table>
        </div>
    </center>
    <script>
    function togglePassword(fieldId, iconId) {
        const passwordField = document.getElementById(fieldId);
        const icon = document.getElementById(iconId);
        if (passwordField.type === "password") {
            passwordField.type = "text";
        } else {
            passwordField.type = "password";
        }
    }
    </script>
</body>

</html>