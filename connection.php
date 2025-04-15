<?php

    $database= new mysqli("localhost","root","","talktome");
    if ($database->connect_error){
        die("Connection failed:  ".$database->connect_error);
    }

?>