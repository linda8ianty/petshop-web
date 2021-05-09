<?php
if(isset($_GET["category-delete"])) {
    $IDcategory = $_GET["category-delete"];
    mysqli_query($connection, "DELETE FROM category WHERE id ='$IDcategory'");
    header("location:index.php?category");
}
?>