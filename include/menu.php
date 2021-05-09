<a href="index.php" id="logo"><img src="images/logo.gif" width="310" height="114" alt="" title=""/></a>
<ul class="navigation">
    <?php if(isset($_GET['about'])) {?>
        <li><a href="index.php?home">Home</a></li>
        <li class="active"><a href="index.php?about">About us</a></li>
        <li><a href="index.php?blog">Blog</a></li>
        <li><a href="index.php?contact">Contact us</a></li>
        <div class="sign float-right"><li><a href="admin/index.php?login" style="background:none">Sign In/Up</a></li></div>        
    <?php } elseif(isset($_GET['blog']) || isset($_GET['detail'])) {?>
        <li><a href="index.php?home">Home</a></li>
        <li><a href="index.php?about">About us</a></li>
        <li class="active"><a href="index.php?blog">Blog</a></li>
        <li><a href="index.php?contact">Contact us</a></li>
        <div class="sign float-right"><li><a href="admin/index.php?login" style="background:none">Sign In/Up</a></li></div>
    <?php } elseif(isset($_GET['contact'])) {?>
        <li><a href="index.php?home">Home</a></li>
        <li><a href="index.php?about">About us</a></li>
        <li><a href="index.php?blog">Blog</a></li>
        <li class="active"><a href="index.php?contact">Contact us</a></li>
        <div class="sign float-right"><li><a href="admin/index.php?login" style="background:none">Sign In/Up</a></li></div>
    <?php }else{?>
    <li class="active"><a href="index.php?home">Home</a></li>
    <li><a href="index.php?about">About us</a></li>
    <li><a href="index.php?blog">Blog</a></li>
    <li><a href="index.php?contact">Contact us</a></li>
    <div class="sign float-right"><li><a href="admin/index.php?login" style="background:none">Sign In/Up</a></li></div>
    <?php }?>
</ul>
