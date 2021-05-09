<?php
if(isset($_GET["post-delete"])) {
    $IDpost = $_GET["post-delete"];
    mysqli_query($connection, "DELETE FROM post WHERE id = '$IDpost'");
    header("location:index.php?post");
}
?>