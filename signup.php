<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/animations.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/signup.css">
    <title>Sign Up</title>
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
    </style>
</head>

<body>
    <a href="javascript:history.back()" class="back-button">&#8592; Back</a>

    <?php
session_start();
$_SESSION["user"] = "";
$_SESSION["usertype"] = "";
date_default_timezone_set('Asia/Kathmandu');
$date = date('Y-m-d');
$_SESSION["date"] = $date;

$old = ['fname' => '', 'lname' => '', 'address' => '', 'dob' => ''];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = false;

    $fname = trim($_POST['fname']);
    $lname = trim($_POST['lname']);
    $address = trim($_POST['address']);
    $dob = $_POST['dob'];

    $old = compact('fname', 'lname', 'address', 'dob');

    if (!preg_match("/^[A-Za-z]{3,}$/", $fname)) $errors = true;
    if (!preg_match("/^[A-Za-z]{3,}$/", $lname)) $errors = true;
    if (empty($address) || empty($dob)) $errors = true;

    if (!$errors) {
        $_SESSION["personal"] = $old;
        header("Location: create-account.php");
        exit();
    }
}
?>


    <center>
        <div class="container">
            <table border="0">
                <tr>
                    <td colspan="2">
                        <p class="header-text">Let's Get Started</p>
                        <p class="sub-text">Add Your Personal Details to Continue</p>
                    </td>
                </tr>
                <tr>
                    <form action="" method="POST" id="signupForm">
                        <td class="label-td" colspan="2">
                            <label for="name" class="form-label">Name: </label>
                        </td>
                </tr>
                <tr>
                    <td class="label-td">
                        <input type="text" name="fname" id="fname" class="input-text" placeholder="First Name" required>
                        <span id="fnameError" style="color: red; display: none;"></span>
                    </td>
                    <td class="label-td">
                        <input type="text" name="lname" id="lname" class="input-text" placeholder="Last Name" required>
                        <span id="lnameError" style="color: red; display: none;"></span>
                    </td>
                </tr>
                <tr>
                    <td class="label-td" colspan="2">
                        <label for="address" class="form-label">Address: </label>
                    </td>
                </tr>
                <tr>
                    <td class="label-td" colspan="2">
                        <input type="text" name="address" class="input-text" placeholder="Address" required>
                    </td>
                </tr>
                <tr>
                    <td class="label-td" colspan="2">
                        <label for="dob" class="form-label">Date of Birth: <br> (You have to be atleast 16 years old to
                            register.)</label>
                    </td>
                </tr>
                <tr>
                    <td class="label-td" colspan="2">
                        <input type="date" name="dob" class="input-text" required>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="reset" value="Reset" class="login-btn btn-primary-soft btn">
                    </td>
                    <td>
                        <input type="submit" value="Next" class="login-btn btn-primary btn">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <br>
                        <label for="" class="sub-text" style="font-weight: 280;">Already have an account? </label>
                        <a href="login.php" class="hover-link1 non-style-link">Login</a>
                        <br><br><br>
                    </td>
                </tr>
                </form>
            </table>
        </div>
    </center>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('signupForm');
        const fnameInput = document.getElementById('fname');
        const lnameInput = document.getElementById('lname');
        const fnameError = document.getElementById('fnameError');
        const lnameError = document.getElementById('lnameError');

        form.addEventListener('submit', function(event) {
            let isValid = true;
            const namePattern = /^[A-Za-z]+$/;
            if (!namePattern.test(fnameInput.value) || fnameInput.value.length < 3) {
                fnameError.textContent =
                    "Please enter a valid first name (only alphabets, at least 3 characters).";
                fnameError.style.display = 'block';
                isValid = false;
            } else {
                fnameError.style.display = 'none';
            }
            if (!namePattern.test(lnameInput.value) || lnameInput.value.length < 3) {
                lnameError.textContent =
                    "Please enter a valid last name (only alphabets, at least 3 characters).";
                lnameError.style.display = 'block';
                isValid = false;
            } else {
                lnameError.style.display = 'none';
            }
            if (!isValid) {
                event.preventDefault();
            }
        });
    });
    </script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const dobInput = document.querySelector('input[name="dob"]');
        const today = new Date();

        // Calculate max DOB (16 years ago)
        const maxDate = new Date();
        maxDate.setFullYear(today.getFullYear() - 16);

        // Optional: Minimum age limit (e.g., someone can’t be 120 years old!)
        const minDate = new Date();
        minDate.setFullYear(today.getFullYear() - 100);

        // Format YYYY-MM-DD
        const toDateInputFormat = (date) => {
            const yyyy = date.getFullYear();
            const mm = ('0' + (date.getMonth() + 1)).slice(-2);
            const dd = ('0' + date.getDate()).slice(-2);
            return `${yyyy}-${mm}-${dd}`;
        }

        dobInput.max = toDateInputFormat(maxDate);
        dobInput.min = toDateInputFormat(minDate);
    });
    </script>


</body>

</html>