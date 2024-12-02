<?php
// Incluir la conexión a la base de datos
include('db.php');

// Iniciar la sesión para usar variables de sesión
session_start();

// Comprobar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger los datos del formulario
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];    
    $documento = $_POST['documento'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    $nombre_empresa = $_POST['nombre_empresa'];   
    $sector = $_POST['sector'];
    $descripcion = $_POST['descripcion'];
    $departamento = $_POST['departamento'];
    $ciudad = $_POST['ciudad'];     
    $clave = $_POST['clave']; // 'clave' es el nombre del campo en el formulario
   

    // Validar que los campos no estén vacíos
    if (empty($nombre) || empty($apellido) || empty($documento) || empty($telefono) || empty($email) || empty($nombre_empresa) || empty($sector) || empty($descripcion) || empty($departamento) || empty($ciudad) || empty($clave)){
        echo "Por favor, rellena todos los campos.";
        exit;  // Detener la ejecución si algún campo está vacío
    }

    // Cifrar la contraseña antes de almacenarla
    $claveCifrada = password_hash($clave, PASSWORD_DEFAULT);

    // Insertar el nuevo usuario en la base de datos
    try {
        // Consulta SQL
        $query = "INSERT INTO usuarios (nombre, apellido, documento, telefono, email, nombre_empresa, sector, descripcion, departamento, ciudad, clave) VALUES (:nombre, :apellido, :documento, :telefono, :email, :nombre_empresa, :sector, :descripcion, :departamento, :ciudad, :clave)";
        $stmt = $pdo->prepare($query);

        // Vincular parámetros
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellido', $apellido);
        $stmt->bindParam(':documento', $documento);
        $stmt->bindParam(':telefono', $telefono);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':nombre_empresa', $nombre_empresa);
        $stmt->bindParam(':sector', $sector);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':departamento', $departamento);
        $stmt->bindParam(':ciudad', $ciudad);
        $stmt->bindParam(':clave', $claveCifrada);  // 'clave' es la columna en la base de datos
       

        // Ejecutar la consulta
        if ($stmt->execute()) {
            // Guardar mensaje de éxito en la sesión
            $_SESSION['registro_exitoso'] = "¡Registro exitoso! Bienvenido, $nombre.";

            // Redirigir a la página principal
            header("Location: index.php");  // Redirige a index.php
            exit;  // Detener la ejecución del script después de la redirección
        } else {
            echo "Hubo un error al registrar el usuario. Intenta nuevamente.";
        }
    } catch (PDOException $e) {
        echo "Error al registrar el usuario: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Emprendeduros Registro</title>
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
            <a class="nav-link a-button-header" aria-current="page" href="consulta.php">Consultar emprendedores</a>
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
    <div class="w-100">
      <h1 class="col my-2">Registro</h1>
    </div>
    <form class="row g-3 bg-body p-lg-4 rounded-4" action="registro.php" method="POST">
      <h4 class="mt-4 w-100">Información personal</h4>
      <!--nombre-->
      <div class="col-md-6">
        <label for="inputName" class="form-label">Nombre</label>
        <input type="text" class="form-control" placeholder="Nombre" aria-label="Nombre" id="nombre" name="nombre"
          required>
      </div>
      <!--apellido-->
      <div class="col-md-6">
        <label for="inputLastName" class="form-label">Apellido</label>
        <input type="text" class="form-control" placeholder="Apellido" aria-label="Apellido" id="apellido"
          name="apellido" required>
      </div>
      <!--numero documento-->
      <div class="col-md-6">
        <label for="inputId" class="form-label">Número de documento</label>
        <input type="number" class="form-control" placeholder="Ingresa tu documento" aria-label="Número de documento"
          id="documento" name="documento" required>
      </div>
      <!--numero teléfono-->
      <div class="col-md-6">
        <label for="inputContact" class="form-label">Número de contacto</label>
        <input type="number" class="form-control" placeholder="Ingresa tu télefono" aria-label="Número de contacto"
          id="telefono" name="telefono" required>
      </div>
      <!--correo-->
      <div class="col-md-6">
        <label for="inputEmail" class="form-label">Correo electrónico</label>
        <input type="email" class="form-control" placeholder="Ingresa tu correo" id="email" name="email" required>
      </div>
      <h4 class="mt-4 w-100">Información de empresa</h4>
      <!--nombre empresa-->
      <div class="col-md-6">
        <label for="inputBrand" class="form-label">Nombre de tu empresa</label>
        <input type="text" class="form-control" placeholder="Nombre empresa" aria-label="Nombre de tu empresa"
          id="nombre_empresa" name="nombre_empresa" required>
      </div>
      <!--breve descripción-->
      <div class="col-md-6">
        <label for="exampleFormControlTextarea1" class="form-label">Descripción</label>
        <textarea class="form-control" rows="3" id="descripcion" name="descripcion" required></textarea>
      </div>
      <!--direccion empresa
      <div class="col-md-6">
        <label for="inputAddress" class="form-label">Dirección</label>
        <input type="text" class="form-control" placeholder="Calle 53A #79A - 53" id="direccion_empresa" name="direccion_empresa" required >
      </div>-->
      <!--Departamento-->
      <div class="col-md-6">
        <label for="inputState" class="form-label">Departamento</label>
        <select class="form-select" aria-placeholder="Departamento" id="departamento" name="departamento" required>
          <option selected="">Selecciona un departamento</option>
          <option>Antioquia</option>
          <option>Cundinamarca</option>
          <option>Valle del Cauca</option>
          <option>Atlántico</option>
          <option>Santander</option>
          <option>Bolívar</option>
          <option>Norte de Santander</option>
          <option>Huila</option>
          <option>Cesar</option>
          <option>Magdalena</option>
        </select>
      </div>
      <!--Ciudad-->
      <div class="col-md-6">
        <label for="inputCity" class="form-label">Ciudad</label>
        <select class="form-select" aria-placeholder="Ciudad" id="ciudad" name="ciudad" required>
          <option selected="">Selecciona una ciudad</option>
          <option>Barranquilla</option>
          <option>Bogotá</option>
          <option>Bucaramanga</option>
          <option>Cali</option>
          <option>Cartagena</option>
          <option>Cúcuta</option>
          <option>Floridablanca</option>
          <option>Ibagué</option>
          <option>Manizales</option>
          <option>Medellín</option>
          <option>Montería</option>
          <option>Neiva</option>
          <option>Pasto</option>
          <option>Pereira</option>
          <option>Popayán</option>
          <option>Santa Marta</option>
          <option>Sincelejo</option>
          <option>Soledad</option>
          <option>Valledupar</option>
          <option>Villavicencio</option>
        </select>
      </div>
      <!--sector empresarial-->
      <div class="col-md-6">
        <label for="inputSector" class="form-label">Sector empresarial</label>
        <select class="form-select" aria-placeholder="Selecciona" id="sector" name="sector" required>
          <option selected="">Selecciona.</option>
          <option>Agricultura y Ganadería</option>
          <option>Comercio y Venta al por Menor</option>
          <option>Construcción</option>
          <option>Educación</option>
          <option>Energía y Recursos Naturales</option>
          <option>Industria Manufacturera</option>
          <option>Medios de Comunicación y Publicidad</option>
          <option>Moda y Textiles</option>
          <option>Salud y Bienestar</option>
          <option>Seguros</option>
          <option>Servicios Financieros y Bancarios</option>
          <option>Telecomunicaciones y Tecnología de la Información</option>
          <option>Transporte y Logística</option>
          <option>Turismo y Hotelería</option>
        </select>
      </div>
      <h4 class="mt-4 w-100">Crear contraseña</h4>
      <!--contraseña-->
      <div class="col-md-6">
        <label for="inputPassword4" class="form-label">Password</label>
        <input type="password" class="form-control" id="clave" name="clave" required>
        <p class="text-star">Su contraseña debe tener entre 8 y 20 caracteres, contener letras y números, y no debe
          contenerespacios, caracteres especiales ni emojis.
        </p>
      </div>
      <!--aceptar terminos y condiciones-->
      <div class="col-md-12">
        <div class="form-check">
          <input class="form-check-input" type="checkbox" id="terminoscondiciones" name="terminoscondiciones" required>
          <label class="form-check-label" for="gridCheck">
            Aceptar <a>Términos y condiciones</a>
          </label>
        </div>
      </div>
      <!--boton de registro-->
      <div class="col-auto d-flex flex-column align-items-center mt-3 align-text-center vstack gap-3">
        <button type="submit" class="w-75 rounded-4">Registrarse</button>
      </div>
    </form>
  </div>
  </div>
  <!-- Bootstrap JavaScript -->
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
        <a class="col" href="consulta.php">
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