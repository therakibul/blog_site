<?php  
    require_once("../includes/functions.php");
    session_start();
    session_unset();
    session_destroy();
    redirect_to("login.php");
?>