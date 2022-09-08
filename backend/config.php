<?php
    date_default_timezone_set('Asia/Kolkata');
    //  $servername = "103.21.58.4:3306";
    //  $username = "gleamad";
    //  $password = "78J?prc6";
    //  $database = "gleamrec_web_grec";

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "gleamrec_web_grec";
   
    // Create a connection
    $conn = mysqli_connect($servername, $username, $password, $database);
   
    // Die if connection was not successful
   
    if (!$conn){
        die("Sorry we failed to connect: ". mysqli_connect_error());
    }
?>