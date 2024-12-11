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
  <!-- Estilos CSS -->
  <link rel="stylesheet" href="estilos.css">
  <!-- Estilos generales CSS -->
  <link rel="stylesheet" href="estilos-generales.css">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://kit.fontawesome.com/f7302fb63d.js" crossorigin="anonymous"></script>

</head>

<!--comienzo header-->
<header class="container d-inline p-1 justify-content-center">
  <nav class="navbar navbar-expand-lg w-100">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php">
        <img src="images/logo-emprendedores.png">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse align-items-end flex-column" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="login.php">Iniciar sesión</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="registro.php">Registrarse</a>
          </li>
          <li class="nav-item button-header p-0 m-0">
            <a class="nav-link a-button-header" aria-current="page" href="consulta.php">Consultar emprendedores</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</header>
<!--fin del header-->

<!--inicio body-->


<body class="container mt-5">
  <h1>Bienvenido, <?php echo $usuario['nombre'] . ' ' . $usuario['apellido']; ?>!</h1>

  <div class="mb-4">
    <h2 class="mb-1">Detalles del usuario</h2>
    <hr class="dashed">
    <p><strong>Correo:</strong> <?php echo $usuario['email']; ?></p>
    <hr class="dashed">
    <p><strong>Documento:</strong> <?php echo $usuario['documento']; ?></p>
    <hr class="dashed">
    <p><strong>Teléfono:</strong> <?php echo $usuario['telefono']; ?></p>
    <hr class="dashed">
    <p><strong>Nombre de la Empresa:</strong> <?php echo $usuario['nombre_empresa']; ?></p>
    <hr class="dashed">
    <p><strong>Ciudad de la Empresa:</strong> <?php echo $usuario['ciudad']; ?></p>
    <hr class="dashed">
    <p><strong>Departamento:</strong> <?php echo $usuario['departamento']; ?></p>
    <hr class="dashed">
    <p><strong>Descripción de la Empresa:</strong> <?php echo $usuario['descripcion']; ?></p>
    <hr class="dashed">
  </div>

  <!-- Aqui borré actualizar -->

  <!-- Hasta aquí iba actualizar -->
  <div class="">

    <a href="actualizar.php" class="btn btn-warning p-3 font-bold">Editar<i class="fa-regular fa-pen-to-square p-1"></i></a>

    <form method="POST">
      <button type="submit" name="logout" class="btn btn-danger">Cerrar sesión</button>
    </form>

  </div>
  <!-- Botón para Cerrar sesión -->

  <?php

  if (!empty($_POST["btnmodificar"])) {
    header("Location: actualizar.php");
  }

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
<!--fin body-->
<!--inicio footer-->
<footer class="bd-footer py-2 py-md-2 mt-5 bg-body-tertiary">
  <div class="container py-2 py-md-5 px-2 px-md-3 text-body-secondary">
    <div class="row d-flex justify-content-around">
      <div class="col-lg-4 col-mb-1 mb-3 d-flex flex-column align-items-center">
        <a>
          <img src="images/logo-emprendedores.png">
        </a>
      </div>
      <div class="col-6 col-lg-2 mb-3">
        <ul class="list-unstyled">
          <li class="mb-2"><a href="login.php">Inciar sesión</a></li>
          <li class="mb-2"><a href="registro.php">Registro</a></li>
          <li class="mb-2"><a href="terminos-condiciones.php">Términos y condiciones</a></li>
        </ul>
      </div>
      <div class="col-12 col-lg-4 mb-3 d-flex flex-column align-items-center">
        <a class="col" href="#" onclick="mostrarPopup()">
          <button>
            Consultar emprendedores
          </button>
        </a>
      </div>
    </div>
  </div>
  <div class="d-flex align-content-center justify-content-center">
    <p>Creat by Emprendeduros Talento-tech-2024</p>
  </div>
</footer>
<!--fin footer-->

</html>