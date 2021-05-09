<?php
$query = mysqli_query($connection, "SELECT * FROM facilities ORDER BY id ASC");
?>

<div class="container homepage">
    <div class="row row-cols-1 row-cols-md-2 g-4">
        <?php if(mysqli_num_rows($query)) {?>
            <?php while($post_row = mysqli_fetch_assoc($query)) {?>
                <div class="col">
                    <!-- <div class="card"> -->
                    <img src="images/<?php echo $post_row['image'];?>" class="card-img-top float-left w-50" alt="<?php echo $post_row['facility_name'];?>">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $post_row['facility_name'];?></h5>
                        <p class="card-text"><?php echo substr($post_row['description'], 0, 60); ?> <a class="more" href="index.php?blog=<?php echo $post_row['id']; ?>">View all</a></p>
                    </div>
                    <!-- </div> -->
                </div>
            <?php }?>
        <?php }?>
    </div>
</div>
