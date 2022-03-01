<?php
/** Start of Page */
require_once '_component/header.php';

/** Requirements */
require_once '_class/productList.php';

/** Code */
?>
<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
    <h1 class="display-4">Welcome</h1>
    <p class="lead">Buy Food and Drinks For Mucho Monetos</p>
</div>


<div class="row row-cols-1 row-cols-md-3 mb-3 text-center">
    <?php Product::categoryIndex() ?>
</div>


<?php
/** End of Page */
require_once '_component/footer.php';
?>

