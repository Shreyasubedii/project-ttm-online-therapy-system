<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ttm";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    
    $image = $_FILES['image']['name'];
    $imageTmp = $_FILES['image']['tmp_name'];
    $imagePath = 'uploads/' . basename($image);

    $allowedTypes = ['image/jpeg', 'image/png', 'application/pdf'];
    $fileType = $_FILES['image']['type'];
    if (!in_array($fileType, $allowedTypes)) {
        echo "<script>showError('image', 'Invalid file type. Only JPG, PNG, and PDF are allowed.');</script>";
    } elseif ($_FILES['image']['size'] > 5000000) {
        echo "<script>showError('image', 'File is too large. Max size allowed is 5MB.');</script>";
    } else {
        if (move_uploaded_file($imageTmp, $imagePath)) {
            $sql = "INSERT INTO docapplications (name, contact, address, email, image)
                    VALUES ('$name', '$contact', '$address', '$email', '$imagePath')";

            if ($conn->query($sql) === TRUE) {
                echo "Application submitted successfully!";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Error uploading file.";
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/docapplication.css">
    <link rel="stylesheet" href="css/main.css">
    <title>Application Form</title>
    <style>
    .error-box {
        color: red;
        font-size: 12px;
        margin-top: 5px;
        display: none;
    }
    </style>
</head>

<body>
    <h2>Interested to Intern/Work with us? Leave the information below, upload your CV, and we will get back to you.
    </h2>

    <form action="docapplications.php" method="POST" enctype="multipart/form-data" id="applicationForm">
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name"><br>
        <div id="nameError" class="error-box">Numbers are not allowed in the name.</div>
        <br>

        <label for="contact">Contact:</label><br>
        <input type="text" id="contact" name="contact" placeholder="ex: 9876155141" required><br>
        <div id="contactError" class="error-box">Enter a valid 10-digit number starting with 98, 97, or 96.</div>
        <br>

        <label for="address">Address:</label><br>
        <textarea id="address" name="address" required></textarea><br>
        <div id="addressError" class="error-box"></div>
        <br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br>
        <div id="emailError" class="error-box"></div>
        <br>

        <label for="image">Upload Document (PDF/JPG/PNG):</label><br>
        <input type="file" id="image" name="image" accept="image/jpeg, image/png, application/pdf" required><br>
        <div id="imageError" class="error-box"></div>
        <br>

        <input type="submit" value="Submit">
    </form>

    <script>
    // JavaScript to validate and display error messages dynamically
    const form = document.getElementById('applicationForm');

    form.addEventListener('submit', function(event) {
        let isValid = true;

        // Check name field for numbers
        const nameInput = document.getElementById('name');
        const nameError = document.getElementById('nameError');
        const namePattern = new RegExp('[A-Za-z\s]$');

        if (/\d/.test(nameInput.value)) {
            nameError.style.display = 'block';
            isValid = false;
        } else {
            nameError.style.display = 'none';
        }

        // Check contact field
        const contactInput = document.getElementById('contact');
        const contactError = document.getElementById('contactError');
        const contactPattern = new RegExp('^(98|97|96)[0-9]{8}$');
        if (!contactPattern.test(contactInput.value)) {
            contactError.style.display = 'block';
            isValid = false;
        } else {
            contactError.style.display = 'none';
        }

        // Prevent form submission if any field is invalid
        if (!isValid) {
            event.preventDefault();
        }
    });
    </script>

</body>

</html>