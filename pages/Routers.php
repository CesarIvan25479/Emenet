<?php
//Corte servicio
include "../php/ConexionMySQL.php";
include '../php/meses.php';
$query = "SELECT id, Nombre FROM router";
$result = mysqli_query($Conexion, $query);
//************************** */
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Routers</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <link rel="icon" href="../dist/img/Logosinfondo.svg">
  <!-- Select2 -->
  <link rel="stylesheet" href="../plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="../plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Paginar Tabla-->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
  <style>
    .modal-body input:required {
      border: 1px solid red;
    }

    .modal-body textarea:required {
      border: 1px solid red;
    }

    .spinner {
      border: 5px solid rgba(0, 0, 0, 0.1);
      width: 22px;
      height: 22px;
      border-radius: 50%;
      border-left-color: #09f;

      animation: spin 1s ease infinite;
    }

    @keyframes spin {
      0% {
        transform: rotate(0deg);
      }

      100% {
        transform: rotate(360deg);
      }
    }
  </style>
</head>

<body class="hold-transition sidebar-mini sidebar-collapse">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="../pages/Clientes.php" class="nav-link">Clientes</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="#" class="nav-link" data-toggle="modal" data-target="#IntFecha">Reporte Ventas</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="../pages/PagosBanco.php" class="nav-link">Pagos Banco</a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Messages Dropdown Menu -->
        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
            <i class="fas fa-th-large"></i>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="../" class="brand-link">
        <img src="../dist/img/Logosinfondo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-5" style="opacity: .8">
        <span class="brand-text font-weight-light">Emenet Comunica...</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="../dist/img/profile-user.png" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block">Usuario Emenet</a>
          </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
          <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Buscar" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-sidebar">
                <i class="fas fa-search fa-fw"></i>
              </button>
            </div>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
              <a href="../index.html" class="nav-link active">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Administración</p>
                  </a>
                </li>
              </ul>
            </li>

            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-solid fa-users"></i>
                <p>
                  Clientes
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="./Clientes.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Clientes</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                      Clientes Router
                      <i class="right fas fa-angle-left"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                      <a href="#" class="nav-link">
                        <i class="far fa-dot-circle nav-icon"></i>
                        <p>Coyoltepec</p>
                      </a>
                    </li>
                  </ul>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link" data-toggle="modal" data-target="#IntFecha">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Reporte Ventas</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="./OrdenesInstalacion.php" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Ordenes Instalación</p>
                  </a>
                </li>
              </ul>
            </li>

            <li class="nav-item">
              <a href="../index.html" class="nav-link">
                <i class="nav-icon fas fa-chart-line"></i>
                <p>
                  Cobranza
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="./PagosBanco.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Pagos Banco</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Pagos Factura</p>
                  </a>
                </li>
              </ul>
            </li>

            <li class="nav-item menu-open">
              <a href="../index.html" class="nav-link">
                <i class="nav-icon fas fa-sitemap"></i>
                <p>
                  Sistema
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="./routers.php" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Router</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                      Corte
                      <i class="right fas fa-angle-left"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">
                    <?php while ($router = mysqli_fetch_array($result)) : ?>
                      <li class="nav-item">
                        <a href="#" class="nav-link" onclick="pasarIdRouter('<?= $router['id'] . '||' . $router['Nombre'] ?>')" data-toggle="modal" data-target="#mesCorte">
                          <i class="far fa-dot-circle nav-icon"></i>
                          <p><?= $router["Nombre"] ?></p>
                        </a>
                      </li>
                    <?php endwhile; ?>
                  </ul>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Puntos de Acceso</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Planes de internet</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Zonas</p>
                  </a>
                </li>
              </ul>
            </li>

            <li class="nav-item">
              <a href="../index.html" class="nav-link">
                <i class="nav-icon fas fa-wifi"></i>
                <p>
                  Hostpot
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Router</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Lista Planes</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Crear Fichas</p>
                  </a>
                </li>
              </ul>
            </li>

            <li class="nav-item">
              <a href="../index.html" class="nav-link">
                <i class="nav-icon fas fa-cloud"></i>
                <p>
                  AdminOLT
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Proximamente...</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Proximamente...</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Proximamente...</p>
                  </a>
                </li>
              </ul>
            </li>

            <li class="nav-item">
              <a href="../index.html" class="nav-link">
                <i class="nav-icon fas fa-archive"></i>
                <p>
                  Almacen
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Proximamente...</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Proximamente...</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Proximamente...</p>
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Routers Mikrotik</h1>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12 col-sm-12">
              <!-- Default box -->
              <div class="card">
                <div class="card-header">
                  <div class="form-row align-items-center">
                    <div class="col-sm-2 my-1">
                      <h5>Lista routers</h5>
                    </div>
                    <div class="col-sm-2 my-1">
                      <button type="button" class="btn btn-block btn-outline-success btn-xs" data-toggle="modal" data-target="#modalAgregarRouter">
                        <i class="fa fa-plus"></i> Agregar Router</button>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <div id="tablaRouter">

                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                </div>
                <!-- /.card-footer-->
              </div>
              <!-- /.card -->
            </div>

          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <div class="modal fade" id="modalAgregarRouter">
      <div class="modal-dialog">
        <div class="modal-content">
          <form id="agregarRouter" enctype="multipart/form-data">
            <div class="modal-header">
              <h4 class="modal-title">Información Router</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-group row">
                <label for="nombreRouter" class="col-sm-2 col-form-label">Nombre:</label>
                <div class="col-sm-10">
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-file-signature"></i></span>
                    </div>
                    <input type="text" class="form-control form-control-sm" id="nombreRouter" name="nombreRouter">
                  </div>
                </div>
              </div>

              <div class="form-group row">
                <label for="ipRouter" class="col-sm-2 col-form-label">Dir. IP:</label>
                <div class="col-sm-10">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-laptop"></i></span>
                    </div>
                    <input type="text" class="form-control form-control-sm" data-inputmask="'alias': 'ip'" data-mask name="ipRouter" id="ipRouter">
                  </div>
                </div>
              </div>

              <div class="form-group row">
                <label for="usuarioRouter" class="col-sm-2 col-form-label">Usuario:</label>
                <div class="col-sm-10">
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-user"></i></span>
                    </div>
                    <input type="text" class="form-control form-control-sm" name="usuarioRouter" id="usuarioRouter">
                  </div>
                </div>
              </div>

              <div class="form-group row">
                <label for="passwordRouter" class="col-sm-2 col-form-label">Contra.:</label>
                <div class="col-sm-10">
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-eye"></i></span>
                    </div>
                    <input type="password" class="form-control form-control-sm" name="passwordRouter" id="passwordRouter">
                  </div>
                </div>
              </div>

              <div class="form-group row">
                <label for="puertoApi" class="col-sm-2 col-form-label">Puerto:</label>
                <div class="col-sm-10">
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-hashtag"></i></span>
                    </div>
                    <input type="number" class="form-control form-control-sm" name="puertoApi" id="puertoApi">
                  </div>
                </div>
              </div>

              <div class="form-group row">
                <label for="tipoServicio" class="col-sm-2 col-form-label">Servicio:</label>
                <div class="col-sm-10">
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-wifi"></i></span>
                    </div>
                    <select name="tipoServicio" id="tipoServicio" class="form-control form-control-sm">
                      <option>INA</option>
                      <option>IFO</option>
                    </select>
                  </div>
                </div>
              </div>

              <div class="form-group row">
                <label for="zonas" class="col-sm-2 col-form-label">Zonas:</label>
                <div class="col-sm-10">
                  <div class="input-group mb-3">
                    <textarea class="form-control" rows="2" placeholder="Ej. SM, TLALT, ALM" name="zonas" id="zonas"></textarea>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
              <div>
                <button type="button" class="btn btn-outline-info" onclick="conexion()" id="btn-comprobar">Comprobar Conexión<div id="verificando"></div></button>
                <button type="button" class="btn btn-outline-success" onclick="guardarRouter()">Guradar</button>
              </div>
            </div>
          </form>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>


    <div class="modal fade" id="modalActualizarRouter">
      <div class="modal-dialog">
        <div class="modal-content">
          <form id="actualizarRouter" enctype="multipart/form-data">
            <div class="modal-header">
              <h4 class="modal-title">Actualizar Información Router</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-group row">
                <label for="anombreRouter" class="col-sm-2 col-form-label">Nombre:</label>
                <div class="col-sm-10">
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-file-signature"></i></span>
                    </div>
                    <input type="text" class="form-control form-control-sm" id="anombreRouter" name="nombreRouter">
                    <input type="hidden" class="form-control form-control-sm" id="idRouter" name="idRouter">
                  </div>
                </div>
              </div>

              <div class="form-group row">
                <label for="aipRouter" class="col-sm-2 col-form-label">Dir. IP:</label>
                <div class="col-sm-10">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-laptop"></i></span>
                    </div>
                    <input type="text" class="form-control form-control-sm" data-inputmask="'alias': 'ip'" data-mask name="ipRouter" id="aipRouter">
                  </div>
                </div>
              </div>

              <div class="form-group row">
                <label for="ausuarioRouter" class="col-sm-2 col-form-label">Usuario:</label>
                <div class="col-sm-10">
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-user"></i></span>
                    </div>
                    <input type="text" class="form-control form-control-sm" name="usuarioRouter" id="ausuarioRouter">
                  </div>
                </div>
              </div>

              <div class="form-group row">
                <label for="apasswordRouter" class="col-sm-2 col-form-label">Contra.:</label>
                <div class="col-sm-10">
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-eye"></i></span>
                    </div>
                    <input type="password" class="form-control form-control-sm" name="passwordRouter" id="apasswordRouter">
                  </div>
                </div>
              </div>

              <div class="form-group row">
                <label for="apuertoApi" class="col-sm-2 col-form-label">Puerto:</label>
                <div class="col-sm-10">
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-hashtag"></i></span>
                    </div>
                    <input type="number" class="form-control form-control-sm" name="puertoApi" id="apuertoApi">
                  </div>
                </div>
              </div>

              <div class="form-group row">
                <label for="atipoServicio" class="col-sm-2 col-form-label">Servicio:</label>
                <div class="col-sm-10">
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-wifi"></i></span>
                    </div>
                    <select name="tipoServicio" id="atipoServicio" class="form-control form-control-sm">
                      <option>INA</option>
                      <option>IFO</option>
                    </select>
                  </div>
                </div>
              </div>

              <div class="form-group row">
                <label for="zonas" class="col-sm-2 col-form-label">Zonas:</label>
                <div class="col-sm-10">
                  <div class="input-group mb-3">
                    <textarea class="form-control" rows="2" placeholder="Ej. SM, TLALT, ALM" name="zonas" id="azonas"></textarea>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
              <div>
                <button type="button" class="btn btn-outline-info" onclick="aconexion()" id="abtn-comprobar">Comprobar Conexión</button>
                <button type="button" class="btn btn-outline-danger" onclick="borrarRouter()">Borrar</button>
                <button type="button" class="btn btn-outline-warning" onclick="actualizarRouter()">Actualizar</button>
              </div>
            </div>
          </form>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>


    <div class="modal fade bs-example-modal-sm" id="IntFecha" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-sm" role="document">
        <form name="PasarFecha" action="./ReportePagos.php" method="POST">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Fecha Inicio</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <?php
              $FechaActual = date("Y-m-01");
              $fechaAnterior = date("Y-m-d", strtotime($FechaActual . "- 5 month"));
              ?>
              <input class="form-control" type="date" name="FechaRep" value="<?php echo $fechaAnterior; ?>">
              <div class="mt-3" id='respuesta1'>
                <!--Muestra Cliente-->
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
              <button type="submit" class="btn btn-primary">Generar</button>
            </div>
          </div>
        </form>
      </div>
    </div>
    <div class="modal fade bs-example-modal-sm" id="mesCorte" tabindex="-1" role="dialog" aria-labelledby="SeleccionaMes" aria-hidden="true">
      <div class="modal-dialog modal-sm" role="document">
        <form name="mesDeCorte" action="../pages/corte.php" method="POST">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="tituloModal">Selecciona el mes de corte</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <input type="hidden" id="idRouterCorte" name="idRouter">
              <select class="form-control form-control-sm" style="width: 100%;" name="mesCorte">
                <option><?= $mes[0]; ?></option>
                <option><?= $mes[12]; ?></option>
                <option><?= $mes[13]; ?></option>
              </select>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
              <button type="submit" class="btn btn-primary">Generar Corte</button>
            </div>
          </div>
        </form>
      </div>
    </div>
    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
      <div class="p-3">
        <h5>Title</h5>
        <p>Sidebar content</p>
        <p>Sidebar content</p>
        <p>Sidebar content</p>
        <p>Sidebar content</p>
        <p>Sidebar content</p>
        <p>Sidebar content</p>
      </div>
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <footer class="main-footer">
      <!-- To the right -->
      <div class="float-right d-none d-sm-inline">
        ...
      </div>
      <!-- Default to the left -->
      <strong>Emenet Comunicaciones <a href="https://m-net.mx"> m-net.mx</a>.</strong>
    </footer>
  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->

  <!-- jQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Select2 -->
  <script src="../plugins/select2/js/select2.full.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../dist/js/adminlte.min.js"></script>
  <!-- bs-custom-file-input -->
  <script src="../plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
  <!-- SweetAlert2 -->
  <script src="../plugins/sweetalert2/sweetalert2.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
  <!-- InputMask -->
  <script src="../plugins/moment/moment.min.js"></script>
  <script src="../plugins/inputmask/jquery.inputmask.min.js"></script>
  <script src="../js/routers.js"></script>
  <script src="../js/corte.js"></script>
  <script>
    $(document).ready(() => {
      $('#tablaRouter').load("./tablas/tablaRouters.php");
    });
    $(function() {
      //Initialize Select2 Elements
      $('.select2').select2()

      //Initialize Select2 Elements
      $('.select2bs4').select2({
        theme: 'bootstrap4'
      })

      $('[data-mask]').inputmask()
    })
  </script>
</body>

</html>