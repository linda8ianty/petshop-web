<?php
//SEARCH
$option = isset($_POST["search-option"]);


if(isset($_POST["search"])) {
    $_SESSION["session_search"] = $_POST["find"];
    $find = $_SESSION["session_search"];
} else {
    $find = $_SESSION["session_search"];
}

//PAGINATION 
$post_per_page = 3;
$current_page = 1;

// pagination article
if(isset($_GET["pagearticle"])) {
    $current_page = $_GET["pagearticle"];
}else{
    $current_page = 1;
}
$total_post_article = mysqli_num_rows(mysqli_query($connection, "SELECT * FROM post WHERE title LIKE '%$find%' ORDER BY id DESC "));
$total_page_article = ceil($total_post_article/$post_per_page);


// offset
$offset = ($current_page - 1) * $post_per_page;


//TAMPILKAN DATA POST
$query_article = mysqli_query($connection, "SELECT * FROM post WHERE title LIKE '%$find%' ORDER BY id DESC LIMIT $post_per_page OFFSET $offset");
?>

<!-- POST PHP -->
    <!-- post article -->
    <?php if(mysqli_num_rows($query_article) > 0) {?>
        <?php while($blog_post_row = mysqli_fetch_assoc($query_article)) {?>
            <ul class="articles">
                <li>
                    <div>
                        <span><?php echo tanggal_eng($blog_post_row["date"]); ?></span> 
                        <h2><a class="more" href="index.php?detail=<?php echo $blog_post_row['id']; ?>"><?php echo $blog_post_row["title"]; ?></a></h2>  
                        <a class="heart" href="index.php?blog">&nbsp;</a>
                        <a class="twitter" href="index.php?blog">&nbsp;</a>
                        <a class="facebook" href="index.php?blog">&nbsp;</a>
                    </div>

                    <!-- img added -->
                    <a class="more" href="index.php?detail=<?php echo $blog_post_row['id']; ?>"><img src="image-post/<?php echo $blog_post_row['image']; ?>" class="image-blog" alt=""></a>
                    <br>
                    <p><?php echo tanggal_indo($blog_post_row["date"]); ?></p>
                    <br>
                    <!-- end of added -->
                    <p>
                        <?php echo substr($blog_post_row["description"], 0, 250) . "... "; ?>
                        <a class="more" href="index.php?detail=<?php echo $blog_post_row['id']; ?>">read more</a>
                    </p>
                </li>
            </ul>
        <?php }?>
    <?php } else {?>
        <h2 id="find"><?php echo "Article not found. Try another keyword."; ?></h2>
    <?php }?>
    <!-- end of post article -->

<!-- PAGINATION PHP -->

    <!-- pagination article -->
    <?php if(isset($total_page_article)) {?>
        <div>
            <?php if($total_page_article > 1) {?>
                <?php if($current_page > 1) {?>
                    <a class="old active" href="index.php?pagearticle=<?php echo $current_page - 1; ?>">Previous</a>
                <?php } else { ?>
                <!-- <a class="old disabled">Old Post</a> -->
                <?php }?>
            <?php }?>
            <?php if($current_page < $total_page_article) {?>
                <a class="new active" href="index.php?pagearticle=<?php echo $current_page + 1; ?>">Next</a>
            <?php } else {?>
                <!-- <a class="new disabled">New Post</a> -->
            <?php }?>
        </div>
    <?php }?>
    <!-- end of pagination article -->