<?php
// Incluir la conexión a la base de datos
include('db.php');

// Iniciar la sesión
session_start();

// Verificar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Recoger los datos del formulario
  $email = $_POST['email'];
  $password = $_POST['password'];

  // Validar si los campos no están vacíos
  if (empty($email) || empty($password)) {
    echo "Por favor, rellena todos los campos.";
    exit;
  }

  // Buscar el usuario en la base de datos
  $query = "SELECT * FROM usuarios WHERE email = :email";
  $stmt = $pdo->prepare($query);
  $stmt->bindParam(':email', $email);
  $stmt->execute();

  // Verificar si el usuario existe
  if ($stmt->rowCount() > 0) {
    // Obtener los datos del usuario
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verificar la contraseña (usando password_verify si la contraseña está cifrada)
    if (password_verify($password, $user['clave'])) { // Asegúrate de que la columna en la DB sea 'clave'
      // Inicio de sesión exitoso, redirigir al usuario
      $_SESSION['user_id'] = $user['id'];
      $_SESSION['user_email'] = $user['email'];
      header("Location: dashboard.php"); // Redirigir al panel de usuario
      exit;
    } else {
      $_SESSION['error'] = "Contraseña incorrecta.";
      header("Location: login.php"); // Redirigir de vuelta a login
      exit;
    }
  } else {
    $_SESSION['error'] = "El usuario no existe.";
    header("Location: login.php"); // Redirigir de vuelta a login
    exit;
  }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Emprendeduros Iniciar sesión</title>
  <!-- Estilos CSS -->
  <link rel="stylesheet" href="estilos.css">
  <!-- Estilos generales CSS -->
  <link rel="stylesheet" href="estilos-generales.css">
  <!-- fuente google -->
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
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
            <a class="nav-link a-button-header" href="#" onclick="mostrarPopup()">Consultar emprendedores</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</header>
<!--fin del header-->
<!--inicio body-->

<body class="container">
  <div class="container w-100 my-4 p-3 justify-content-center align-items-center caja-general vstack gap-3">
    <div class="row w-100 my-2">
      <h1>Inciar sesión</h1>
    </div>

    <!-- Mostrar mensaje de error si existe -->
    <?php
    if (isset($_SESSION['error'])) {
      echo '<div class="alert alert-danger" role="alert">' . $_SESSION['error'] . '</div>';
      unset($_SESSION['error']); // Limpiar el mensaje de error después de mostrarlo
    }
    ?>

    <form class="row col-md-10 g-3 bg-body p-4 rounded-4 justify-content-center align-items-center" action="login.php" method="POST">
      <div class="col-md-8">
        <label for="exampleFormControlInput1" class="form-label">Correo electrónico</label>
        <input type="email" class="form-control" placeholder="correo@ejemplo.com" id="exampleFormControlInput1" name="email"
          required>
      </div>
      <div class="col-md-8">
        <label for="inputPassword5" class="form-label">Contraseña</label>
        <input type="password" class="form-control" aria-describedby="passwordHelpBlock" id="inputPassword5" name="password" placeholder="Ingrea tu contraseña" required>
        <p>Su contraseña debe tener entre 8 y 20 caracteres, contener letras y números, y no debe contenerespacios, caracteres especiales ni emojis.
        </p>
      </div>
      <div class="col-md-8 d-flex flex-column align-items-center mt-3 align-text-center">
        <button type="submit" class="w-100 mb-3 rounded-4" id="boton-ingresar" name="boton-ingresar">Ingresar</button>
        <button type="submit" class="w-100 rounded-4 butto2-login">Cancelar</button>
      </div>
    </form>
  </div>
  <!-- Modal Bootstrap -->
  <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="loginModalLabel">Acceso Requerido</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Debes iniciar sesión para consultar emprendedores.
          <br>
          <a href="login.php">Haz clic aquí para iniciar sesión.</a>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Bootstrap JavaScript -->
  <script>
    function mostrarPopup() {
      // Muestra el modal utilizando Bootstrap
      var myModal = new bootstrap.Modal(document.getElementById('loginModal'));
      myModal.show();
    }
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
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