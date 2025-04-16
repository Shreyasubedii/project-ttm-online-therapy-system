<?php 
    session_start();
    include("../connection.php");

    if(isset($_SESSION["user"])){
        if(($_SESSION["user"])=="" or $_SESSION['usertype']!='p'){
            header("location: ../login.php");
        }else{
            $useremail=$_SESSION["user"];
        }
    
    }else{
        header("location: ../login.php");
    }

    $userResult = $database->query("SELECT * FROM patient WHERE pemail = '$useremail'");
    $userFetch = $userResult->fetch_assoc();
    $userid = $userfetch["pid"];
    
    
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $doc_id = $_POST["docid"];

        $result = $database->query("SELECT * from doctor LEFT JOIN specialties on doctor.specialties = specialties.id where docid=$doc_id");

        $doc_data = $result->fetch_assoc();

        var_dump($doc_data);
    }





?>