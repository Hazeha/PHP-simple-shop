<?php
/** Start of Page */
require_once '_component/header.php';
require_once "_class/productList.php";
?>
<?php require_once 'cart.php'?>

<div class="row row-cols-1 row-cols-md-3 mb-3 text-center">
    <?php Product::getProducts() ?>
</div>

<?php
/** End of Page */
require_once '_component/footer.php';
?>
