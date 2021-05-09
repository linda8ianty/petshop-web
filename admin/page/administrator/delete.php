<?php
if(isset($_GET["administrator-delete"])) {
    $adminID = $_GET["administrator-delete"];
    mysqli_query($connection, "DELETE FROM admin WHERE id = '$adminID'");
    header("location:index.php?administrator");
}
?>