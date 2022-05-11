<?php 
    session_start(); 
    require_once("../includes/functions.php");
    require_once("../includes/layout/header.php");
    if(!isset($_SESSION["username"])){
        redirect_to("login.php");
    }    
?>
<?php  
    if(isset($_GET["id"])){
        $query = "DELETE from posts WHERE id = {$_GET['id']}";
        $delete_post = mysqli_query($connection, $query);
        if($delete_post){
            $_SESSION["delete"] = "Post delete successful";
            redirect_to("posts.php");
        }
    }
?>