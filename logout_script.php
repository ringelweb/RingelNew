<?php
session_start();
if (!isset($_SESSION['user_name'])){
    header('location: index.php');
}
if (!isset($_SESSION['buyer_user_name'])){
    header('location: index.php');
}
session_destroy();
header('location: index.php?msg=Logged Out Successfully');
?>