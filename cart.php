<?php
require_once '_class/db.php';
$conn = new db();

if (isset($_GET['cartAction'])){
    switch ($_GET['cartAction']){
        case 'add':
            $cartItem = array(
                'pid' => $_POST['pid'],
                'qty' => $_POST['qty'],
                'price' => $_POST['price']
            );
            if (isset($_SESSION['cart'])){
                array_push($_SESSION['cart'], $cartItem);
            } else {
                $_SESSION['cart'] = array($cartItem);
            }
        break;

        case 'remove':
            function findProduct(){
                foreach ($_SESSION['cart'] as $pKey => $item){
                    if ($item['pid'] = $_POST['pid']){
                        return $pKey;
                    }
                }
            }
            if (isset($_SESSION['cart'])){
                $pKey = findProduct();
                if (isset($pKey)){
                    unset($_SESSION['cart'][$pKey]);
                }
            }
        break;

        case 'null':
            unset($_SESSION["cart"]);
            $_SESSION['cart'] = null;
            $_SESSION['totalPrice'] = null;
        break;
    }
    if ($_SESSION['cart']){
        $_SESSION['totalPrice'] = array_sum(array_column($_SESSION['cart'],'price'));
    } else {
        $_SESSION['totalPrice'] = 0;
    }
}

?>
<div class="card mb-10" id="shopping-cart">
    <div class="row">
        <div class="col-md-8 cart">
            <div class="title">
                <h4><b>Shopping Cart</b></h4>
            </div>

            <?php Product::cartIndex(); ?>

            <div class="back-to-shop"><a href="?cartAction=null" class="btn">Empty Cart</a></div>

            </div>
            <div class="col-md-4 summary">
                <div>
                    <h5><b>Summary</b></h5>
                </div>
                <hr>
                <div class="row">
                    <div class="col" style="padding-left:20px;">ITEMS</div>
                    <div class="col text-right"><?php
                        if (!empty($_SESSION['cart'])){
                            echo sizeof($_SESSION['cart']);
                        }  else echo '0' ?></div>
                </div>

                <div class="row" style="border-top: 1px solid rgba(0,0,0,.1); padding: 2vh 10px;">
                    <div class="col">TOTAL PRICE</div>
                    <div class="col text-right"><?php if (isset($_SESSION['totalPrice'])) echo $_SESSION['totalPrice']; else echo 0 ?>$</div>
                </div>
            </div>
        </div>
    </div>
</div>
