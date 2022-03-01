<?php
/** Start of Page */
require_once '_component/header.php';
require_once '_class/productList.php';
?>
<h1>Admin Area </h1>

<hr>
<h3>Add New Products</h3>
<?php Product::createProduct(); ?>
<hr>
<h3>Edit Products</h3>
<?php Product::updateProduct(); ?>


<?php
/** End of Page */
require_once '_component/footer.php';
?>
