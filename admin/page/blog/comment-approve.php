<?php
if(isset($_GET["comment-approve"])) {
    $IDcomment = $_GET["comment-approve"];
    mysqli_query($connection, "UPDATE comment SET status = '1' WHERE id = '$IDcomment'");
    header("location:index.php?success-comment");
}else{
    header("location:index.php?danger-comment");
}
?>