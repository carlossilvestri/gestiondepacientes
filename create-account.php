<?php include_once 'templates/header1.php'; ?>
  <body>

    <!-- Create Account -->
    <div class="container">
        <div class="row">
          <div class="col-lg-3 col-md-2"></div>
          <div class="col-lg-6 col-md-8 login-box">
            <div class="col-lg-12 login-key">
              <p class="h1 mt-5">Administrador de Pacientes</p>
            </div>
            <div class="col-lg-12 login-title mt-0">Regístrate</div>
  
            <div class="col-lg-12 login-form">
              <div class="col-lg-12 login-form">
                <form role="form" method="POST" action="modelo-usuarios.php" name="guardar-registro" id="guardar-registro">
                  <div class="form-group">
                    <label class="form-control-label">Nombre</label>
                    <input required name="name" type="text" class="form-control" />
                  </div>
                  <div class="form-group">
                    <label class="form-control-label">Apellido</label>
                    <input required name="lastname" type="text"  class="form-control" />
                  </div>
                  <div class="form-group">
                    <label class="form-control-label">Email</label>
                    <input required name="email" type="email"  class="form-control" />
                  </div>
                  <div class="form-group">
                    <label class="form-control-label">Contraseña</label>
                    <input required name="password" type="password"  class="form-control" i />
                  </div>
                  <div class="form-group">
                    <a
                      href="index.php"
                      style="float: left; font-size: 12px"
                      class="form-control-label mb-4"
                      >¿Ya tienes una cuenta? inicia sesión.</a
                    >
                  </div>
                  <div class="col-lg-12 loginbttm">
                    <div class="col-lg-6 login-btm login-text">
                      <!-- Error Message -->
                    </div>
                    <div class="col-12 login-btm login-button">
                    <input type="hidden" name="registro" value="nuevo">
                      <button type="submit" class="btn btn-outline-primary">
                        Regístrate
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