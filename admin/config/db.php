<?php
$host = "localhost";
$bd = "mcompany";
$user = "root";
$password = "";

try {
    $conection = new PDO("mysql:host=$host;dbname=$bd;", $user, $password);
    if ($conection) {
        //echo "Connection succefully ";
    }
} catch (Exception $ex) {
    echo $ex->getMessage();
}

?>