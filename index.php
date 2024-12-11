<?php
// Iniciar sesión si es necesario
session_start();

// Aquí podrías agregar lógicas como la comprobación de la sesión, si el usuario está logueado, etc.
// Si el formulario de búsqueda se envía, lo procesamos (si se requiere).
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['buscar'])) {
  $buscar = $_POST['buscar'];
  // Aquí podrías hacer la consulta a la base de datos con el término de búsqueda.
  // Ejemplo: echo "Buscando: " . htmlspecialchars($buscar);
}

// Mostrar el mensaje de éxito si existe
if (isset($_SESSION['registro_exitoso'])) {
  // Llamar a la función JavaScript para mostrar el mensaje
  echo "<script>mostrarPopup('" . $_SESSION['registro_exitoso'] . "');</script>";

  // Eliminar el mensaje de la sesión para que no se repita al refrescar
  unset($_SESSION['registro_exitoso']);
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Emprendeduros</title>
  <!-- Estilos CSS -->
  <!-- Estilos CSS -->
  <link rel="stylesheet" href="estilos.css">
  <!-- Estilos generales CSS -->
  <link rel="stylesheet" href="estilos-generales.css">
  <!-- fuente google -->
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="script.js" defer></script>

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
          <!--  <li class="nav-item button-header p-0 m-0">
            <a class="nav-link a-button-header" aria-current="page" href="consulta.php">Consultar emprendedores</a>
          </li>    -->
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
  <div class="w-100 d-flex flex-column my-4 justify-content-center align-items-center vstack gap-3">
    <h1 class="col">Bienvenidos a Emprendeduros</h1>
    <p class="col">Somo una plataforma digital diseñada para conectar y apoyar a los emprendedores en Colombia.
      Ofrecemos un espacio donde los emprendedores pueden consultar recursos, compartir conocimientos y establecer
      relaciones valiosas con otros profesionales del sector, impulsando así el crecimiento y éxito de sus negocios.
      ¡Únete a nuestra comunidad y lleva tu emprendimiento al siguiente nivel!</p>
    <!--inicio carrusel-->
    <div id="carouselExampleDark" class="carousel carousel-dark slide w-100">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active"
          aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
      </div>
      <div class="carousel-inner rounded-4">
        <div class="carousel-item active" data-bs-interval="10000">
          <img src="images/owner-1.jpg" class="d-block w-100" alt="Imagen emprendedor">
          <div class="carousel-caption d-none d-md-block fondo-text">
            <h5>Felipe y Gabriel <span style="font-weight: 700;">TechBoost</span> </h5>
            <p style="color: black !important;">Lanzan <span style="font-style: bold;">TechBoost,</span> una startup
              enfocada en el desarrollo de aplicaciones móviles personalizadas para pequeñas y medianas empresas.</p>
          </div>
        </div>
        <div class="carousel-item" data-bs-interval="2000">
          <img src="images/owner-4.jpg" class="d-block w-100" alt="Imagen emprendedor">
          <div class="carousel-caption d-none d-md-block fondo-text">
            <h5>Laura<span style="font-weight: 700;">Estilo Natural</span> </h5>
            <p style="color: black !important;">Laura crea Estilo Natural, una línea de productos cosméticos naturales y
              orgánicos, diseñados para cuidar la piel con ingredientes provenientes de cultivos responsables.</p>
          </div>
        </div>
      </div>
      <div class="carousel-item">
        <img src="images/owner-7.jpg" class="d-block w-100" alt="Imagen emprendedor">
        <div class="carousel-caption d-none d-md-block fondo-text">
          <h5>Don Pedro <span style="font-weight: 700;">Frescos del Campo</span></h5>
          <p style="color: black !important;">Don Pedro abre Frescos del Campo, una tienda especializada en la venta de
            frutas y verduras frescas de temporada, provenientes directamente de su propio huerto y de pequeños
            productores locales.</p>
        </div>
      </div>
      <button class="carousel-control-prev h-100 button-carrusel" type="button" data-bs-target="#carouselExampleDark"
        data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next h-100 button-carrusel" type="button" data-bs-target="#carouselExampleDark"
        data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
      <!--fin carrusel-->
    </div>
    <p class="col">
      A través de nuestra plataforma, podrás acceder a recursos clave, consejos prácticos y una red de contactos valiosa
      para llevar tu emprendimiento al siguiente nivel. En Emprendeduros, fomentamos la colaboración, el aprendizaje y
      el crecimiento colectivo, brindando herramientas y oportunidades que te ayudarán a navegar el desafiante pero
      emocionante mundo del emprendimiento.
    </p>
    <p class="col">
      Únete a nuestra comunidad y comienza a construir relaciones con otros emprendedores, a consultar contenido
      especializado y a aprovechar las oportunidades de negocio que la plataforma tiene para ofrecerte.
    </p>
    <h2>¡Juntos, podemos emprender el camino hacia el éxito!</h2>
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