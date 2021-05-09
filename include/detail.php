<?php
// PAGINATION SINGLE POST
$post_per_page = 1;
$current_page = $_GET["detail"];

if(isset($_GET["detail"])) {
    $current_page = $_GET["detail"];
}

// next and old post
$next = mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM post WHERE id > '$current_page' ORDER BY id ASC LIMIT $post_per_page"));

$old = mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM post WHERE id < '$current_page' ORDER BY id DESC LIMIT $post_per_page"));

// convert string ke number (pagination)
$query_id = mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM post ORDER BY id DESC LIMIT 1"));
$total_id = intval($query_id["id"]);

$total_post = mysqli_num_rows(mysqli_query($connection, "SELECT * FROM post"));
//$total_page = $total_post/$post_per_page;

//TAMPILKAN DATA POST DETAIL
$detail_id = $_GET["detail"];
$query = mysqli_query($connection, "SELECT * FROM post WHERE post.id = '$detail_id'");
$detail_post = mysqli_fetch_assoc($query);

// INPUT COMMENT
if(isset($_POST["submit"])) {
    $postid = $_POST["postid"];
    $name = mysqli_real_escape_string($connection, $_POST["name"]);
    $email = mysqli_real_escape_string($connection, $_POST["email"]);
    $comment = mysqli_real_escape_string($connection, $_POST["comment"]);
    $date = date("Y-m-d H:i:s");

    if(isset($_POST["anonymous"]) == "anonym") {
        mysqli_query($connection, "INSERT INTO comment VALUES ('', '$postid', '$name', '1', '$email', '$comment', '0', '$date') ");
        header("location:index.php?detail=$postid&success-comment#success");
    } else {
        mysqli_query($connection, "INSERT INTO comment VALUES ('', '$postid', '$name', '0', '$email', '$comment', '0', '$date') ");
        header("location:index.php?detail=$postid&success-comment#success");
    }
}

// TAMPILKAN COMMENT
$comment = mysqli_query($connection, "SELECT * FROM comment WHERE post_id = '$detail_id' AND STATUS = 1 ORDER BY id DESC");
?>

<!-- POST DETAIL PHP -->
<ul class="articles">
    <li>
        <div>
            <span><?php echo tanggal_eng($detail_post["date"]); ?></span> 
            <h2><?php echo $detail_post["title"]; ?></h2>  
            <a class="heart" href="index.php?blog">&nbsp;</a>
            <a class="twitter" href="index.php?blog">&nbsp;</a>
            <a class="facebook" href="index.php?blog">&nbsp;</a>
        </div>

        <!-- img added -->
        <img src="image-post/<?php echo $detail_post['image']; ?>" class="image-detail" alt="">
        <br>
        <p><?php echo tanggal_indo($detail_post["date"]); ?></p>
        <br>
        <!-- end of added -->
        <p><?php echo $detail_post["description"]; ?></p>
    </li>
</ul>


<!-- PAGINATION PHP -->
<?php if(isset($total_post)) {?>
    <div>
            <?php if($total_post > 1) {?>
                <?php if($current_page > 1) {?>
                    <a class="old active" href="index.php?detail=<?php echo $old['id']; ?>">Old Post</a>
                <?php } else { ?>
                <?php }?>
            <?php }?>
            <?php if($current_page < $total_id) {?>
                <a class="new active" href="index.php?detail=<?php echo $next['id']; ?>">New Post</a>
            <?php } else {?>
            <?php }?>
    </div>
<?php }?>

<!-- COMMENT -->
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <span aria-hidden="true">
            <i class="fas fa-comments"></i>
            </span>
            <?php echo mysqli_num_rows($comment); ?> Comment(s)
        </div>
        <div class="card-body">
            <ul class="list-group">
                <?php if(mysqli_num_rows($comment)) {?>
                    <?php while($row_comment = mysqli_fetch_assoc($comment)) {?>
                        <?php if($row_comment["anonymous"] > 0) {?>
                            <li class="list-group-item"><strong>Anonymous</strong>: <?php echo $row_comment["reply"]; ?></li>
                        <?php } else {?>
                        <li class="list-group-item"><strong><?php echo $row_comment["name"]; ?></strong>: <?php echo $row_comment["reply"]; ?></li>
                        <?php }?>
                    <?php }?>
                <?php }?>
            </ul>
        </div>
    </div>
</div>
<br>
<!-- COMMENT FORM -->
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <span aria-hidden="true">
            <i class="fas fa-pencil-alt"></i>
            </span> Write your comment here
        </div>
        <div class="card-body">
            <form method="post">
            <?php if(isset($_GET["success-comment"])) {?>
                <div class="form-group">
                <p style="color:#ff9500; font-family:Arial">Thank you! your message has been received and is currently being reviewed by our team.</p>
                </div>
            <?php }?>
                <div class="form-group">
                    <input type="text" class="form-control" id="exampleInputName1" placeholder="Your name" name="name">
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Your email" name="email">
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>
                <div class="form-group">
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Your comment" name="comment"></textarea>
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1" name="anonymous" value="anonym">
                    <label class="form-check-label" for="exampleCheck1">Set as Anonymous</label>
                </div>
                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                <input type="hidden" name="postid" value="<?php echo $detail_id; ?>">
            </form>
        </div>
    </div>
</div>
<br>