<?php
include("admin/config/db.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];

    // Insertar el pedido en la tabla "orders"
    $insertQuery = $conection->prepare("INSERT INTO orders (name, email, address, timestamp) VALUES (:name, :email, :address, NOW())");
    $insertQuery->bindParam(':name', $name, PDO::PARAM_STR);
    $insertQuery->bindParam(':email', $email, PDO::PARAM_STR);
    $insertQuery->bindParam(':address', $address, PDO::PARAM_STR);
    $insertQuery->execute();

    // Obtener el ID del pedido generado
    $orderId = $conection->lastInsertId();

    // Aquí puedes realizar otras acciones relacionadas con el pedido, como enviar notificaciones por correo electrónico al administrador, etc.

    // Redirigir al usuario a una página de éxito o mostrar un mensaje de confirmación
    header("Location: order_success.php?order_id=" . $orderId);
    exit();
} else {
    // Si se accede directamente a este archivo sin enviar los datos del formulario, redirigir al usuario a una página de error o a la página principal
    header("Location: index.php");
    exit();
}
?>
