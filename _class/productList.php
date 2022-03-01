<?php
require_once "db.php";

class Product extends db {
    function __construct(){
        parent::__construct();
    }
    public static function getProducts(){
        $query = "select * from products order by id asc";
        $result = (new db)->DB_SELECT($query);

        if (!empty($result)){
            foreach ($result as $key=>$value){
                echo '
                <form class="col" method="post" action="?cartAction=add">
                <input type="hidden" name="pid" value="'. $result[$key]['id'] .'" />
                <input type="hidden" name="price" value="'. $result[$key]['price'] .'" />
                    <div class="card mb-4 shadow-sm">
                        <div class="card-header">
                            <h4 class="my-0 fw-normal">'. $result[$key]['name'] .'</h4>
                        </div>
                        <div class="card-body">
                        <img src="/_uploads/'. $result[$key]['imgUrl'] .'" alt="img" width="100%">
                            <h1 class="card-title pricing-card-title">'. $result[$key]['price'] .'<small class="text-muted">$</small></h1>
                            <ul class="list-unstyled mt-3 mb-4"> ';

                            $description = explode("./", filter_var($result[$key]['description']));
                            foreach ($description as $item) {
                                echo '<li>' . $item . '</li>';
                            }

                echo '
                            </ul>
                            <div class="d-flex justify-content-around">
                            <button type="submit" class="col-8 btn btn-lg btn-outline-primary">Add to Cart</button>
                            <input class="col-2 text-center" type="number" name="qty" value="1" />
                            </div>
                            
                            
                        </div>
                    </div>
                </form>';
            }
        } else {
            echo "Failed to load Products";
        }
    }
    public static function updateProduct(){
        $query = "select * from products order by price asc";
        $result = (new db)->DB_SELECT($query);
        if (isset($_GET['update_failed'])) {
            echo '<div style="color: red; font-size: 15pt">Something went wrong</div>';
        }
        if (isset($_GET['update_succes'])) {
            echo '<div style="color: green; font-size: 15pt">Updated new product</div>';
        }
        echo '<div class="row">';
        if (!empty($result)){
            foreach ($result as $key=>$value){
                echo '
                <form class="col-6" action="/_action/updateProduct.php" method="post">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-header">
                            
                            <h4>'. $result[$key]['name'] .'</h4>
                        </div>
                        <div class="card-body row">
                            <input type="hidden" class="my-0 fw-normal" value="'. $result[$key]['id'] .'" name="id">
                            
                            <label for="name">Product Name : </label>
                            <input type="text" class="my-0 fw-normal" value="'. $result[$key]['name'] .'" name="name">
                            
                            <label for="price">Price : </label>
                            <input type="number" class="pricing-card-title" value="'. $result[$key]['price'] .'" name="price">
                            
                            <label for="Description"> Description : </label>
                            <input name="description" value="' . $result[$key]['description'] . '">
                            
                            <label for="stock">Stock : </label>                      
                            <input type="number" class="card-title pricing-card-title" value="' . $result[$key]['stock'] . '" name="stock">
                            
                            <button type="submit" value="update" class="w-100 btn btn-lg btn-outline-primary">Update Product</button>
                        </div>
                    </div>
                </form>';
            }
        } else {
            echo "Failed to load Products";
        }
        echo '</div>';
    }

    public static function createProduct(){
        if (isset($_GET['create_failed'])) {
            echo '<div style="color: red; font-size: 15pt">Something went wrong</div>';
        }
        if (isset($_GET['create_succes'])) {
            echo '<div style="color: green; font-size: 15pt">Created new product</div>';
        }
        echo '
                <form class="col-6" action="/_action/addProduct.php" method="post">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-header">
                            <h4>New Product</h4>
                        </div>
                        <div class="card-body row">
                            <label for="name">Product Name : </label>
                            <input type="text" class="my-0 fw-normal" placeholder="i.e Mango Madness" name="name">
                       
                            <label for="price">Price : </label>
                            <input type="number" class="card-title pricing-card-title" placeholder="0" name="price">
                     
                            <label for="category">Category : </label>
                            <input type="text" class="card-title pricing-card-title" placeholder="Category" name="category">
           
                            <label for="description">Description : </label>
                            <input name="description">
                            
                            <label for="stock">Stock : </label>
                            <input type="number" placeholder="0" name="stock">
                            <input type="file" name="imgFile" id="imgFile">
                            <button type="submit" value="create" class="w-100 btn btn-lg btn-outline-primary">Create Product</button>
                        </div>
                    </div>
                </form>

                ';
    }

    public static function categoryIndex(){
        $query = "select * from categories";
        $result = (new db)->DB_SELECT($query);
        foreach ($result as $key => $value){
            $category = $result[$key]['name'];

            $newQuery = "select * from products where category like '$category'";
            $newResult = (new db)->DB_SELECT($newQuery);

            echo '<div class="dropdown">
                  <button class="btn btn-secondary dropdown-toggle" type="button">
                    '. $category .'
                  </button>
                  <div class="dropdown-menu">';

            foreach ($newResult as $k => $v){
                echo '<a class="dropdown-item" href="product.php?action='. $newResult[$k]['id'] .'">'. $newResult[$k]['name'] .'</a>';
            }
            echo '</div>
              </div>';
        }
    }

    public static function cartIndex(){
        $pids = array();
        if (isset($_SESSION['cart'])){
            foreach($_SESSION['cart'] as $item){
                array_push($pids, $item['pid']);
            }

            if (count($_SESSION['cart'])>0){
                $query = 'select * from products where id in ('.implode(',',$pids).')';
                $result = (new db)->runQuery($query);
                foreach ($result as $i => $v) {
                    $pQty = '';
                    $pTotalPrice = '';
                    if (!empty($_SESSION['cart'][$i]['qty'])){
                        $pQty = $_SESSION['cart'][$i]['qty'];
                        $pTotalPrice = $result[$i]['price'] * $_SESSION['cart'][$i]['qty'];
                    }

                    echo '
                            <div class="row main align-items-center">
                                <div class="col-2">
                                    <img class="img-fluid" src="/_uploads/'. $result[$i]['imgUrl'] .'">
                                </div>
                                <div class="col">
                                    <div class="row text-muted">' . $result[$i]['category'] . '</div>
                                    <div class="row">' . $result[$i]['name'] . '</div>
                                </div>
                                <div class="col">
                                <h5 class="">' . $pQty .' pcs.</h5>
                                </div>
                                <div class="col">' . $pTotalPrice . '$<span class="close">
                                <form action="?cartAction=remove" method="post">
                                    <input type="hidden" name="pid" value="'. $result[$i]['id'] .'">
                                    <button>&#10005;</button>                               
                                </form>
                                
                                </span></div>
                            </div>
                            ';
                }
            }
        }
    }
}
