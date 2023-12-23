<?php
session_start();
include '../config/connect.php';
// Apabila user belum login
if (empty($_SESSION['email']) AND empty($_SESSION['password'])){
  $_SESSION['error'] = "Please login!";
  header('location:../index.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>E-Learning PT. Southern of Sumatera</title>
    <?php include 'link_assets.php'; ?>

</head>

<body>
    <div id="app">
        <div id="main" class="layout-horizontal">
            <?php include 'navbar.php'; ?>
            <div class="content-wrapper container-fluid">
                <?php include '../function.php'; ?>
            </div>
            <?php include 'footer_user.php'; ?>
        </div>
    </div>
    <?php include 'link_script.php'; ?>
</body>

</html>