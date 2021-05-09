<?php
//PAGINATION
$post_per_page = 3;
$current_page = 1;

if(isset($_GET["page"])) {
    $current_page = $_GET["page"];
}else{
    $current_page = 1;
}


$total_post = mysqli_num_rows(mysqli_query($connection, "SELECT * FROM admin"));
$total_page = ceil($total_post/$post_per_page);
$offset = $post_per_page * ($current_page - 1);


// SHOW UP DATA-UPDATE
$adminID = $_GET["administrator-update"];
$edit = mysqli_query($connection, "SELECT * FROM admin WHERE id = '$adminID'");
$row_edit = mysqli_fetch_assoc($edit);

// UPDATE PROCESS
if(isset($_POST["update"])) {
    $admin_id = $_POST["admin_id"];
    $username = mysqli_real_escape_string($connection, $_POST["username"]);
    $password = mysqli_real_escape_string($connection, password_hash($_POST["password"], PASSWORD_DEFAULT));
    $shown_password = mysqli_real_escape_string($connection, $_POST["password"]);
    mysqli_query($connection, "UPDATE admin SET username = '$username', password = '$password', shown_password = '$shown_password' WHERE id = '$admin_id' ");
    header("location:index.php?administrator");
}

// READ/SHOW UP DATA IN FORM
$query = mysqli_query($connection, "SELECT * FROM admin ORDER BY id DESC LIMIT $offset, $post_per_page");
?>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Blog &raquo; Administrator</h1>
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
                                <label>Username</label>
                                <input class="form-control" type="text" name="username" value="<?php echo $row_edit['username']; ?>"/>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input class="form-control" type="password" name="password" value="<?php echo $row_edit['shown_password']; ?>"/>
                            </div>
                            <button type="submit" name="update" class="btn btn-success">Update</button>
                            <button type="reset" class="btn btn-warning">Reset</button>
                            <input type="hidden" name="admin_id" value="<?php echo $row_edit['id']; ?>">
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
                                    <a class="page-link" href="index.php?administrator&page=<?php echo $current_page - 1; ?>">Previous</a>
                                    </li>
                                <?php }else{?>
                                    <li class="page-item disabled">
                                    <span class="page-link">Previous</span>
                                    </li>
                                <?php }?>
                            <?php }?> 
                                <!-- numbering -->
                                <?php for($no_page = 1; $no_page <= $total_page; $no_page++) {?>
                                    <li class="page-item <?php echo $current_page == $no_page ? 'active' : ''; ?>"><a class="page-link" href="index.php?administrator&page=<?php echo $no_page; ?>"><?php echo $no_page; ?></a></li>
                                <?php }?>
                                <!-- end of numbering -->
                            <?php if($current_page < $total_page) {?>    
                                <li class="page-item">
                                <a class="page-link" href="index.php?administrator&page=<?php echo $current_page + 1; ?>">Next</a>
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
                                <th>Username</th>
                                <th>Password</th>
                                <th>Update</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if(mysqli_num_rows($query)) {?>
                            <?php $no = $offset + 1; ?>
                            <?php while($row_admin = mysqli_fetch_assoc($query)) {?>
                                <tr>
                                    <td><?php echo $no; ?></td>
                                    <td><?php echo $row_admin["username"]; ?></td>
                                    <td><?php echo $row_admin["shown_password"]; ?></td>
                                    <td class="center"><a href="index.php?administrator-update=<?php echo $row_admin['id']; ?>" class="btn btn-primary btn-xs" type="button">Update</a></td>
                                    <td class="center"><a href="index.php?administrator-delete=<?php echo $row_admin['id']; ?>" class="btn btn-primary btn-xs" type="button">Delete</a></td>
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
                                    <a class="page-link" href="index.php?administrator&page=<?php echo $current_page - 1; ?>">Previous</a>
                                    </li>
                                <?php }else{?>
                                    <li class="page-item disabled">
                                    <span class="page-link">Previous</span>
                                    </li>
                                <?php }?>
                            <?php }?> 
                                <!-- numbering -->
                                <?php for($no_page = 1; $no_page <= $total_page; $no_page++) {?>
                                    <li class="page-item <?php echo $current_page == $no_page ? 'active' : ''; ?>"><a class="page-link" href="index.php?administrator&page=<?php echo $no_page; ?>"><?php echo $no_page; ?></a></li>
                                <?php }?>
                                <!-- end of numbering -->
                            <?php if($current_page < $total_page) {?>    
                                <li class="page-item">
                                <a class="page-link" href="index.php?administrator&page=<?php echo $current_page + 1; ?>">Next</a>
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