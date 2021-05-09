<?php
$query = mysqli_query($connection, "SELECT * FROM facilities ORDER BY id ASC LIMIT 3");
?>

<div class="featured">
    <h2>Featured Topic</h2>
    <ul>
    <?php if(mysqli_num_rows($query)) {?>
        <?php while($featured = mysqli_fetch_assoc($query)) {?>
            <li>
                <a href="about.html"><img src="images/<?php echo $featured['image']; ?>" width="115" height="155" alt="Pet Shop" title="Pet Shop"></a>
                <h2><a href="index.php?about"><?php echo $featured["facility_name"]; ?></a></h2>
                <p style="margin-top:20px">
                <?php echo substr($featured["description"], 0, 100); ?> <a class="more" href="index.php?about">read more</a>
                </p>
            </li>
        <?php }?>
    <?php }?>
    </ul>
</div>