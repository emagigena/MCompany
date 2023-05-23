<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location:../index.php");
} else {
    if($_SESSION['user'] == "ok"){
        $username = $_SESSION['username'];
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <?php $url = "http://" . $_SERVER['HTTP_HOST'] . "/mcompany" ?>
    <nav class="navbar navbar-expand navbar-light bg-light">
        <div class="nav navbar-nav">
            <a class="nav-item nav-link active" href="#">Admin <span class="sr-only">(current)</span></a>
            <a class="nav-item nav-link" href="<?php echo $url; ?>/admin/home.php">Home</a>
            <a class="nav-item nav-link" href="<?php echo $url; ?>/admin/section/products.php">Products</a>
            <a class="nav-item nav-link" href="<?php echo $url; ?>/admin/section/logout.php">Log Out</a>
            <a class="nav-item nav-link" href="<?php echo $url; ?>"> Go to Web Site</a>
        </div>
    </nav>
    <div class="container">
        <div class="row">