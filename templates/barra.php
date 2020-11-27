<?php
$rutaTotal =  $_SERVER['REQUEST_URI'];
$arrayRutas = explode('/', $rutaTotal);
$ultimaPRuta = end($arrayRutas); 
?>

<div class="sidebar" data-color="orange">
            <!--data-color="blue | green | orange | red | yellow" -->
            <div class="logo">
                <a href="dashboard.php" class="simple-text logo-mini">
                    AP
                </a>
                <a href="dashboard.php" class="simple-text logo-normal">
                    Administrador
                </a>
            </div>
            <div class="sidebar-wrapper" id="sidebar-wrapper">
                <ul class="nav">
                    <li <?php if($ultimaPRuta === 'dashboard.php'){ echo "class='active'"; } ?> >
                        <a href="dashboard.php">
                            <i class="now-ui-icons design_app"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li <?php if($ultimaPRuta === 'crear-paciente.php'){ echo "class='active'"; } ?> >
                        <a href="crear-paciente.php">
                            <i class="now-ui-icons ui-1_simple-add"></i>
                            <p>Crear Paciente</p>
                        </a>
                    </li>
                    <li <?php if($ultimaPRuta === 'mostrar-pacientes.php'){ echo "class='active'"; } ?>>
                        <a href="mostrar-pacientes.php">
                            <i class="now-ui-icons users_single-02"></i>
                            <p>Mostrar Pacientes</p>
                        </a>
                    </li>
                    <li <?php if($ultimaPRuta === 'crear-tipo-examen.php'){ echo "class='active'"; } ?> >
                        <a href="crear-tipo-examen.php">
                            <i class="now-ui-icons ui-1_simple-add"></i>
                            <p>Crear Tipo de Examen</p>
                        </a>
                    </li>
                    <li <?php if($ultimaPRuta === 'mostrar-tipo-examen.php'){ echo "class='active'"; } ?> >
                        <a href="mostrar-tipo-examen.php">
                            <i class="now-ui-icons location_map-big"></i>
                            <p>Mostrar Tipo de Examenes</p>
                        </a>
                    </li>
                    <li <?php if($ultimaPRuta === 'crear-examen.php'){ echo "class='active'"; } ?> >
                        <a href="crear-examen.php">
                            <i class="now-ui-icons ui-1_simple-add"></i>
                            <p>Crear Examen</p>
                        </a>
                    </li>
                    <li <?php if($ultimaPRuta === 'mostrar-examenes.php'){ echo "class='active'"; } ?> >
                        <a href="mostrar-examenes.php">
                            <i class="now-ui-icons location_map-big"></i>
                            <p>Mostrar Examenes</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>