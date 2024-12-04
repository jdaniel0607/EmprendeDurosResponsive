<?php
// Iniciar la sesión
session_start();

// Comprobar si el usuario ha iniciado sesión, si no redirigir al login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirige al login si no hay sesión activa
    exit;
}

// Conectar a la base de datos
require 'db.php';  // Asegúrate de que el archivo de conexión esté correctamente referenciado

// Obtener el ID del usuario desde la sesión
$user_id = $_SESSION['user_id'];

// Consultar los datos del usuario
$sql = "SELECT nombre, apellido, documento, telefono, email, nombre_empresa, sector, descripcion, departamento, ciudad FROM usuarios WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(1, $user_id, PDO::PARAM_INT);
$stmt->execute();

// Verificar si se encontraron resultados
if ($stmt->rowCount() > 0) {
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC); // Obtener los datos del usuario
} else {
    echo "No se encontraron datos del usuario.";
    exit;
}

// Procesar la actualización de los datos
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['actualizar'])) {
    // Obtener los datos del formulario
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    $nombre_empresa = $_POST['nombre_empresa'];
   
    $descripcion = $_POST['descripcion'];
    $departamento = $_POST['departamento'];
    $ciudad = $_POST['ciudad'];

    // Actualizar los datos en la base de datos
    $sql_update = "UPDATE usuarios SET nombre = ?, apellido = ?, telefono = ?, email = ?, nombre_empresa = ?, sector = ?, descripcion = ?, departamento = ?, ciudad = ? WHERE id = ?";
    $stmt_update = $pdo->prepare($sql_update);
    $stmt_update->bindParam(1, $nombre);
    $stmt_update->bindParam(2, $apellido);
    $stmt_update->bindParam(3, $telefono);
    $stmt_update->bindParam(4, $email);
    $stmt_update->bindParam(5, $nombre_empresa);
    $stmt_update->bindParam(6, $sector);
    $stmt_update->bindParam(7, $descripcion);
    $stmt_update->bindParam(8, $departamento);
    $stmt_update->bindParam(9, $ciudad);
    $stmt_update->bindParam(10, $user_id, PDO::PARAM_INT);
    $stmt_update->execute();

    echo "Datos actualizados correctamente!";
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
    <script src="script.js"></script>
</head>
<body class="container mt-5">
    <h1>Bienvenido, <?php echo $usuario['nombre'] . ' ' . $usuario['apellido']; ?>!</h1>
    
    <div class="card p-4">
        <h3>Detalles del Usuario</h3>
        <p><strong>Correo:</strong> <?php echo $usuario['email']; ?></p>
        <p><strong>Documento:</strong> <?php echo $usuario['documento']; ?></p>
        <p><strong>Teléfono:</strong> <?php echo $usuario['telefono']; ?></p>
        <p><strong>Nombre de la Empresa:</strong> <?php echo $usuario['nombre_empresa']; ?></p>
        <p><strong>Ciudad de la Empresa:</strong> <?php echo $usuario['ciudad']; ?></p>
        <p><strong>Departamento:</strong> <?php echo $usuario['departamento']; ?></p>
       
        <p><strong>Descripción de la Empresa:</strong> <?php echo $usuario['descripcion']; ?></p>
    </div>

    <h3>Actualizar Datos</h3>
    <form id="formActualizarDatos" method="POST">
        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre" class="form-control" value="<?php echo $usuario['nombre']; ?>">
        </div>
        <div class="form-group">
            <label for="apellido">Apellido:</label>
            <input type="text" name="apellido" id="apellido" class="form-control" value="<?php echo $usuario['apellido']; ?>">
        </div>
        <div class="form-group">
            <label for="telefono">Teléfono:</label>
            <input type="text" name="telefono" id="telefono" class="form-control" value="<?php echo $usuario['telefono']; ?>">
        </div>
        <div class="form-group">
            <label for="email">Correo electrónico:</label>
            <input type="email" name="email" id="email" class="form-control" value="<?php echo $usuario['email']; ?>">
        </div>
        <div class="form-group">
            <label for="nombre_empresa">Nombre de la Empresa:</label>
            <input type="text" name="nombre_empresa" id="nombre_empresa" class="form-control" value="<?php echo $usuario['nombre_empresa']; ?>">
        </div>
        
        <div class="form-group">
            <label for="descripcion">Descripción de la Empresa:</label>
            <textarea name="descripcion" id="descripcion" class="form-control"><?php echo $usuario['descripcion']; ?></textarea>
        </div>
        <div class="form-group">
            <label for="departamento">Departamento:</label>
            <input type="text" name="departamento" id="departamento" class="form-control" value="<?php echo $usuario['departamento']; ?>">
        </div>
        <div class="form-group">
            <label for="ciudad">Ciudad:</label>
            <input type="text" name="ciudad" id="ciudad" class="form-control" value="<?php echo $usuario['ciudad']; ?>">
        </div>
        <button type="submit" name="actualizar" class="btn btn-primary" id="btnActualizar">Actualizar Datos</button>
    </form>

    <!-- Botón para Cerrar sesión -->
    <form method="POST">
        <button type="submit" name="logout" class="btn btn-danger">Cerrar sesión</button>
    </form>

    <?php
    // Si se ha presionado el botón de "Cerrar sesión"
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

</body>
</html>