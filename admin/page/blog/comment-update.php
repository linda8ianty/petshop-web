<?php
//PAGINATION
$comment_per_page = 10;
$current_page = 1;

if(isset($_GET["page"])) {
    $current_page = $_GET["page"];
}else{
    $current_page = 1;
}

$total_comment = mysqli_num_rows(mysqli_query($connection, "SELECT * FROM comment WHERE comment.status = '1'"));
$total_page = ceil($total_comment/$comment_per_page);
$offset = $comment_per_page * ($current_page - 1);

//SHOW UP POST UPDATE ON FORM
$IDcomment = $_GET["comment-update"];
$edit = mysqli_query($connection, "SELECT comment.*, post.title FROM comment, post WHERE comment.id = '$IDcomment' AND comment.post_id = post.id");
$row_edit = mysqli_fetch_assoc($edit);


// UPDATE COMMENT
if(isset($_POST["update"])) {
    $comment_id = $_POST["comment_id"];
    $post_id = $_POST["post_id"];
    $name = $_POST["user"];
    $email = $_POST["email"];
    $reply = mysqli_real_escape_string($connection, $_POST["reply"]);
    $status = $_POST["status"];
    $anonymous = $_POST["anonymous"];

    mysqli_query($connection, "UPDATE comment SET post_id = '$post_id', name = '$name', anonymous = '$anonymous', email = '$email', reply = '$reply', status = '$status' WHERE id = '$comment_id'");
    header("location:index.php?comment");
}

// SHOW UP/READ POST
$post = mysqli_query($connection, "SELECT * FROM post ORDER BY id DESC");


// READ COMMENT
$comment = mysqli_query($connection, "SELECT comment.*, post.title FROM comment, post WHERE comment.post_id = post.id AND comment.status = '1' ORDER BY comment.date DESC LIMIT $offset, $comment_per_page");
?>

<!-- HTML -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Blog &raquo; Comment</h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Input Data
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form role="form" action="" method="post">
                            <div class="form-group">
                                <label>Post</label>
                                <select class="form-control" name="post_id">
                                <!-- "Post" DATA FORM -->
                                    <!-- POST show-up WHEN "UPDATE" -->
                                    <?php if(isset($row_edit)) {?>
                                        <?php if(mysqli_num_rows($post)) {?>
                                            <?php while($row_post = mysqli_fetch_assoc($post)) {?>
                                                <option <?php if($row_edit["post_id"] == $row_post["id"]) {echo "selected"; }else{echo "";} ?> value="<?php echo $row_post['id']; ?>"> <?php echo $row_post["title"]; ?> </option>
                                            <?php }?>
                                        <?php }?>
                                    <?php }else{ ?>
                                    <option value=""> - choose - </option>
                                    <?php }?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>User</label>
                                <input class="form-control" type="text" name="user" value="<?php echo $row_edit['name'];?>"/>
                            </div>
                            <div class="form-group form-check">
                            <?php if($row_edit["anonymous"] == 1) {?>
                                <input type="checkbox" class="form-check-input" id="exampleCheck1" name="anonymous" value="0" <?php echo $row_edit['anonymous'] == '1' ? "checked" : "";?>/> Set as Anonymous
                            <?php }else{?>
                                <input type="checkbox" class="form-check-input" id="exampleCheck1" name="anonymous" value="1"/> Set as Anonymous
                            <?php }?>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input class="form-control" type="email" name="email" value="<?php echo $row_edit['email'];?>"/>
                            </div>
                            <div class="form-group">
                                <label>Reply</label>
                                <textarea class="form-control" rows="3" name="reply"><?php echo $row_edit['reply'];?></textarea>
                            </div>
                            <div class="form-group">
                                <label>Status</label>
                                <div class="radio">
                                    <label>
                                        <input type="radio" value="0" name="status" <?php echo $row_edit['status'] == '0' ? "checked" : ""; ?> /> Not Active
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" value="1" name="status" <?php echo $row_edit['status'] == '1' ? "checked" : ""; ?>/> Active
                                    </label>
                                </div>
                            </div>
                            <button type="submit" name="update" class="btn btn-success">Update</button>
                            <button type="reset" class="btn btn-warning">Reset</button>
                            <input type="hidden" name="comment_id" value="<?php echo $row_edit['id']; ?>">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                List Data
            </div>

            <!-- PAGINATION TOP-->
            <div class="panel-body" style="padding:0 15px;">
                <nav aria-label="pagination">
                    <?php if(isset($total_page)) {?>
                        <ul class="pagination">
                            <?php if($total_page >= 1) {?>
                                <?php if($current_page > 1) {?>
                                    <li class="page-item">
                                    <a class="page-link" href="index.php?comment&page=<?php echo $current_page - 1; ?>">Previous</a>
                                    </li>
                                <?php }else{?>
                                    <li class="page-item disabled">
                                    <span class="page-link">Previous</span>
                                    </li>
                                <?php }?>
                            <?php }?> 
                                <!-- numbering -->
                                <?php for($no_page = 1; $no_page <= $total_page; $no_page++) {?>
                                    <li class="page-item <?php echo $current_page == $no_page ? 'active' : ''; ?>"><a class="page-link" href="index.php?comment&page=<?php echo $no_page; ?>"><?php echo $no_page; ?></a></li>
                                <?php }?>
                                <!-- end of numbering -->
                            <?php if($current_page < $total_page) {?>    
                                <li class="page-item">
                                <a class="page-link" href="index.php?comment&page=<?php echo $current_page + 1; ?>">Next</a>
                                </li>
                            <?php }else{?>
                                <li class="page-item disabled">
                                <span class="page-link">Next</span>
                                </li>
                            <?php }?>
                        </ul>
                    <?php }?>
                </nav>
            </div>
            <!-- END OF PAGINATION TOP-->
            
            <!-- SHOW UP DATA -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Post</th>
                                <th>User</th>
                                <th>Anonymous</th>
                                <th>Email</th>
                                <th>Reply</th>
                                <th>Status</th>
                                <th>Datetime</th>
                                <th>Update</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if(mysqli_num_rows($comment)) {?>
                            <?php $no = $offset + 1; ?>
                            <?php while($row_comment = mysqli_fetch_assoc($comment)) {?>
                                <tr>
                                    <td><?php echo $no; ?></td>
                                    <td><?php echo $row_comment["title"]; ?></td>
                                    <td><?php echo $row_comment["name"]; ?></td>
                                    <td><?php echo $row_comment["anonymous"] == '1' ? "Yes" : "No"; ?></td>
                                    <td><?php echo $row_comment["email"]; ?></td>
                                    <td><?php echo $row_comment["reply"]; ?></td>
                                    <td><?php echo $row_comment["status"] == '1' ? "Active" : "Not Active"; ?></td>
                                    <td><?php echo $row_comment["date"]; ?></td>
                                    <td class="center"><a href="index.php?comment-update=<?php echo $row_comment['id']; ?>" class="btn btn-primary btn-xs" type="button">Update</a></td>
                                    <td class="center"><a href="index.php?comment-delete=<?php echo $row_comment['id']; ?>" class="btn btn-primary btn-xs" type="button">Delete</a></td>
                                </tr>
                            <?php $no++; ?>
                            <?php }?>
                        <?php }?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- END OF SHOW DATA -->

            <!-- PAGINATION BOTTOM-->
            <div class="panel-body" style="padding:0 15px;">
                <nav aria-label="pagination">
                    <?php if(isset($total_page)) {?>
                        <ul class="pagination">
                            <?php if($total_page >= 1) {?>
                                <?php if($current_page > 1) {?>
                                    <li class="page-item">
                                    <a class="page-link" href="index.php?comment&page=<?php echo $current_page - 1; ?>">Previous</a>
                                    </li>
                                <?php }else{?>
                                    <li class="page-item disabled">
                                    <span class="page-link">Previous</span>
                                    </li>
                                <?php }?>
                            <?php }?> 
                                <!-- numbering -->
                                <?php for($no_page = 1; $no_page <= $total_page; $no_page++) {?>
                                    <li class="page-item <?php echo $current_page == $no_page ? 'active' : ''; ?>"><a class="page-link" href="index.php?comment&page=<?php echo $no_page; ?>"><?php echo $no_page; ?></a></li>
                                <?php }?>
                                <!-- end of numbering -->
                            <?php if($current_page < $total_page) {?>    
                                <li class="page-item">
                                <a class="page-link" href="index.php?comment&page=<?php echo $current_page + 1; ?>">Next</a>
                                </li>
                            <?php }else{?>
                                <li class="page-item disabled">
                                <span class="page-link">Next</span>
                                </li>
                            <?php }?>
                        </ul>
                    <?php }?>
                </nav>
            </div>
            <!-- END OF PAGINATION BOTTOM-->
            
        </div>
    </div>
</div>