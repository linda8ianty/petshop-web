<?php
ob_start();
session_start();
include "include/config.php";
include "function/function.php";
include "include/head.php";

date_default_timezone_set('Asia/Jakarta');
?>
<body>
    <div id="header">
  		<?php include "include/menu.php"; ?>
    </div>
    <div id="body">
        <?php if(isset($_GET["about"]) || isset($_GET["blog"]) || isset($_GET["detail"]) || isset($_GET["contact"]) || isset($_GET["search"]) || isset($_GET["pagearticle"]) || isset($_GET["pagemart"])){
        } else {?>
        <div class="banner">&nbsp;</div>
        <?php }?>
        <div id="content">
            <div class="content">
                <?php if(isset($_GET["about"])) {
                    include "include/about.php";
                } elseif(isset($_GET["blog"])) {
                    include "include/blog.php"; 
                } elseif(isset($_GET["detail"])) {
                    include "include/detail.php";
                } elseif(isset($_GET["contact"])) {
                    include "include/contact.php";
                } elseif(isset($_GET["search"]) || isset($_GET["pagearticle"]) || isset($_GET["pagemart"])) {
                    include "include/page-search.php";
                }else{
                    include "include/home-content.php";
                } ?>
            </div>
            <div id="sidebar">
                <br>
                <?php include "include/search.php"; ?>
                <?php if(isset($_GET["about"])) {
                    include "include/featured.php";
                } elseif(isset($_GET["blog"]) || isset($_GET["detail"]) ) {
                    include "include/archive.php";
                } elseif(isset($_GET["contact"])) {
                    include "include/social-media.php";
                } ?>
                
                <?php include "include/navigation.php"; ?>
            </div>
        </div>
        <div class="featured">
            <ul>
                <li><a href="index.html"><img src="images/organic-and-chemical-free.jpg" width="300" height="90" alt="Pet Shop" title="Pet Shop" ></a></li>
                <li><a href="index.html"><img src="images/good-food.jpg" width="300" height="90" alt="Pet Shop" title="Pet Shop" ></a></li>
                <li class="last"><a href="index.html"><img src="images/pet-grooming.jpg" width="300" height="90" alt="Pet Shop" title="Pet Shop" ></a></li>
            </ul>
        </div>
    </div>
    <div id="footer">
        <?php include "include/footer.php"; ?>
    </div>
    <!-- bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    
</body>
</html>
<?php
mysqli_close($connection);
ob_end_flush();
?>