<?php
// Obtener los datos del pedido de la URL
$name = $_GET['name'];
$email = $_GET['email'];
$address = $_GET['address'];
$products = json_decode($_GET['products'], true);

// Crear un array con los datos del pedido
$pedido = array(
    'name' => $name,
    'email' => $email,
    'address' => $address,
    'products' => $products,

    // Agregar más campos del pedido según sea necesario
);

// Convertir el array a formato JSON
$jsonPedido = json_encode($pedido, JSON_PRETTY_PRINT);
// Guardar el archivo JSON en una ubicación específica
$archivoJSON = 'orders/order-' . uniqid() . '.json'; // Genera un nombre de archivo único usando uniqid()
file_put_contents($archivoJSON, $jsonPedido);

// Guardar el nombre del archivo JSON en la base de datos
// ...

// Mostrar mensaje al usuario
echo "<div class='container'>";
echo "<h1>¡Orden generada correctamente!</h1>";
echo "<p>Alguien de nuestra compañía se comunicará contigo pronto utilizando los datos que proporcionaste en tu pedido.</p>";
echo "<p>Puedes visualizar los detalles de tu pedido en el siguiente enlace:</p>";
echo "<a href='$archivoJSON' class='btn btn-primary'>Ver Detalles del Pedido</a>";
echo "</div>";
?>
