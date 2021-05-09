<!-- PHP -->
<?php
//PAGINATION
$comment_per_page = 10;
$current_page = 1;

if(isset($_GET["page"])) {
    $current_page = $_GET["page"];
}else{
    $current_page = 1;
}

$total_comment = mysqli_num_rows(mysqli_query($connection, "SELECT * FROM comment WHERE comment.status = '0'"));
$total_page = ceil($total_comment/$comment_per_page);
$offset = $comment_per_page * ($current_page - 1);


// SHOW UP/READ COMMENT DATA
$comment = mysqli_query($connection, "SELECT comment.*, post.title FROM comment, post WHERE comment.post_id = post.id AND comment.status = '0' ORDER BY comment.id DESC LIMIT $offset, $comment_per_page");
?>
<!-- HTML -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Dashboard</h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Notifications
            </div>
            <div class="panel-body">
                <?php if(isset($_GET["success-comment"])) {?>
                <div class="alert alert-success alert-dismissable">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">&times;</button>
                    Approve Comment Berhasil.
                </div>
                <?php }elseif(isset($_GET["danger-comment"])) {?>
                <div class="alert alert-danger alert-dismissable">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">&times;</button>
                    Approve Comment Gagal.
                </div>
                <?php }?>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                Approve Comments
            </div>

            <!-- PAGINATION TOP-->
            <div class="panel-body" style="padding:0 15px;">
                <nav aria-label="pagination">
                    <?php if(isset($total_page)) {?>
                        <ul class="pagination">
                            <?php if($total_page >= 1) {?>
                                <?php if($current_page > 1) {?>
                                    <li class="page-item">
                                    <a class="page-link" href="index.php?page=<?php echo $current_page - 1; ?>">Previous</a>
                                    </li>
                                <?php }else{?>
                                    <li class="page-item disabled">
                                    <span class="page-link">Previous</span>
                                    </li>
                                <?php }?>
                            <?php }?> 
                                <!-- numbering -->
                                <?php for($no_page = 1; $no_page <= $total_page; $no_page++) {?>
                                    <li class="page-item <?php echo $current_page == $no_page ? 'active' : ''; ?>"><a class="page-link" href="index.php?page=<?php echo $no_page; ?>"><?php echo $no_page; ?></a></li>
                                <?php }?>
                                <!-- end of numbering -->
                            <?php if($current_page < $total_page) {?>    
                                <li class="page-item">
                                <a class="page-link" href="index.php?page=<?php echo $current_page + 1; ?>">Next</a>
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
                                <th>Title</th>
                                <th>Name</th>
                                <th>Comment</th>
                                <th>Datetime</th>
                                <th>Approve</th>
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
                                        <td><?php echo $row_comment["reply"]; ?></td>
                                        <td class="center"><?php echo $row_comment["date"]; ?></td>
                                        <td class="center"><a href="index.php?comment-approve=<?php echo $row_comment['id']; ?>" class="btn btn-primary btn-xs" type="button">Approve</a></td>
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
                                    <a class="page-link" href="index.php?page=<?php echo $current_page - 1; ?>">Previous</a>
                                    </li>
                                <?php }else{?>
                                    <li class="page-item disabled">
                                    <span class="page-link">Previous</span>
                                    </li>
                                <?php }?>
                            <?php }?> 
                                <!-- numbering -->
                                <?php for($no_page = 1; $no_page <= $total_page; $no_page++) {?>
                                    <li class="page-item <?php echo $current_page == $no_page ? 'active' : ''; ?>"><a class="page-link" href="index.php?page=<?php echo $no_page; ?>"><?php echo $no_page; ?></a></li>
                                <?php }?>
                                <!-- end of numbering -->
                            <?php if($current_page < $total_page) {?>    
                                <li class="page-item">
                                <a class="page-link" href="index.php?page=<?php echo $current_page + 1; ?>">Next</a>
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