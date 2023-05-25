<?php
include("template/header.php");

// Verificar si se ha enviado el formulario de pedido
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Procesar el pedido y guardar los datos en la base de datos
    // ...

    // Generar el documento con la vista previa del pedido
    // ...

    // Mostrar mensaje de confirmación
    echo "<div class='container'>";
    echo "<h1>¡Orden generada correctamente!</h1>";
    echo "<p>Alguien de nuestra compañía se comunicará contigo pronto utilizando los datos que proporcionaste en tu pedido.</p>";
    echo "<p>Puedes descargar el documento con la vista previa de tu pedido a continuación:</p>";
    echo "<a href='ruta_al_documento' class='btn btn-primary'>Descargar Vista Previa del Pedido</a>";
    echo "</div>";
} else {
    // Si se accede a esta página sin enviar el formulario, redirigir al usuario a la página de inicio
    header("Location: index.php");
    exit();
}

include("template/footer.php");
?>