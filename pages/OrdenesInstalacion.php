<?php
set_time_limit(0);
include '../php/ConexionSQL.php';
$actual = date("Ymd");
$anterior = date("Ymd", strtotime($actual . "- 3 month"));
$consulta = "SELECT DISTINCT C.NOMBRE, C.CLIENTE FROM 
clients C INNER JOIN ventas V ON C.CLIENTE=V.CLIENTE INNER JOIN partvta P ON V.VENTA=P.VENTA 
WHERE V.F_EMISION BETWEEN '$anterior' AND '$actual'";
$resultadoClientes = sqlsrv_query($Conn, $consulta);

$textinicio = date("Y-m-01");
$textfin = date("Y-m-t");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Ordenes Instalación</title>

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
          <a href="#" class="nav-link">Reporte pagos</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="#" class="nav-link">Administración</a>
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

            <li class="nav-item menu-open">
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

            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-sitemap"></i>
                <p>
                  Sistema
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="./routers.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Router</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Corte</p>
                    <i class="right fas fa-angle-left"></i>
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
              <h1 class="m-0">Ordenes de Instalación</h1>
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
                      <label class="col-form-label" for="fechaInicio">Fecha Incio:</label>
                      <input type="date" class="form-control form-control-sm" name="fechaInicio" id="fechaInicio" value="<?= $textinicio ?>">
                    </div>
                    <div class="col-sm-2 my-1">
                      <label class="col-form-label" for="fechaFin">Fecha Fin:</label>
                      <input type="date" class="form-control form-control-sm" name="fechaFin" id="fechaFin" value="<?= $textfin ?>">
                    </div>
                    <div class="col-sm-2 my-1">
                      <label class="col-form-label" for="filtrotipo">Tipo:</label>
                      <select name="filtrotipo" class="form-control form-control-sm" id="filtrotipo">
                        <option>-Selecciona-</option>
                        <option>Inalámbrico</option>
                        <option>Fibra óptica</option>
                      </select>
                    </div>
                    <div class="col-sm-2 my-1">
                      <label class="col-form-label" for="filtroins">Instalación:</label>
                      <select name="filtroins" class="form-control form-control-sm" id="filtroins">
                        <option>-Selecciona-</option>
                        <option>Nueva</option>
                        <option>Cambio</option>
                      </select>
                    </div>
                    <div class="col-sm-2 my-1">
                      <label class="col-form-label" for="filtroins"></label>
                      <button type="button" class="btn btn-block btn-outline-success btn-xs" style="margin-top:12px" data-toggle="modal" data-target="#modalAgregarOrden">
                        <i class="fa fa-plus"></i> Agregar Orden</button>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <div id="tablaOrdenes">

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

    <div class="modal fade" id="modalAgregarOrden">
      <div class="modal-dialog">
        <div class="modal-content">
          <form id="agregarOrden" enctype="multipart/form-data">
            <div class="modal-header">
              <h4 class="modal-title">Información Orden</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="col-12 col-sm-12">
                <div class="card card-primary card-outline card-outline-tabs">
                  <div class="card-header p-0 border-bottom-0">
                    <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill" href="#custom-tabs-four-home" role="tab" aria- controls="custom-tabs-four-home" aria-selected="true"><i class="fa fa-info-circle contrast"></i> Datos Orden</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill" href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false"><i class="fa fa-wifi contrast"></i> Datos Red</a>
                      </li>
                    </ul>
                  </div>
                  <div class="card-body">
                    <div class="tab-content" id="custom-tabs-four-tabContent">
                      <div class="tab-pane fade show active" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                        <div class="form-group">
                          <label for="folioOrden">Folio Orden:</label>
                          <input type="number" class="form-control form-control-sm" name="folioOrden" id="folioOrden" placeholder="">
                        </div>
                        <div class="form-group">
                          <label for="nombre">Nombre Cliente:</label>
                          <select class="form-control form-control-sm select2" style="width: 100%;" id="nombre" name="nombre">
                            <?php while ($clientes = sqlsrv_fetch_array($resultadoClientes)) : ?>
                              <option value="<?= $clientes['NOMBRE'] ?>"><?= $clientes['NOMBRE'] ?></option>
                            <?php endwhile; ?>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="fechaInst">Fecha de instalación:</label>
                          <input type="date" class="form-control form-control-sm" name="fechaInst" id="fechaInst" placeholder="">
                        </div>
                        <div class="form-group">
                          <label for="TipoServicio">Tipo de servicio:</label>
                          <select class="form-control form-control-sm" style="width: 100%;" id="tipoServicio" name="tipoServicio">
                            <option>Inalámbrico</option>
                            <option>Fibra óptica</option>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="tipoIns">Instalación:</label>
                          <select class="form-control form-control-sm " style="width: 100%;" id="tipoIns" name="tipoIns">
                            <option>Nueva</option>
                            <option>Cambio</option>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="folioOrden">Imagenes</label>
                          <div class="input-group">
                            <div class="custom-file">
                              <input type="file" class="custom-file-input" id="imgOrden" name="imgOrden">
                              <label class="custom-file-label" for="imgOrden">Imagen Orden</label>
                            </div>
                          </div>
                          <div class="input-group">
                            <div class="custom-file">
                              <input type="file" class="custom-file-input" id="imgCredencial" name="imgCredencial">
                              <label class="custom-file-label" for="imgCredencial">Imagen Credencial</label>
                            </div>
                          </div>
                          <div class="input-group">
                            <div class="custom-file">
                              <input type="file" class="custom-file-input" id="imgComp" name="imgComp">
                              <label class="custom-file-label" for="imgComp">Imagen Compromiso </label>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab">

                      </div>
                    </div>
                  </div>
                  <!-- /.card -->
                </div>
              </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
              <div>
                <button type="button" class="btn btn-default" onclick="reinicar()">Reiniciar</button>
                <button type="submit" class="btn btn-outline-success">Guradar</button>
              </div>
            </div>
          </form>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>

    <div class="modal fade" id="modalActualizarOrden">
      <div class="modal-dialog">
        <div class="modal-content">
          <form id="actualizarOrden" enctype="multipart/form-data">
            <div class="modal-header">
              <h4 class="modal-title">Actualizar Orden</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="col-12 col-sm-12">
                <div class="card card-primary card-outline card-outline-tabs">
                  <div class="card-header p-0 border-bottom-0">
                    <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill" href="#custom-tabs-four-home" role="tab" aria- controls="custom-tabs-four-home" aria-selected="true"><i class="fa fa-info-circle contrast"></i> Datos Orden</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill" href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false"><i class="fa fa-wifi contrast"></i> Datos Red</a>
                      </li>
                    </ul>
                  </div>
                  <div class="card-body">
                    <div class="tab-content" id="custom-tabs-four-tabContent">
                      <div class="tab-pane fade show active" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                        <div class="form-group">
                          <label for="actuFolioOrden">Folio Orden:</label>
                          <input type="number" class="form-control form-control-sm" name="actuFolioOrden" id="actuFolioOrden" placeholder="" readonly>
                        </div>
                        <div class="form-group">
                          <label for="actuNombre">Nombre Cliente:</label>
                          <input type="text" class="form-control form-control-sm" name="actuNombre" id="actuNombre" placeholder="">
                        </div>
                        <div class="form-group">
                          <label for="actuFechaInst">Fecha de instalación:</label>
                          <input type="date" class="form-control form-control-sm" name="actuFechaInst" id="actuFechaInst" placeholder="">
                        </div>
                        <div class="form-group">
                          <label for="actuTipoServicio">Tipo de servicio:</label>
                          <select class="form-control form-control-sm" style="width: 100%;" id="actuTipoServicio" name="actuTipoServicio">
                            <option>Inalámbrico</option>
                            <option>Fibra óptica</option>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="actuTipoIns">Instalación:</label>
                          <select class="form-control form-control-sm " style="width: 100%;" id="actuTipoIns" name="actuTipoIns">
                            <option>Nueva</option>
                            <option>Cambio</option>
                          </select>
                        </div>
                      </div>
                      <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab">

                      </div>
                    </div>
                  </div>
                  <!-- /.card -->
                </div>
              </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
              <div>
                <button type="button" class="btn btn-outline-danger" onclick="borrar()">Borrar</button>
                <button type="button" class="btn btn-outline-warning" onclick="actualizar()">Actualizar</button>
              </div>
            </div>
          </form>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
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
  <script src="../js/ordenesServicio.js"></script>
  <script>
    $(function() {
      //Initialize Select2 Elements
      $('.select2').select2()

      //Initialize Select2 Elements
      $('.select2bs4').select2({
        theme: 'bootstrap4'
      })
    })
    $(function() {
      bsCustomFileInput.init();
    });
  </script>
</body>

</html>