<?php
$per_page = 4;
//TAMPILKAN DATA POST
$query = mysqli_query($connection, "SELECT * FROM post WHERE category_id = 2 ORDER BY id DESC LIMIT $per_page");
?>

<!-- POST PHP -->
<div class="section">
    <ul>
        <?php if(mysqli_num_rows($query)) {?>
            <?php while($blog_post_row = mysqli_fetch_assoc($query)) {?>
                <li>
                <a href="index.php?detail=<?php echo $blog_post_row['id']; ?>"><img src="image-post/<?php echo $blog_post_row['image']; ?>" width="240" height="186" alt="Pet Shop" title="Pet Shop"></a>
                    <h2><a href="index.php?detail=<?php echo $blog_post_row['id']; ?>"><?php echo $blog_post_row['title']; ?></a></h2>
                    <p>
                    <?php echo substr($blog_post_row["description"], 0, 80); ?> <a class="more" href="index.php?detail=<?php echo $blog_post_row['id']; ?>">Read More</a> 
                    </p>
                </li>
            <?php }?>
        <?php }?>
    </ul>
</div>
<div id="footnote">
    <div class="section">
        &copy; 2011 <a href="index.php">Petshop</a> by <a href="https://www.linkedin.com/in/linda-oktavianty-22b650ba/" target="blank">Linda Nurul Oktavianty</a>. All Rights Reserved.
    </div>
</div>