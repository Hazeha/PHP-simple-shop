<?php
if (session_status() === PHP_SESSION_NONE) session_start();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bobs Shop</title>
    <link rel="stylesheet" href="/main.css">

    <!--       Font Awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <!--        Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>
<body>

<header class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-body border-bottom shadow-sm">
    <p class="h5 my-0 me-md-auto fw-normal">Drink Shop</p>
    <nav class="my-2 my-md-0 me-md-3">
        <a class="p-2 text-dark" href="/">Home</a>
        <a class="p-2 text-dark" href="product.php">Products</a>
        <?php
        if(isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == true){
            echo '
                <a class="p-2 text-dark" href="admin.php">Admin</a>
            ';
        }
        ?>
        <?php
        if(!isset($_SESSION['user'])){
            echo '<a href="login.php">Login</a>';
        } else if (isset($_SESSION['user']) ) {
            echo '<a href="../_component/logout.php">Logout</a>';
        }
        ?>
    </nav>
</header>
<main class="container">
