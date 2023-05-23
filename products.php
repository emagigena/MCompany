<?php include("template/header.php"); ?>
<?php include("admin/config/db.php");
$sentenceSQL = $conection->prepare("SELECT * FROM products");
$sentenceSQL->execute();
$productList = $sentenceSQL->fetchAll(PDO::FETCH_ASSOC); ?>

<?php foreach($productList as $product) { ?>

<div class="col-md-3">
    <div class="card">
        <img class="card-img-top img-thumbnail" src="./img/<?php echo $product['image']; ?>" width="200" alt="">
        <div class="card-body">
            <h4 class="card-title"><?php echo $product['name']; ?></h4>
            <a name="" class="btn btn-primary" href="#" role="button">show more</a>
        </div>
    </div>
</div>
<?php } 
?>

<?php include("template/footer.php"); ?>