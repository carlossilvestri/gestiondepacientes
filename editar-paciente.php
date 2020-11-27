<?php
//Funcion que te lleva al admin-o-cliente.php si no estas logueado. 
//Descomentar cuando funcione la parte del login.
  include_once 'funciones/sesiones.php';
  include_once 'funciones/funciones.php';
  include_once 'templates/header2.php';
?>

  <body class="">
    <div class="wrapper">
    <?php include_once 'templates/barra.php'; ?>
      <div class="main-panel" id="main-panel">
        <!-- Navbar -->
        <nav
          class="navbar navbar-expand-lg navbar-transparent bg-primary navbar-absolute"
        >
          <div class="container-fluid">
            <div class="navbar-wrapper">
              <div class="navbar-toggle">
                <button type="button" class="navbar-toggler">
                  <span class="navbar-toggler-bar bar1"></span>
                  <span class="navbar-toggler-bar bar2"></span>
                  <span class="navbar-toggler-bar bar3"></span>
                </button>
              </div>
              <a class="navbar-brand" href="dashboard.php">Dashboard</a>
            </div>
            <button
              class="navbar-toggler"
              type="button"
              data-toggle="collapse"
              data-target="#navigation"
              aria-controls="navigation-index"
              aria-expanded="false"
              aria-label="Toggle navigation"
            >
              <span class="navbar-toggler-bar navbar-kebab"></span>
              <span class="navbar-toggler-bar navbar-kebab"></span>
              <span class="navbar-toggler-bar navbar-kebab"></span>
            </button>
            <div
              class="collapse navbar-collapse justify-content-end"
              id="navigation"
            >
              <form>
                <div class="input-group no-border">
                  <input
                    type="text"
                    value=""
                    class="form-control"
                    placeholder="Search..."
                  />
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <i class="now-ui-icons ui-1_zoom-bold"></i>
                    </div>
                  </div>
                </div>
              </form>
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
            <div class="col-md-8">
              <div class="card">
                <div class="card-header">
                  <h5 class="title">Editar Paciente</h5>
                </div>
                <div class="card-body">
                  <form>
                    <div class="row">
                      <div class="col-md-6 pr-1">
                        <div class="form-group">
                          <label>Nombre</label>
                          <input
                            type="text"
                            class="form-control"
                            placeholder="Company"
                            value="Mike"
                          />
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Apellido</label>
                          <input
                            type="text"
                            class="form-control"
                            placeholder="Last Name"
                            value="Andrew"
                          />
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6 pr-1">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Email</label>
                          <input
                            type="email"
                            class="form-control"
                            placeholder="Email"
                          />
                        </div>
                      </div>
                      <div class="col-md-6 ">
                        <div class="form-group">
                          <label>Identificación</label>
                          <input
                            type="number"
                            class="form-control"
                            placeholder="Identificación"
                            value=""
                          />
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label>Dirección</label>
                          <input
                            type="text"
                            class="form-control"
                            placeholder="Dirección"
                            value=""
                          />
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4 pl-1">
                        <div class="form-group ml-3">
                          <label>Edad</label>
                          <input
                            type="number"
                            class="form-control"
                            placeholder="ZIP Code"
                          />
                        </div>
                      </div>
                      <div class="col-md-4 pl-1 m-3">
                        <div class="form-group ml-3">
                          <input
                            class="form-check-input"
                            type="radio"
                            name="exampleRadios"
                            id="radioHombre"
                            value="option1"
                            checked
                          />
                          <label class="form-check-label" for="radioHombre">
                            Hombre
                          </label>
                        </div>
                        <div class="form-group ml-3">
                            <input
                              class="form-check-input"
                              type="radio"
                              name="exampleRadios"
                              id="radioMujer"
                              value="option1"
                              checked
                            />
                            <label class="form-check-label" for="radioMujer">
                              Mujer
                            </label>
                          </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <button
                          href="#"
                          class="btn btn-success btn-round"
                        >
                          Editar Paciente
                        </button>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
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
              <a href="https://www.invisionapp.com" target="_blank">Invision</a
              >. Coded by
              <a href="https://www.creative-tim.com" target="_blank"
                >Creative Tim</a
              >.
            </div>
          </div>
        </footer>
      </div>
    </div>
    <?php include_once 'templates/footer2.php'; ?>
  </body>
</html>