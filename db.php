<?php
$host = 'localhost'; // o tu servidor de base de datos
$dbname = 'emprendeduros_db';
$username = 'root';
$password = "";

try {
    // Establecer la conexión y habilitar el modo de error detallado
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Modo de error detallado
   // echo "Conexión exitosa a la base de datos AQUI ES.<br>"; // Mensaje de conexión exitosa
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage()); // Mostrar mensaje detallado de error
}
?>
