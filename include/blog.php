<?php
//PAGINATION
$post_per_page = 3;
$current_page = 1;

if(isset($_GET["page"])) {
    $current_page = $_GET["page"];
}else{
    $current_page = 1;
}

$total_post = mysqli_num_rows(mysqli_query($connection, "SELECT * FROM post"));
$total_page = ceil($total_post/$post_per_page);
$offset = $post_per_page * ($current_page - 1);


//TAMPILKAN DATA POST
$query = mysqli_query($connection, "SELECT * FROM post ORDER BY id DESC LIMIT $offset, $post_per_page");
?>

<!-- POST PHP -->
<?php if(mysqli_num_rows($query)) {?>
    <?php while($blog_post_row = mysqli_fetch_assoc($query)) {?>
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
<?php }?>
<!-- PAGINATION PHP -->
<?php if(isset($total_page)) {?>
    <div>
        <?php if($total_page > 1) {?>
            <?php if($current_page > 1) {?>
                <a class="old active" href="index.php?blog&page=<?php echo $current_page - 1; ?>">Previous</a>
            <?php } else { ?>
            <!-- <a class="old disabled">Old Post</a> -->
            <?php }?>
        <?php }?>
        <?php if($current_page < $total_page) {?>
            <a class="new active" href="index.php?blog&page=<?php echo $current_page + 1; ?>">Next</a>
        <?php } else {?>
            <!-- <a class="new disabled">New Post</a> -->
        <?php }?>
    </div>
<?php }?>