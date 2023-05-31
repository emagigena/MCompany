<?php
include("admin/config/db.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $products = $_POST['products'];
    $productDetails = array();

    foreach ($products as $product) {
        // Separar el ID, el nombre, la cantidad y el precio del producto
        $productData = explode('|', $product);
        $productId = $productData[0];
        $productName = $productData[1];
        $productQuantity = $productData[2];
        $productPrice = $productData[3];

        // Agregar los detalles del producto al array
        $productDetails[] = array(
            'id' => $productId,
            'name' => $productName,
            'cantidad' => $productQuantity,
            'precio' => $productPrice,
        );
    }

    // Convertir el array de detalles del producto a JSON
    $productDetailsJSON = json_encode($productDetails);

    // Insertar el pedido en la tabla "orders"
    $insertQuery = $conection->prepare("INSERT INTO orders (name, email, address, timestamp, products) VALUES (:name, :email, :address, NOW(), :productDetails)");
    $insertQuery->bindParam(':name', $name, PDO::PARAM_STR);
    $insertQuery->bindParam(':email', $email, PDO::PARAM_STR);
    $insertQuery->bindParam(':address', $address, PDO::PARAM_STR);
    $insertQuery->bindParam(':productDetails', $productDetailsJSON, PDO::PARAM_STR);
    $insertQuery->execute();

    // Obtener el ID del pedido generado
    $orderId = $conection->lastInsertId();

    // Aquí puedes realizar otras acciones relacionadas con el pedido, como enviar notificaciones por correo electrónico al administrador, etc.

    // Redirigir al usuario a una página de éxito o mostrar un mensaje de confirmación
    // Redirigir al usuario a la página de éxito con el ID del pedido
    header("Location: order_success.php?name=" . urlencode($name) . "&email=" . urlencode($email) . "&address=" . urlencode($address) . "&products=" . urlencode($productDetailsJSON));
    exit();
} else {
    // Si se accede directamente a este archivo sin enviar los datos del formulario, redirigir al usuario a una página de error o a la página principal
    header("Location: index.php");
    exit();
}
?>