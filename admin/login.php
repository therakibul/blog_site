<?php session_start();?>
<?php require_once("../includes/layout/header.php");?>
<?php require_once("../includes/functions.php");?>
<?php  
    if(isset($_POST["login"])){
        $username = $_POST["lname"];
        $password = $_POST["lpass"];
        
        $query = "SELECT * FROM users WHERE username = '{$username}' AND password = '{$password}'";
        $result = mysqli_query($connection, $query);
        if(mysqli_num_rows($result) > 0){
            $_SESSION["username"] = $username;
            $_SESSION["password"] = $password;
            redirect_to("posts.php");
        }else{
            $_SESSION["error_message"] = "Please create an account.";
        }
    }

    if(isset($_POST["reg"])){  
        $username = $_POST["rname"];
        $password = $_POST["rpass"];
        $query = "INSERT INTO users (username, password) VALUES ('{$username}', '{$password}')";
        $result = mysqli_query($connection, $query);
        if(!$result){
            die("Query failed.");
        }else{
            $_SESSION['user_message'] = "Registation successful. Please login.";
        }
    }

?>
<div class="container">
    <div class="row">
        <h2 class="text-center mt-5">User login and registation system</h2>
        <div class="col-md-6">
            <h3 class="mt-5 text-center">Login Form</h3>
            <form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
                <div class="mb-3">
                    <label for="lname" class="form-label">Username</label>
                    <input type="text" class="form-control" id="lname" name="lname" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" name="lpass" class="form-control" id="exampleInputPassword1" require>
                </div>
                <button type="submit" class="btn btn-primary" name="login">Login</button>
                <?php  if(isset($_SESSION["error_message"])):?>
                <p class="alert alert-success mt-2">
                    <?php 
                        echo $_SESSION["error_message"];
                        $_SESSION["error_message"] = null;
                    ?>
                </p>
                <?php endif; ?>
            </form>
        </div>
        <div class="col-md-6">
            <h3 class="mt-5 text-center">Registration Form</h3>
            <form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
                <div class="mb-3">
                    <label for="rname" class="form-label">Username</label>
                    <input type="text" class="form-control" name="rname" id="rname" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" name="rpass" class="form-control" id="exampleInputPassword1">
                </div>
                <button type="submit" class="btn btn-primary" name="reg">Sign Up</button>
                <?php  if(isset($_SESSION["user_message"])):?>
                <p class="alert alert-success mt-2">
                    <?php 
                        echo $_SESSION["user_message"]; 
                        $_SESSION["user_message"] = null;
                    ?>
                </p>
                <?php endif; ?>
            </form>
        </div>
    </div>
</div>