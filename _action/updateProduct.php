<?php
require_once '../_class/db.php';
if (isset($_POST['id'])){
    if ($_POST['id'] == '' || $_POST['id'] == null){
        header('Location: ../admin.php?update_failed');
    } else {
        (new db)->DB_PRODUCT_UPDATE(
            $_POST['name'],
            $_POST['description'],
            $_POST['category'],
            $_POST['price'],
            $_POST['stock'],
            $_POST['id']);

        header('Location: ../admin.php?update_succes');
    }
} else {
    header('Location: ../admin.php?update_failed');
}
