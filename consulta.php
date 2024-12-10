<?php
// Incluir la conexión a la base de datos
include('db.php');

// Iniciar la sesión para poder mostrar mensajes si es necesario
session_start();

// Consulta SQL para obtener todos los registros de la tabla 'usuarios'
$query = "SELECT * FROM usuarios";
$stmt = $pdo->prepare($query);
$stmt->execute();

// Obtenemos los resultados
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Consultamos SQL para general el conteo de emprendedores por ciudad
$query_ciudad = "SELECT ciudad, COUNT(*) as total FROM usuarios GROUP BY ciudad";
$stmt_ciudad = $pdo->prepare($query_ciudad);
$stmt_ciudad->execute();

// Obtener los resultados para el gráfico
$ciudades = $stmt_ciudad->fetchAll(PDO::FETCH_ASSOC);

// Preparamos los datos para el gráfico
$labels = [];
$data = [];
foreach ($ciudades as $ciudad) {
    $labels[] = $ciudad['ciudad'];
    $data[] = $ciudad['total'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emprendeduros</title>
    <!-- Estilos CSS -->
    <link rel="stylesheet" href="estilos.css">
    <!-- Estilos generales CSS -->
    <link rel="stylesheet" href="estilos-generales.css">
    <!-- fuente google -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Incluir Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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

<body class="container">

    <div class="container w-100 my-4 p-3 justify-content-center align-items-center caja-general vstack gap-3">

        <h2>Lista de Emprendedores Registrados</h2>

        <!-- Mostrar mensaje de éxito o error si existe -->
        <?php
        if (isset($_SESSION['registro_exitoso'])) {
            echo "<div class='alert alert-success'>" . $_SESSION['registro_exitoso'] . "</div>";
            unset($_SESSION['registro_exitoso']);
        }
        ?>

        <!-- Aquí va el gráfico -->
        <h3>Emprendedores por Ciudad</h3>
        <canvas id="myChart" width="200" height="100"></canvas>

        <script>
            var ctx = document.getElementById('myChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar', // Tipo de gráfico, puede ser 'pie' para un gráfico circular
                data: {
                    labels: <?php echo json_encode($labels); ?>, // Ciudades
                    datasets: [{
                        label: 'Cantidad de Emprendedores',
                        data: <?php echo json_encode($data); ?>, // Cantidad de emprendedores por ciudad
                        backgroundColor: 'rgba(54, 162, 235, 0.2)', // Color de las barras
                        borderColor: 'rgba(54, 162, 235, 1)', // Color del borde de las barras
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>

        <!-- Tabla de usuarios -->
        <h3>Usuarios Registrados</h3>
        <table class="table table-bordered table-striped mt-3">
            <thead>
                <tr>
                    <th>Indice</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Departamento</th>
                    <th>Ciudad</th>
                    <th>Teléfono</th>
                    <th>Email</th>
                    <th>Empresa</th>
                    <th>Sector</th>
                    <th>Descripción</th>
                    <th>Fecha de registro</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usuarios as $usuario): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($usuario['id']); ?></td>
                        <td><?php echo htmlspecialchars($usuario['nombre']); ?></td>
                        <td><?php echo htmlspecialchars($usuario['apellido']); ?></td>
                        <td><?php echo htmlspecialchars($usuario['departamento']); ?></td>
                        <td><?php echo htmlspecialchars($usuario['ciudad']); ?></td>
                        <td><?php echo htmlspecialchars($usuario['telefono']); ?></td>
                        <td><?php echo htmlspecialchars($usuario['email']); ?></td>
                        <td><?php echo htmlspecialchars($usuario['nombre_empresa']); ?></td>
                        <td><?php echo htmlspecialchars($usuario['sector']); ?></td>
                        <td><?php echo htmlspecialchars($usuario['descripcion']); ?></td>
                        <td><?php echo htmlspecialchars($usuario['fecha_registro']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>

</body>

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
                    <li class="mb-2"><a href="/login.html">Inciar sesión</a></li>
                    <li class="mb-2"><a href="/registro.html">Registro</a></li>
                    <li class="mb-2"><a href="/terminos-condiciones.html">Términos y condiciones</a></li>
                </ul>
            </div>
            <div class="col-12 col-lg-4 mb-3 d-flex flex-column align-items-center">
                <a class="col" href="/consulta.php">
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