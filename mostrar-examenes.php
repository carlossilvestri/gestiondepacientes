<?php
if (isset($_GET['c'])) {
    $c = $_GET['c'];
} else {
    $c = null;
}
// echo var_dump($c);
//Funcion que te lleva al admin-o-cliente.php si no estas logueado. 
//Descomentar cuando funcione la parte del login.
  include_once 'funciones/sesiones.php';
  include_once 'funciones/funciones.php';
  include_once 'templates/header2.php';
  if($c){
    if($c == 'true'){
        echo '<span class="alerta-exito"></span>';
    }
    if($c == 'false'){
        echo '<span class="alerta-fallo"></span>';
    }
}
?>

<body class="">
    <div class="wrapper">
        <?php include_once 'templates/barra.php'; ?>
        <div class="main-panel" id="main-panel">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-transparent bg-primary navbar-absolute">
                <div class="container-fluid">
                    <div class="navbar-wrapper">
                        <div class="navbar-toggle">
                            <button type="button" class="navbar-toggler">
                                <span class="navbar-toggler-bar bar1"></span>
                                <span class="navbar-toggler-bar bar2"></span>
                                <span class="navbar-toggler-bar bar3"></span>
                            </button>
                        </div>
                        <a class="navbar-brand" href="dashboard.php">Exámenes</a>
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
                    <?php
          $idUsuario = $_SESSION['id']; 
          $examenes = obtenerExamenes($idUsuario);
          if ($examenes->num_rows) {
            foreach ($examenes as $examen) :
          ?>
                    <div class="col-md-4">
                        <div class="card card-user">
                            <div class="card-body">
                                <div class="typography-line text-center mt-3">
                                    <h6><span>Tipo de examen</span></h6>
                                    <h3><?php echo $examen['nombreTipoExamen']; ?> </h3>
                                </div>
                                <div class="typography-line text-center">
                                    <p><span>Paciente: </span>
                                        <?php echo $examen['nombrePaciente'] . " " . $examen['apellidoPaciente'] . " (ID: " . $examen['identificacion'] . ") "; ?>
                                    </p>
                                </div>
                                <p class="description text-center">
                                    <strong>Información del examen:</strong><br />
                                    <strong> <?php echo $examen['informacionExamen']; ?></strong>
                                </p>
                            </div>
                            <hr />
                            <div class="button-container">
                                <a href="editar-examen.php?id=<?php echo $examen['idExamen']; ?>" class="btn btn-info btn-round">
                                    Editar
                                </a>
                                <a href="reporte.php?id=<?php echo $examen['idExamen']; ?>" class="btn btn-warning btn-round btn-enviar-examen">
                                    Enviar Examen
                                </a>
                                <button href="#" data-id="<?php echo $examen['idExamen']; ?>" data-tipo="examen" class="btn btn-danger btn-round borrar_registro">
                                    Eliminar
                                </button>
                            </div>
                        </div>
                    </div>
                    <?php
                        endforeach;
                      } else{ ?>
                    <div class="col-md-4">
                        <div class="card card-user">
                            <div class="card-body">
                                <div class="typography-line text-center mt-3">
                                    <h6><span>Registra un Tipo de examen</span></h6>
                                </div>
                                <div class="typography-line text-center">
                                    <p><span>Tipo de exame: </span>
                                        No tienes tipos de examenes.
                                    </p>
                                </div>
                                <p class="description text-center">
                                    Registra un Tipo de examen <br />
                                </p>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
            <footer class="footer">
                <div class="container-fluid">
                    <nav>
                        <ul>
                            <li>
                                <a href="https://www.creative-tim.com"> Creative Tim </a>
                            </li>
                            <li>
                                <a href="http://presentation.creative-tim.com"> About Us </a>
                            </li>
                            <li>
                                <a href="http://blog.creative-tim.com"> Blog </a>
                            </li>
                        </ul>
                    </nav>
                    <div class="copyright" id="copyright">
                        &copy;
                        <script>
                        document
                            .getElementById("copyright")
                            .appendChild(
                                document.createTextNode(new Date().getFullYear())
                            );
                        </script>
                        , Designed by
                        <a href="https://www.invisionapp.com" target="_blank">Invision</a>. Coded by
                        <a href="https://www.creative-tim.com" target="_blank">Creative Tim</a>.
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <?php include_once 'templates/footer2.php'; ?>
</body>

</html>