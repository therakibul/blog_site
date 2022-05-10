<?php require_once("../includes/layout/header.php");?>
<?php require_once("../includes/layout/nav.php");?>
<?php  
    $id = $_GET["id"] ?? 0;
    if($id){
        $query = "SELECT * FROM posts WHERE id = {$id}";
        $result = mysqli_query($connection, $query);
        if(!$result){
            die("<h3 class='alert alert-danger'>Query failed.</h3>");
        }

        $post = mysqli_fetch_assoc($result);
    }
?>


<div class="container py-3">
    <div class="blog">
        <h3 class="mb-3 text-center"><?php if($id){ echo $post["title"];} ?></h3>
        <img class="img-fluid" src="../includes/images/<?php  if($id){ echo $post["image"];} ?>" alt="">
        <p class="lead"><?php  if($id){ echo $post["content"];} ?></p>
        <h5>Author Info</h5>
        <ul>
            <li><?php  if($id){ echo $post["author"];} ?></li>
            <li><?php  if($id){ echo $post["date"];} ?></li>
        </ul>
    </div>
</div>

<?php require_once("../includes/layout/footer.php");?>