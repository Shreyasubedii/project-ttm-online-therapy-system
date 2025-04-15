<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/animations.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">


    <title>Login</title>
    <style>
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

<body><?php session_start();

    $_SESSION["user"]="";
    $_SESSION["usertype"]="";

    // Set the new timezone
    date_default_timezone_set('Asia/Kathmandu');
    $date=date('Y-m-d');

    $_SESSION["date"]=$date;


    include("connection.php");





    if($_POST) {

        $email=$_POST['useremail'];
        $password=$_POST['userpassword'];

        $error='<label for="promter" class="form-label"></label>';

        $result=$database->query("select * from webuser where email='$email'");

        if($result->num_rows==1) {
            $utype=$result->fetch_assoc()['usertype'];
            var_dump($utype);

            if ($utype=='p') {
                //TODO
                $checker=$database->query("select * from patient where pemail='$email' and ppassword='$password'");

                if ($checker->num_rows==1) {


                    //   Patient dashbord
                    $_SESSION['user']=$email;
                    $_SESSION['usertype']='p';

                    header('location: patient/index.php');

                }

                else {
                    $error='<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Wrong credentials: Invalid email or password</label>';
                }

            }

            elseif($utype=='a') {
                //TODO
                $checker=$database->query("select * from admin where aemail='$email' and apassword='$password'");

                if ($checker->num_rows==1) {


                    //   Admin dashbord
                    $_SESSION['user']=$email;
                    $_SESSION['usertype']='a';

                    header('location: admin/index.php');

                }

                else {
                    $error='<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Wrong credentials: Invalid email or password</label>';
                }


            }

            elseif($utype=='d') {
                //TODO
                $checker=$database->query("select * from doctor where docemail='$email' and docpassword='$password'");

                if ($checker->num_rows==1) {


                    //   doctor dashbord
                    $_SESSION['user']=$email;
                    $_SESSION['usertype']='d';
                    header('location: doctor/index.php');

                }

                else {
                    $error='<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Wrong credentials: Invalid email or password</label>';
                }

            }

        }

        else {
            $error='<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">We can not find any account for this email.</label>';
        }







    }

    else {
        $error='<label for="promter" class="form-label">&nbsp;</label>';
    }

    ?><center>
        <div class="container">
            <table border="0" style="margin: 0;padding: 0;width: 60%;">
                <tr>
                    <td>
                        <p class="header-text">Welcome Back !</p>
                    </td>
                </tr>
                <div class="form-body">
                    <tr>
                        <td>
                            <p class="sub-text">Login with your details to continue.</p>
                        </td>
                    </tr>
                    <tr>
                        <form action="" method="POST">
                            <td class="label-td"><label for="useremail" class="form-label">Email: </label></td>
                    </tr>
                    <tr>
                        <td class="label-td"><input type="email" name="useremail" class="input-text"
                                placeholder="Email Address" required></td>
                    </tr>
                    <tr>
                        <td class="label-td"><label for="userpassword" class="form-label">Password: </label></td>
                    </tr>
                    <tr>
                        <td class="label-td"><input type="Password" name="userpassword" class="input-text"
                                placeholder="Password" required>
                            <span class="toggle-password" onclick="togglePassword('userpassword', 'eye-icon1')">
                                <i id="eye-icon1" class="fa fa-eye"></i>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td><br><?php echo $error ?></td>
                    </tr>
                    <tr>
                        <td><input type="submit" value="Login" class="login-btn btn-primary btn"></td>
                    </tr>
                </div>
                <tr>
                    <td><br><label for="" class="sub-text" style="font-weight: 280;">Don't have an account? </label>
                        <a href="signup.php" class="hover-link1 non-style-link">Sign Up</a><br><br><br>
                    </td>
                </tr>
                </form>
            </table>
        </div>
    </center>
    <script>
    function togglePassword(inputId, eyeIconId) {
        var passwordField = document.getElementsByName(inputId)[0];
        var eyeIcon = document.getElementById(eyeIconId);

        if (passwordField.type === "password") {
            passwordField.type = "text";
            eyeIcon.classList.remove("fa-eye");
            eyeIcon.classList.add("fa-eye-slash");
        } else {
            passwordField.type = "password";
            eyeIcon.classList.remove("fa-eye-slash");
            eyeIcon.classList.add("fa-eye");
        }
    }
    </script>

</body>

</html>