<?php 

session_start();
if(isset( $_GET['cerrar_sesion'])){
    $cerrar_sesion = $_GET['cerrar_sesion'];
}else{
    $cerrar_sesion = null;
}

if($cerrar_sesion){
    session_destroy();
}
include_once 'templates/header1.php'; 

?>

<body>

    <!-- Login -->
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-2"></div>
            <div class="col-lg-6 col-md-8 login-box">
                <div class="col-lg-12 login-key">
                    <p class="h1 mt-5">Administrador de Pacientes</p>
                </div>
                <div class="col-lg-12 login-title mt-0">LOGIN</div>

                <div class="col-lg-12 login-form">
                    <div class="col-lg-12 login-form">
                        <form method="POST" action="modelo-usuarios.php" name="login-admin"
                            id="login-admin">>
                            <div class="form-group">
                                <label class="form-control-label">Email</label>
                                <input type="email" name="email" required class="form-control" />
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">Contraseña</label>
                                <input type="password" name="password" required class="form-control" i />
                            </div>
                            <div class="form-group m-3">
                                <a href="create-account.php" style="float: right; font-size: 12px"
                                    class="form-control-label mb-4">Crear una cuenta.</a>
                            </div>
                            <div class="col-lg-12 loginbttm">
                                <div class="col-lg-6 login-btm login-text">
                                    <!-- Error Message -->
                                </div>
                                <div class="col-12 login-btm login-button">
                                    <!-- Este input no se ve, solo es para tener el valor login-adm -->
                                    <input type="hidden" name="registro" value="login">
                                    <button type="submit" class="btn btn-outline-primary">
                                        LOGIN
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-3 col-md-2"></div>
            </div>
        </div>
    </div>
    <?php include_once 'templates/footer.php'; ?>
</body>

</html>