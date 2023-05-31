<?php
include("template/header.php");
include("admin/config/db.php");

// Obtener los productos del carrito
$cartQuery = $conection->prepare("SELECT cart.*, products.name, products.price FROM cart INNER JOIN products ON cart.product_id = products.id");
$cartQuery->execute();
$cartItems = $cartQuery->fetchAll(PDO::FETCH_ASSOC);

// Procesar la eliminación de un item del carrito
if (isset($_GET['remove']) && !empty($_GET['remove'])) {
    $itemId = $_GET['remove'];

    $deleteQuery = $conection->prepare("DELETE FROM cart WHERE id = :itemId");
    $deleteQuery->bindParam(':itemId', $itemId, PDO::PARAM_INT);
    $deleteQuery->execute();

    // Redirigir nuevamente a cart.php para actualizar la vista
    header("Location: cart.php");
    exit();
}

// Verificar si se generó la orden
if (isset($_GET['order_success'])) {
    $cartItems = array(); // Vaciar el carrito
}

// Limpiar el carrito (eliminar todos los elementos)
if (isset($_GET['clear_cart'])) {
    $clearQuery = $conection->prepare("DELETE FROM cart");
    $clearQuery->execute();

    // Redirigir nuevamente a cart.php para actualizar la vista
    header("Location: cart.php");
    exit();
}


?>

<div class="container">
    <h1>Carrito de Compras</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Subtotal</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <div class="container">
            <!-- ... -->

            <h2>Acciones del Carrito</h2>
            <a href="cart.php?clear_cart" class="btn btn-danger">Limpiar Carrito</a>

        </div>
        <tbody>
            <?php foreach ($cartItems as $item) { ?>
                <tr required>
                    <td>
                        <?php echo $item['name']; ?>
                    </td>
                    <td>$
                        <?php echo $item['price']; ?>
                    </td>
                    <td>
                        <?php echo $item['quantity']; ?>
                    </td>
                    <td>$
                        <?php echo $item['price'] * $item['quantity']; ?>
                    </td>
                    <td>
                        <a href="cart.php?remove=<?php echo $item['id']; ?>" class="btn btn-danger btn-sm">Eliminar</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <h2>Completa la información del pedido</h2>
    <form action="process_order.php" method="POST">
        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="address">Dirección</label>
            <input type="text" name="address" class="form-control" required>
        </div>
        <?php foreach ($cartItems as $item) { ?>
            <input type="hidden" name="products[]"
                value="<?php echo $item['id'] . '|' . $item['name'] . '|' . $item['quantity'] . '|' . $item['price']; ?>">
        <?php } ?>
        <button type="submit" class="btn btn-primary">Realizar Pedido</button>
    </form>
</div>

<?php include("template/footer.php"); ?>