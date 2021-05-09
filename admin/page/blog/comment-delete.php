<?php
if(isset($_GET["comment-delete"])) {
    $IDcomment = $_GET["comment-delete"];
    mysqli_query($connection, "DELETE FROM comment WHERE id = '$IDcomment'");
    header("location:index.php?comment");
}
?>