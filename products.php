<?php
include("template/header.php");
include("admin/config/db.php");

// Obtener los términos de búsqueda y filtros
$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
$minPrice = isset($_GET['min_price']) ? $_GET['min_price'] : '';
$maxPrice = isset($_GET['max_price']) ? $_GET['max_price'] : '';

// Consulta base de productos
$sql = "SELECT * FROM products WHERE 1=1";

// Agregar condiciones para los filtros
$params = array();

// Filtro por nombre
if (!empty($searchTerm)) {
    $sql .= " AND name LIKE :searchTerm";
    $params[':searchTerm'] = '%' . $searchTerm . '%';
}

// Filtro por rango de precio
if (!empty($minPrice) && !empty($maxPrice)) {
    $sql .= " AND price BETWEEN :minPrice AND :maxPrice";
    $params[':minPrice'] = $minPrice;
    $params[':maxPrice'] = $maxPrice;
}

// Consulta SQL con los filtros
$sentenceSQL = $conection->prepare($sql);
$sentenceSQL->execute($params);
$productList = $sentenceSQL->fetchAll(PDO::FETCH_ASSOC);
?>

<br>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h4>Filtrar Productos </h4>
            <br />
            <form action="products.php" method="GET" class="form-inline justify-content-center">
                <div class="form-group mr-2">
                    <label for="search">Buscar por nombre</label>
                    <input type="text" name="search" class="form-control" placeholder="Buscar producto"
                        value="<?php echo $searchTerm; ?>">
                </div>
                <div class="form-group mr-2">
                    <label for="min_price">Precio mínimo</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">$</span>
                        </div>
                        <input type="number" name="min_price" class="form-control" placeholder="0"
                            value="<?php echo $minPrice; ?>">
                    </div>
                </div>
                <div class="form-group mr-2">
                    <label for="max_price">Precio máximo</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">$</span>
                        </div>
                        <input type="number" name="max_price" class="form-control" placeholder="0"
                            value="<?php echo $maxPrice; ?>">
                    </div>
                </div>
                <br />
                <button type="submit" class="btn btn-primary">Filtrar</button>
            </form>
        </div>
    </div>
    <br>
    <div class="row">
        <?php foreach ($productList as $product) { ?>
            <div class="col-md-3">
                <div class="card h-100">
                    <img class="card-img-top img-thumbnail" src="./img/<?php echo $product['image']; ?>" alt=""
                        style="height: 200px; object-fit: contain;">
                    <div class="card-body">
                        <h4 class="card-title">
                            <?php echo $product['name']; ?>
                        </h4>
                        <p class="card-text">Precio: $
                            <?php echo $product['price']; ?>
                        </p>
                        <a class="btn btn-primary" href="add_to_cart.php?product_id=<?php echo $product['id']; ?>"
                            role="button">Agregar al carrito</a>
                    </div>
                </div>
            </div>
        <?php } ?>

    </div>
</div>
<br>

<?php include("template/footer.php"); ?>