<?php

    //learn from w3schools.com

    session_start();

    if(isset($_SESSION["user"])){
        if(($_SESSION["user"])=="" or $_SESSION['usertype']!='p'){
            header("location: ../login.php");
        }else{
            $useremail=$_SESSION["user"];
        }

    }else{
        header("location: ../login.php");
    }
    

    //import database
    include("../connection.php");
    $sqlmain= "select * from patient where pemail=?";
    $stmt = $database->prepare($sqlmain);
    $stmt->bind_param("s",$useremail);
    $stmt->execute();
    $userrow = $stmt->get_result();
    $userfetch=$userrow->fetch_assoc();
    $userid= $userfetch["pid"];
    $username=$userfetch["pname"];


    if($_POST){
        if(isset($_POST["booknow"])){
            $apponum=$_POST["apponum"];
            $scheduleid=$_POST["scheduleid"];
            $date=$_POST["date"];
            
            // Get session details for payment
            $sql = "SELECT s.title, s.scheduledate, s.scheduletime, d.docname 
                    FROM schedule s 
                    INNER JOIN doctor d ON s.docid = d.docid 
                    WHERE s.scheduleid = ?";
            $stmt = $database->prepare($sql);
            $stmt->bind_param("i", $scheduleid);
            $stmt->execute();
            $result = $stmt->get_result();
            $session = $result->fetch_assoc();
            
            // Store booking details in session for after payment
            $_SESSION['pending_booking'] = [
                'apponum' => $apponum,
                'scheduleid' => $scheduleid,
                'date' => $date,
                'userid' => $userid,
                'title' => $session['title'],
                'docname' => $session['docname'],
                'scheduledate' => $session['scheduledate'],
                'scheduletime' => $session['scheduletime']
            ];
            
            // Redirect to eSewa payment
            header("location: esewa-payment.php");
            exit();
        }
    }
 ?>