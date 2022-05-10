<?php require_once("../includes/layout/header.php");?>
<?php require_once("../includes/layout/nav.php");?>
<?php  
    // Select all posts
    $query = "SELECT * FROM posts";
    $posts = mysqli_query($connection, $query);
    if(!$posts){
        die("<h3 class='text-center alert alert-danger'>Query failed.</h3>");
    }
?>
<section class="blogs bg-info py-5">
    <div class="container">
        <h3 class="text-center mb-5">My Blogs</h3>
        <div class="row g-5">
            <!-- Display all posts -->
            <?php  
                while($post = mysqli_fetch_assoc($posts)){?>
            <div class="col-md-4">
                <div class="card" style="">
                    <img class="card-img-top" src="../includes/images/<?php echo $post['image'];?>"
                        alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title"><a
                                href="single.php?id=<?php echo $post['id'];?>"><?php echo $post["title"]?></a></h5>
                        <p class="card-text"><?php echo $post["content"]?></h6>
                        <h6>Extra Information</h6>
                        <ul class="">
                            <li class=""><?php echo $post["author"]?></li>
                            <li class=""><?php echo $post["date"]?></li>
                        </ul>
                    </div>
                </div>
            </div>
            <?php
                }
            ?>

        </div>
    </div>
</section>

<?php require_once("../includes/layout/footer.php");?>