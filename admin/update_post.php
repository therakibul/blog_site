<?php 
    session_start(); 
    require_once("../includes/functions.php");
    require_once("../includes/layout/header.php");
    if(!isset($_SESSION["username"])){
        redirect_to("login.php");
    }    
?>

<?php  
    
    if(isset($_POST["submit"])){
        // Upload file
        if(isset($_FILES["image"])){
            $file_name = $_FILES["image"]["name"];
            $type = $_FILES["image"]["type"];
            $tmp_name = $_FILES["image"]["tmp_name"];
            $file_size = $_FILES["image"]["size"];
            move_uploaded_file($tmp_name, "../includes/images/".$file_name);
        }

        // Update post
        $id = $_GET["id"] ?? 0;
        $title = $_POST["title"];
        $image = $_FILES["image"]["name"];
        $content = $_POST["content"];
        $author = $_POST["author"];
        $date = $_POST["date"];

        
        $query = "UPDATE posts ";
        $query .="SET title = '{$title}', image = '{$image}', content = '{$content}', author = '{$author}', date = '{$date}' ";
        $query .= "WHERE id = {$id}";

        
        $update_post = mysqli_query($connection, $query);
        if($update_post){
            redirect_to("posts.php?update=success");
            $_SESSION["message"] = "Post Update";
        }
        
    }

?>

<body>
    <div class="container">
        <h3 class="text-warning text-center my-2">Update Post</h3>
        <?php  
            $id = $_GET["id"] ?? 0;
            $query = "SELECT * FROM posts WHERE id = {$id}";
            $result = mysqli_query($connection, $query);
            $post = mysqli_fetch_assoc($result);
        ?>
        <form action="update_post.php?id=<?php echo $id;?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" class="form-control" id="title" aria-describedby="emailHelp"
                    placeholder="Text" value="<?php if($id){echo $post["title"];}?>">
            </div>
            <div class="form-group">
                <label for="content">Content</label>
                <textarea name="content" id="content" cols="150"
                    rows="10"><?php if($id){echo $post["content"];}?></textarea>
            </div>
            <div class="form-group">
                <label class="form-label" for="customFile">Upload Image</label>
                <input type="file" name="image" class="form-control" id="customFile" />
            </div>

            <div class="form-group">
                <label for="author">Author</label>
                <input type="text" name="author" class="form-control" id="author" aria-describedby="emailHelp"
                    placeholder="Author" value="<?php if($id){echo $post["author"];}?>">
            </div>
            <div class="form-group">
                <label for="content">Date</label>
                <input type="date" name="date" class="form-control" id="content" aria-describedby="emailHelp"
                    value="<?php if($id){echo $post["date"];}?>">
            </div>
            <br>
            <button name="submit" type="submit" class="btn btn-primary">Update Post</button>
        </form>
    </div>

</body>