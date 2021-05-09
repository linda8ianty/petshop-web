<?php $option = isset($_POST["search-option"]);?>

<form action="index.php?search" method="post">
    <div class="search">
        <input type="text" name="find" placeholder="Find" style="box-sizing: unset;"><button name="search">&nbsp;</button>
        <?php if($option == "articles" || isset($_GET["pagearticle"])) {?>
            <label for="articles"><input type="radio" id="articles" name="search-option" value="articles" checked> Articles</label>
            <label for="products"><input type="radio" id="products" name="search-option" value="petmart_products"> PetMart Products</label>
        <?php }else{?>
            <label for="articles"><input type="radio" id="articles" name="search-option" value="articles"> Articles</label>
            <label for="products"><input type="radio" id="products" name="search-option" value="petmart_products" checked> PetMart Products</label>
        <?php }?>
    </div>
</form>