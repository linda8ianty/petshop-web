<?php
//PAGINATION
$post_per_page = 10;
$current_page = 1;

if(isset($_GET["page"])) {
    $current_page = $_GET["page"];
}else{
    $current_page = 1;
}

$total_post = mysqli_num_rows(mysqli_query($connection, "SELECT * FROM post"));
$total_page = ceil($total_post/$post_per_page);
$offset = $post_per_page * ($current_page - 1);

// CREATE POST
if(isset($_POST["submit"])) {
    $category_id = $_POST["category_id"];
    $title = $_POST["title"];
    $description = $_POST["description"];
    $date = date("Y-m-d H:i:s");

    // INSERT PICTURE
    $file_name = $_FILES["fileToUpload"]["name"];
    $tmp_name = $_FILES["fileToUpload"]["tmp_name"];
    move_uploaded_file($tmp_name, "../image-post/". $file_name);
    mysqli_query($connection, "INSERT INTO post INTO ('', '$category_id', '$title', '$description', '$file_name', '', '$date') ");
    header("location:index.php?post");
}

$category = mysqli_query($connection, "SELECT * FROM category ORDER BY id");
$post = mysqli_query($connection, "SELECT post.*, category.category_name FROM post, category WHERE post.category_id = category.id ORDER BY post.id DESC LIMIT $offset, $post_per_page");
?>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Blog &raquo; Post</h1>
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
                        <form role="form" action="" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Category</label>
                                <select class="form-control" name="category_id">
                                    <option value=""> - choose - </option>
                                    <?php if(mysqli_num_rows($category)) {?>
                                        <?php while ($row_category = mysqli_fetch_assoc($category)) {?>
                                            <option value="<?php echo $row_category['id']; ?>"> <?php echo $row_category["category_name"]; ?> </option>
                                        <?php }?>
                                    <?php }?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Title</label>
                                <input class="form-control" type="text" name="icon" />
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" rows="3" name="description"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Image</label>
                                <input type="file" name="fileToUpload" />
                            </div>
                            <button type="submit" name="submit" class="btn btn-success">Save</button>
                            <button type="reset" class="btn btn-warning">Reset</button>
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
                                    <a class="page-link" href="index.php?post&page=<?php echo $current_page - 1; ?>">Previous</a>
                                    </li>
                                <?php }else{?>
                                    <li class="page-item disabled">
                                    <span class="page-link">Previous</span>
                                    </li>
                                <?php }?>
                            <?php }?> 
                                <!-- numbering -->
                                <?php for($no_page = 1; $no_page <= $total_page; $no_page++) {?>
                                    <li class="page-item <?php echo $current_page == $no_page ? 'active' : ''; ?>"><a class="page-link" href="index.php?post&page=<?php echo $no_page; ?>"><?php echo $no_page; ?></a></li>
                                <?php }?>
                                <!-- end of numbering -->
                            <?php if($current_page < $total_page) {?>    
                                <li class="page-item">
                                <a class="page-link" href="index.php?post&page=<?php echo $current_page + 1; ?>">Next</a>
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
                                <th>Category</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Image</th>
                                <th>Update</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if(mysqli_num_rows($post)) {?>
                            <?php $no = $offset + 1; ?>
                            <?php while($row_post = mysqli_fetch_assoc($post)) {?>
                                <tr>
                                    <td><?php echo $no;?></td>
                                    <td><?php echo $row_post["category_name"];?></td>
                                    <td><?php echo $row_post["title"];?></td>
                                    <td><?php echo substr($row_post["description"],0,250). "...";?></td>
                                    <td>
                                        <?php if($row_post["image"] == "") {echo "<img src='asset/no-image.png' width='88' class='img-responsive' />";}else{?>
                                        <img src="../image-post/<?php echo $row_post['image']; ?>" width="88" class="img-responsive" /><?php }?>
                                    </td>
                                    <td class="center"><a href="index.php?post-update=<?php echo $row_post['id'];?>" class="btn btn-primary btn-xs" type="button">Update</a></td>
                                    <td class="center"><a href="index.php?post-delete=<?php echo $row_post['id'];?>" class="btn btn-primary btn-xs" type="button">Delete</a></td>
                                </tr>
                                <?php $no++;?>
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
                                    <a class="page-link" href="index.php?post&page=<?php echo $current_page - 1; ?>">Previous</a>
                                    </li>
                                <?php }else{?>
                                    <li class="page-item disabled">
                                    <span class="page-link">Previous</span>
                                    </li>
                                <?php }?>
                            <?php }?> 
                                <!-- numbering -->
                                <?php for($no_page = 1; $no_page <= $total_page; $no_page++) {?>
                                    <li class="page-item <?php echo $current_page == $no_page ? 'active' : ''; ?>"><a class="page-link" href="index.php?post&page=<?php echo $no_page; ?>"><?php echo $no_page; ?></a></li>
                                <?php }?>
                                <!-- end of numbering -->
                            <?php if($current_page < $total_page) {?>    
                                <li class="page-item">
                                <a class="page-link" href="index.php?post&page=<?php echo $current_page + 1; ?>">Next</a>
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