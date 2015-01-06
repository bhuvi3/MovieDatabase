<?php 

    // These variables define the connection information for your MySQL database 
    $username = "root"; 
    $password = "qwerty123"; 
    $host = "localhost"; 
    $dbname = "movie_db"; 
    
    // Create connection
    $conn = mysqli_connect($host, $username, $password, $dbname);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    //echo "Connected successfully";

    //header('Content-Type: text/html; charset=utf-8'); 
?>