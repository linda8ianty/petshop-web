<?php
$category_per_page = 10;
$current_page = 1;

if(isset($_GET["page"])) {
    $current_page = $_GET["page"];
}else{
    $current_page = 1;
}

$total_category = mysqli_num_rows(mysqli_query($connection, "SELECT * FROM category"));
$total_page = ceil($total_category/$category_per_page);
$offset = $category_per_page * ($current_page - 1);

//READ CATEGORY-UPDATE
$IDcategory = $_GET["category-update"];
$edit = mysqli_query($connection, "SELECT * FROM category WHERE id = '$IDcategory'");
$row_edit = mysqli_fetch_assoc($edit);

// UPDATE CATEGORY
if(isset($_POST["update"])) {
    $category_id = $_POST["category_id"];
    $name = $_POST["name"];
    $icon = $_POST["icon"];
    mysqli_query($connection, "UPDATE category SET category_name = '$name', category_icon = '$icon' WHERE id = '$category_id'");
    header("location:index.php?category");
}

// SHOW CATEGORY-UPDATE
$category = mysqli_query($connection, "SELECT * FROM category ORDER BY id DESC LIMIT $offset, $category_per_page");
?>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Blog &raquo; Category</h1>
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
                            <!-- SHOWING UP THE DATA -->
                                <label>Name</label>
                                <input class="form-control" type="text" name="name" value="<?php echo $row_edit['category_name'];?>"/>
                            </div>
                            <div class="form-group">
                                <label>Icon</label>
                                <input class="form-control" type="text" name="icon" value="<?php echo $row_edit['category_icon'];?>"/>
                            </div>
                            <button type="submit" name="update" class="btn btn-success">Update</button>
                            <button type="reset" class="btn btn-warning">Reset</button>
                            <input type="hidden" name="category_id" value="<?php echo $row_edit['id'];?>">
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
                                    <a class="page-link" href="index.php?category&page=<?php echo $current_page - 1; ?>">Previous</a>
                                    </li>
                                <?php }else{?>
                                    <li class="page-item disabled">
                                    <span class="page-link">Previous</span>
                                    </li>
                                <?php }?>
                            <?php }?> 
                                <!-- numbering -->
                                <?php for($no_page = 1; $no_page <= $total_page; $no_page++) {?>
                                    <li class="page-item <?php echo $current_page == $no_page ? 'active' : ''; ?>"><a class="page-link" href="index.php?category&page=<?php echo $no_page; ?>"><?php echo $no_page; ?></a></li>
                                <?php }?>
                                <!-- end of numbering -->
                            <?php if($current_page < $total_page) {?>    
                                <li class="page-item">
                                <a class="page-link" href="index.php?category&page=<?php echo $current_page + 1; ?>">Next</a>
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

            <!-- SHOW UP THE DATA -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Icon</th>
                                <th>Update</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if(mysqli_num_rows($category)) {?>
                            <?php $no = $offset + 1; ?>
                            <?php while($row_category = mysqli_fetch_assoc($category)) {?>
                                <tr>
                                    <td><?php echo $no;?></td>
                                    <td><?php echo $row_category["category_name"];?></td>
                                    <td><?php echo $row_category["category_icon"];?></td>
                                    <td class="center"><a href="index.php?category-update=<?php echo $row_category['id'];?>" class="btn btn-primary btn-xs" type="button">Update</a></td>
                                    <td class="center"><a href="index.php?category-delete=<?php echo $row_category['id'];?>" class="btn btn-primary btn-xs" type="button">Delete</a></td>
                                </tr>
                                <?php $no++;?>
                            <?php }?>
                        <?php }?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- END OF SHOW THE DATA -->

            <!-- PAGINATION BOTTOM-->
            <div class="panel-body" style="padding:0 15px;">
                <nav aria-label="pagination">
                    <?php if(isset($total_page)) {?>
                        <ul class="pagination">
                            <?php if($total_page >= 1) {?>
                                <?php if($current_page > 1) {?>
                                    <li class="page-item">
                                    <a class="page-link" href="index.php?category&page=<?php echo $current_page - 1; ?>">Previous</a>
                                    </li>
                                <?php }else{?>
                                    <li class="page-item disabled">
                                    <span class="page-link">Previous</span>
                                    </li>
                                <?php }?>
                            <?php }?> 
                                <!-- numbering -->
                                <?php for($no_page = 1; $no_page <= $total_page; $no_page++) {?>
                                    <li class="page-item <?php echo $current_page == $no_page ? 'active' : ''; ?>"><a class="page-link" href="index.php?category&page=<?php echo $no_page; ?>"><?php echo $no_page; ?></a></li>
                                <?php }?>
                                <!-- end of numbering -->
                            <?php if($current_page < $total_page) {?>    
                                <li class="page-item">
                                <a class="page-link" href="index.php?category&page=<?php echo $current_page + 1; ?>">Next</a>
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