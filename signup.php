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
</head>

<body>
    <?php
    session_start();
    $_SESSION["user"] = "";
    $_SESSION["usertype"] = "";
    date_default_timezone_set('Asia/Kathmandu');
    $date = date('Y-m-d');
    $_SESSION["date"] = $date;

    if ($_POST) {
        $_SESSION["personal"] = array(
            'fname' => $_POST['fname'],
            'lname' => $_POST['lname'],
            'address' => $_POST['address'],
            'dob' => $_POST['dob']
        );
        print_r($_SESSION["personal"]);
        header("location: create-account.php");
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
                        <label for="dob" class="form-label">Date of Birth: </label>
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

            // First Name Validation: Only alphabets, min 3 characters
            const namePattern = /^[A-Za-z]+$/;
            if (!namePattern.test(fnameInput.value) || fnameInput.value.length < 3) {
                fnameError.textContent =
                    "Please enter a valid first name (only alphabets, at least 3 characters).";
                fnameError.style.display = 'block';
                isValid = false;
            } else {
                fnameError.style.display = 'none';
            }

            // Last Name Validation: Only alphabets, min 3 characters
            if (!namePattern.test(lnameInput.value) || lnameInput.value.length < 3) {
                lnameError.textContent =
                    "Please enter a valid last name (only alphabets, at least 3 characters).";
                lnameError.style.display = 'block';
                isValid = false;
            } else {
                lnameError.style.display = 'none';
            }

            // Prevent form submission if any validation fails
            if (!isValid) {
                event.preventDefault();
            }
        });
    });
    </script>
</body>

</html>