<?php
$dbHost = "localhost:3307";
$dbUser = "root";
$dbPass = "";
$dbName = "db_bobshop";
$conn = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);
if (isset($_POST['submit'])){
    $cred_name = $_POST['name'];
    $cred_email = $_POST['email'];
    $cred_phone = $_POST['phone'];
    $cred_address = $_POST['address'] . ' ' . $_POST['postcode'] . $_POST['country'];
    $cred_password = $_POST['password'];
    $cred_password2 = $_POST['password2'];


    $nameCheck = preg_match('/^[a-zæøå\s]{6,50}$/i', $cred_name);
    $emailCheck = preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i', $cred_email);
    $phoneCheck = preg_match('/^[0-9]{8}$/', $cred_phone);
    $addressCheck = preg_match('/^[0-9A-ZÆØÅa-zæøå\s\.\,\-]+$/', $cred_address);
    $passCheck = preg_match('/^[\da-zæøåA-ZÆØÅ\.\-\/0-9]+$/', $cred_password);

    if (!$nameCheck || !$emailCheck || !$phoneCheck || !$addressCheck || !$passCheck){
        header('Location: ../register.php?error=wrongsomething');
        exit();
    }

    if ($cred_password !== $cred_password2){
        header('Location: ../register.php?error=wrongpass');
        exit();
    }

    $stmt = $conn->prepare("insert into users (name, email, phone, address, password) values (?, ?, ?, ?, ?)");
    $stmt->bind_param(
        "sssss",
        $cred_name,
        $cred_email,
        $cred_phone,
        $cred_address,
        $cred_password);
    $stmt->execute();


    header('Location: ../register.php?succes');

} else {
    header('Location: /');
    exit();
}


