<?php 
    session_start(); 
    require_once("../includes/functions.php");
    require_once("../includes/db/connection.php");
    if(!isset($_SESSION["username"])){
        redirect_to("login.php");
    }    
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css"
        integrity="sha512-Oy+sz5W86PK0ZIkawrG0iv7XwWhYecM3exvUtMKNJMekGFJtVAhibhRPTpmyTj8+lJCkmWfnpxKgT2OopquBHA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style/public.css">

    <title>myblogs</title>
</head>

<body>
    <div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <a class="navbar-brand" href="#">Navbar</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav ms-auto">
                        <?php if(isset($_SESSION["username"])):?>
                        <a class="nav-link" href="../admin/logout.php"><i class="bi bi-person-circle"></i>
                            <?php  echo ucwords($_SESSION["username"]); ?></a>
                        <?php endif; ?>
                        <a class="nav-link" href="../admin/logout.php">Logout</a>
                    </div>
                </div>
            </div>
        </nav>
    </div>
    <div class="container">
        <div class="container d-flex justify-content-between my-3">
            <h4 class="">Manage All Posts</h4>
            <a href="add_new_post.php" class="btn btn-primary d-block ">Add New Post</a>
        </div>
        <?php if(isset($_SESSION["delete"])): ?>
        <p class="alert alert-success">
            <?php 
                echo $_SESSION["delete"]; 
                $_SESSION["delete"] = null;
            ?>
        </p>
        <?php endif; ?>
        <?php if(isset($_SESSION["message"])): ?>
        <p class="alert alert-success">
            <?php 
                echo $_SESSION["message"]; 
                $_SESSION["message"] = null;
            ?>
        </p>
        <?php endif; ?>
        <?php  
            $query = "SELECT * FROM posts";
            $posts = mysqli_query($connection, $query);
            if(!$posts){
                die("Query failed.");
            }
        ?>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Post ID</th>
                    <th scope="col">Title</th>
                    <th scope="col">Thumbnail</th>
                    <th scope="col">Content</th>
                    <th scope="col">Author</th>
                    <th scope="col">Date</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php  
                    while($post = mysqli_fetch_assoc($posts)){?>
                <tr>
                    <td><?php echo $post["id"]; ?></td>
                    <td><?php echo $post["title"]; ?></td>
                    <td><img src="../includes/images/<?php echo $post["image"];?>" width="100" alt=""></td>
                    <td><?php  echo substr_replace($post["content"], "...", 50) ; ?></td>
                    <td><?php  echo $post["author"]; ?></td>
                    <td><?php  echo $post["date"]; ?></td>
                    <td>
                        <a class="btn btn-primary mx-2" href="update_post.php?id=<?php echo $post["id"];?>">EDIT</a>
                        <a class="btn btn-danger" href="delete_post.php?id=<?php echo $post["id"];?>">Delete</a>
                    </td>
                </tr>
                <?php

                    }
                ?>
            </tbody>
        </table>
    </div>

</body>