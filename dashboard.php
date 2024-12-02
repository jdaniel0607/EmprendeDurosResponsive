<?php
// Iniciar la sesión
session_start();

// Comprobar si el usuario ha iniciado sesión, si no redirigir al login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirige al login si no hay sesión activa
    exit;
}

// Si el usuario hace clic en "Cerrar sesión"
if (isset($_POST['logout'])) {
    // Eliminar todos los datos de la sesión
    session_unset();
    
    // Destruir la sesión
    session_destroy();
    
    // Redirigir al índice
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido a Emprendeduros</title>
    <link rel="stylesheet" href="estilos.css">
    <link rel="stylesheet" href="estilos-generales.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container">
    <h1>Bienvenido, <?php echo $_SESSION['user_email']; ?>!</h1> <!-- Muestra el email del usuario -->
    
    <form method="POST">
        <button type="submit" name="logout" class="btn btn-danger">Cerrar sesión</button>
    </form>

</body>
</html>
