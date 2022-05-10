<?php  
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db_name = "myblogs";
    $connection = mysqli_connect($host, $user, $pass, $db_name);
    if(!$connection){
        die("Database connection failed.");
    }

?>