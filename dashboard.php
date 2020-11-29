<?php
//Funcion que te lleva al admin-o-cliente.php si no estas logueado. 
//Descomentar cuando funcione la parte del login.
  include_once 'funciones/sesiones.php';
  include_once 'funciones/funciones.php';
  include_once 'templates/header2.php';
?>

<body class="">
    <div class="wrapper ">
        <?php include_once 'templates/barra.php'; ?>
        <div class="main-panel" id="main-panel">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-transparent  bg-primary  navbar-absolute">
                <div class="container-fluid">
                    <div class="navbar-wrapper">
                        <div class="navbar-toggle">
                            <button type="button" class="navbar-toggler">
                                <span class="navbar-toggler-bar bar1"></span>
                                <span class="navbar-toggler-bar bar2"></span>
                                <span class="navbar-toggler-bar bar3"></span>
                            </button>
                        </div>
                        <?php
                            $idUsuario = $_SESSION['id']; 
                            $resultado = obtenerUsuario($idUsuario);
                            $usuarioEspecifico = $resultado->fetch_assoc(); ?>
                        <a class="navbar-brand" href="dashboard.php">Dashboard. Bienvenido/a:
                            <?php echo $usuarioEspecifico['nombre'] ?></a>
                    </div>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation"
                        aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end" id="navigation">
                        <?php include_once 'templates/navbar-usuario.php'; ?>
                    </div>
                </div>
            </nav>
            <!-- End Navbar -->
            <div class="panel-header panel-header-lg">
                <canvas id="bigDashboardChart"></canvas>
            </div>
            <div class="content">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card card-chart">
                            <div class="card-header">
                                <h5 class="card-category">Exámenes</h5>
                                <h4 class="card-title text-center"> <a href="mostrar-examenes.php">Número de
                                        Exámenes</a></h4>
                            </div>
                            <div class="card-body">
                                <div class="chart-area">
                                    <?php
                                    $idUsuario = $_SESSION['id'];
                                    $cantExamenes = obtenerCantidadDeExamenes($idUsuario);
                                    $cantExamenesRegistrados = $cantExamenes->fetch_assoc();
                                    if ($cantExamenes->num_rows) {
                                    ?>
                                    <h2 class="card-title text-center m-3 text-success">
                                        <?php echo $cantExamenesRegistrados['registros']; ?></h2>
                                    <?php
                                    } else{ ?>
                                    <h2 class="card-title text-center m-3 text-success">0</h2>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="card card-chart">
                            <div class="card-header">
                                <h5 class="card-category">Tipos de Exámenes</h5>
                                <h4 class="card-title text-center"><a href="mostrar-tipo-examen.php">Número de Tipos de
                                        Exámenes</a> </h4>
                            </div>
                            <div class="card-body">
                                <div class="chart-area">
                                    <?php
                                    $cantTipoDeExamenes = obtenerCantidadDeTiposDeExamenes();
                                    $cantTipoDeExamenesRegistrados = $cantTipoDeExamenes->fetch_assoc();
                                    if ($cantTipoDeExamenes->num_rows) {
                                    ?>
                                    <h2 class="card-title text-center m-3 text-success">
                                        <?php echo $cantTipoDeExamenesRegistrados['registros']; ?></h2>
                                    <?php
                                    } else{ ?>
                                    <h2 class="card-title text-center m-3 text-success">0</h2>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="card card-chart">
                            <div class="card-header">
                                <h5 class="card-category">Pacientes</h5>
                                <h4 class="card-title text-center"><a href="mostrar-pacientes.php">Número de
                                        Pacientes</a></h4>
                            </div>
                            <div class="card-body">
                                <div class="chart-area">
                                    <?php
                                    $idUsuario = $_SESSION['id'];
                                    $cantPacientes = obtenerCantidadDePacientes($idUsuario);
                                    $cantPacientesRegistrados = $cantPacientes->fetch_assoc();
                                    if ($cantPacientes->num_rows) {
                                    ?>
                                    <h2 class="card-title text-center m-3 text-success">
                                        <?php echo $cantPacientesRegistrados['registros']; ?></h2>
                                    <?php
                                    } else{ ?>
                                    <h2 class="card-title text-center m-3 text-success">0</h2>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="footer">
                <div class=" container-fluid ">
                    <nav>
                        <ul>
                            <li>
                                <a href="https://www.creative-tim.com">
                                    Creative Tim
                                </a>
                            </li>
                            <li>
                                <a href="http://presentation.creative-tim.com">
                                    About Us
                                </a>
                            </li>
                            <li>
                                <a href="http://blog.creative-tim.com">
                                    Blog
                                </a>
                            </li>
                        </ul>
                    </nav>
                    <div class="copyright" id="copyright">
                        &copy; <script>
                        document.getElementById('copyright').appendChild(document.createTextNode(new Date()
                            .getFullYear()))
                        </script>, Designed by <a href="https://www.invisionapp.com" target="_blank">Invision</a>. Coded
                        by <a href="https://www.creative-tim.com" target="_blank">Creative Tim</a>.
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <?php include_once 'templates/footer2.php'; ?>
</body>

</html>