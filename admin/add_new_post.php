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

        // Insert new post
        $title = $_POST["title"];
        $image = $_FILES["image"]["name"];
        $content = $_POST["content"];
        $author = $_POST["author"];
        $date = $_POST["date"];
       
        $query = "INSERT INTO posts ";
        $query .="( title, image, content, author, date";
        $query .= ") VALUES (";
        $query .= " '{$title}', '{$image}', '{$content}', '{$author}', '{$date}' ";
        $query .=")";
        
        $post = mysqli_query($connection, $query);
        if($post){
            redirect_to("posts.php?message=success");
            $_SESSION["message"] = "New post added";
        }
        
    }

?>

<body>
    <div class="container">
        <h3 class="text-warning text-center my-2">Add new Post</h3>
        <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" class="form-control" id="title" aria-describedby="emailHelp"
                    placeholder="Text">
            </div>
            <div class="form-group">
                <label for="content">Content</label>
                <textarea name="content" id="content" cols="150" rows="10"></textarea>
            </div>
            <div class="form-group">
                <label class="form-label" for="customFile">Upload Image</label>
                <input type="file" name="image" class="form-control" id="customFile" />
            </div>

            <div class="form-group">
                <label for="author">Author</label>
                <input type="text" name="author" class="form-control" id="author" aria-describedby="emailHelp"
                    placeholder="Author" value="Md Rakibul Hasan">
            </div>
            <div class="form-group">
                <label for="content">Date</label>
                <input type="date" name="date" class="form-control" id="content" aria-describedby="emailHelp"
                    placeholder="Content">
            </div>
            <br>
            <button name="submit" type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

</body>