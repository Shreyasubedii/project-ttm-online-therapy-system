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
    $userid = $userFetch["pid"];
    
    
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_POST["docid"])) {
            $doc_id = $_POST["docid"];
            
            // Get the latest schedule for this doctor
            $result = $database->query("SELECT s.scheduleid, s.title, s.scheduledate, s.scheduletime, s.nop, d.docname, d.docemail 
                                      FROM schedule s 
                                      INNER JOIN doctor d ON s.docid = d.docid 
                                      WHERE s.docid = '$doc_id' 
                                      AND s.scheduledate >= CURDATE() 
                                      ORDER BY s.scheduledate ASC, s.scheduletime ASC 
                                      LIMIT 1");
            
            if ($result && $result->num_rows > 0) {
                $schedule = $result->fetch_assoc();
                // Redirect to booking page with schedule ID
                header("location: booking.php?id=" . $schedule['scheduleid']);
                exit();
            } else {
                // No available schedules found
                header("location: schedule.php?error=no_schedule");
                exit();
            }
        }
    }
    
    // If we get here, something went wrong
    header("location: schedule.php");
    exit();
?>