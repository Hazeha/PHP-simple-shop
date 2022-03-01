<?php
require_once '../_class/db.php';


$imgDir = '_uploads';
$imgFile = $imgDir . basename($_FILES["imgFile"]["name"]);
$imageFileType = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION));

if (isset($_POST['name'])){
    if ($_POST['name'] == '' || $_POST['name'] == null){
        header('Location: ../admin.php?create_failed');
    } else {
//        $imgCheck = getimagesize($_FILES["imgFile"]["tmp_name"]);
//        if($imgCheck !== false) {
//            echo "File is an image - " . $imgCheck["mime"] . ".";
//            $uploadOk = 1;
//        } else {
//            echo "File is not an image.";
//            $uploadOk = 0;
//        }
        $imgPath = saveImage($_FILES["imgFile"]);

        (new db)->DB_PRODUCT_INSERT(
            $_POST['name'],
            $_POST['description'],
            $_POST['category'],
            $imgPath,
            $_POST['price'],
            $_POST['stock']);

        header('Location: ../admin.php?create_succes');
    }
} else {
    header('Location: ../admin.php?create_failed');
}


function saveImage($image){
    $imgName = "../_uploads/".$image["name"];
    move_uploaded_file($image["tmp_name"], $imgName);
    chmod($imgName, 777);
    return "../_uploads/".$image["name"];
}
