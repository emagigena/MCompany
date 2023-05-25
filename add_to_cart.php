<?php
include("admin/config/db.php");

// Verificar si se ha enviado un ID de producto válido
if (isset($_GET['product_id']) && !empty($_GET['product_id'])) {
    $productId = $_GET['product_id'];

    // Verificar si el producto existe en la base de datos
    $productQuery = $conection->prepare("SELECT * FROM products WHERE id = :productId");
    $productQuery->bindParam(':productId', $productId, PDO::PARAM_INT);
    $productQuery->execute();
    $product = $productQuery->fetch(PDO::FETCH_ASSOC);

    if ($product) {
        // Obtener la cantidad deseada del producto (puedes cambiar esto según tu lógica)
        $quantity = 1;

        // Insertar el producto en la tabla "cart"
        $insertQuery = $conection->prepare("INSERT INTO cart (product_id, quantity, timestamp) VALUES (:productId, :quantity, NOW())");
        $insertQuery->bindParam(':productId', $productId, PDO::PARAM_INT);
        $insertQuery->bindParam(':quantity', $quantity, PDO::PARAM_INT);
        $insertQuery->execute();

        // Redirigir al usuario al carrito de compras
        header("Location: cart.php");
        exit();
    }
}

// Si no se cumplen las condiciones anteriores, redirigir al usuario a una página de error o a la página principal
header("Location: index.php");
exit();
?>
