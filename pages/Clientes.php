<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Clientes</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="../plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <link rel="icon" href="../dist/img/Logosinfondo.svg">
  <style>
    .scrollTablaClientes{
      overflow:scroll;
      width:101%;
      max-height: 600px;
      height: auto;
    }
      .scrollTablaClientes::-webkit-scrollbar {
      width: 2px;             
    }
    .scrollTablaClientes::-webkit-scrollbar-thumb {
      background-color: gray;     
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
                    <a href="./Clientes.php" class="nav-link active">
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
                    <a href="./OrdenesInstalacion.php" class="nav-link">
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
            <h1 class="m-0">Clientes Punto de Venta</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-5 col-sm-12">
            <!-- Default box -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Filtrar: </h3>
              </div>
              <div class="card-body">
              <div class="input-group input-group-sm">
                  <div class="input-group-prepend">
                    <button type="button" class="btn btn-danger" id="btnBuscarCliente">Buscar <i class="fas fa-caret-square-down"></i></button>
                  </div>
                  <!-- /btn-group -->
                  <input type="text" class="form-control" id="buscarCliente" placeholder="Presiona flecha abajo o da clic en el boton buscar">
                </div>
                <br>
                <div id="tablaClientes" class="scrollTablaClientes">
                
                </div>

              </div>
              <!-- /.card-body -->
              <div class="card-footer">
               
              </div>
              <!-- /.card-footer-->
            </div>
            <!-- /.card -->
          </div>
            
        
          <div class="col-md-7 col-sm-12">
            <!-- Default box -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Información Cliente</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                  <div id="forminfo">
                      <form>
                          <div class="form-row">
                              <div class="form-group col-md-3">
                                  <label for="">Clave</label>
                                  <input type="text" class="form-control form-control-sm" placeholder="CLIENTE" id="clave" name="clave" readonly>
                              </div>
                              <div class="form-group col-md-9">
                                  <label for="">Nombre del cliente</label>
                                  <input type="text" class="form-control form-control-sm" placeholder="NOMBRE" id="nombre" name="nombre" readonly>
                              </div>
                          </div>
                          <div class="form-row">
                              <div class="form-group col-md-4">
                                  <label for="">Estado</label>
                                  <input type="text" class="form-control form-control-sm" placeholder="ESTADO" id="estado" name="estado" readonly>
                              </div>
                              <div class="form-group col-md-3">
                                  <label for="">Código Postal</label>
                                  <input type="text" class="form-control form-control-sm" placeholder="C. POSTAL" id="cp" name="cp" readonly>
      
                              </div>
                              <div class="form-group col-md-5">
                                  <label for="">Población</label>
                                  <input type="text" class="form-control form-control-sm" placeholder="POBLACIÓN" id="poblacion" name="poblacion" readonly>
                              </div>
                          </div>
                          <div class="form-row">
                              <div class="form-group col-md-6">
                                  <label for="">Colonia</label>
                                  <input type="text" class="form-control form-control-sm" placeholder="COLONIA" id="colonia" name="colonia" readonly>
                              </div>
                              <div class="form-group col-md-4">
                                  <label for="">Calle</label>
                                  <input type="text" class="form-control form-control-sm" placeholder="CALLE" id="calle" name="calle" readonly>
                              </div>
                              <div class="form-group col-md-2">
                                  <label for="">N. Exterior</label>
                                  <input type="text" class="form-control form-control-sm" placeholder="NÚMERO EXTERIOR" id="numero" name="numero" readonly>
                              </div>
                          </div>
                          <div class="form-row">
                              <div class="form-group col-md-8">
                                  <label for="">Teléfono</label>
                                  <input type="text" class="form-control form-control-sm" placeholder="TELÉFONO" id="telefono" name="telefono" readonly>
                              </div>
                              <div class="form-group col-md-2">
                                  <label for="">Clasificacíon</label>
                                  <input type="text" class="form-control form-control-sm" placeholder="CLASIFICACIÓN" id="clasificacion" name="clasificacion" readonly>
                              </div>
                              <div class="form-group col-md-2">
                                  <label for="">Zona</label>
                                  <input type="text" class="form-control form-control-sm" placeholder="ZONA" id="zon" name="zon" readonly>
                              </div>
                          </div>
                          <div class="form-row">
                                    <div class="form-group col-md-2">
                                        <label for="">L. Precio</label>
                                        <input type="text" class="form-control form-control-sm" placeholder="PRECIO" id="precio" name="precio" readonly>
                                    </div>
                                    <div class="form-group col-md-10">
                                        <label for="">Observaciones</label>
                                        <textarea  name='observaciones' rows="4"  style="min-width: 100%;background-color:#e9ecef;" readonly id="obsr"></textarea>
                                    </div>
                                </div>
                      </form>
                  </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <div id="menActivar"></div>
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
                    $fechaAnterior = date("Y-m-d",strtotime($FechaActual."- 5 month"));
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
<!-- SweetAlert2 -->
<script src="../plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<script src="../js/clientes.js"></script>
</body>
</html>
