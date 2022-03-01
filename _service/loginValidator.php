<?php
require_once '../_component/header.php';
require_once '../_class/db.php';

$dbHost = "localhost:3307";
$dbUser = "bobshop";
$dbPass = "bob123";
$dbName = "db_bobshop";
$conn = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);

$cred_user = $_POST['email'];
$cred_pass = $_POST['password'];

try{
    $result = $conn->query("select * from users where email ='". $cred_user ."' and password = '". $cred_pass ."' ");
    $user = mysqli_fetch_assoc($result);
    $_SESSION['user'] = $user['email'];
    $_SESSION['isAdmin'] = $user['isAdmin'];
    header('Location: /');
}
catch (Exception $e){
    echo 'failed';
}

