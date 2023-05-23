<?php include("template/header.php"); ?>

<div class="col-md-12">
    <br /> <br />
    <div class="jumbotron">
        <h1 class="display-3">Welcome
            <?php echo $username ?>
        </h1>
        <p class="lead">This is the site to manage the products of the store</p>
        <hr class="my-2">
        <p>More info</p>
        <p class="lead">
            <a class="btn btn-primary btn-lg" href="section/products.php" role="button">Go to Products</a>
        </p>
    </div>
</div>

<?php include("template/footer.php"); ?>