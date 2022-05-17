<?php
set_time_limit(0);
include '../php/ConexionSQL.php'; 
date_default_timezone_set('America/Mexico_City');
$fecha=date('Y-m-d');
$consulta = "SELECT NOMBRE, CLIENTE FROM clients";
$resultadoClientes = sqlsrv_query($Conn , $consulta); 

?>


<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Pagos Banco</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <link rel="icon" href="../dist/img/Logosinfondo.svg">
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
          <a href="#" class="d-block">Isaac fuentes Nalgon</a>
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
                    <a href="./OrdenesInstalacion.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Ordenes Instalación</p>
                    </a>
                  </li>
                </ul>
              </li>

              <li class="nav-item menu-open">
                <a href="../index.html" class="nav-link">
                  <i class="nav-icon fas fa-chart-line"></i>
                  <p>
                    Cobranza
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="./PagosBanco.php" class="nav-link active">
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
                <a href="../index.html" class="nav-link">
                  <i class="nav-icon fas fa-sitemap"></i>
                  <p>
                    Sistema
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
            <h1 class="m-0">Lista de pagos por Banco</h1>
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
                      <div class="col-sm-3 my-1">
                          <select class="form-control form-control-sm" style="width: 100%;">
                              <option>PENDIENTE</option>
                              <option>REGISTRADOS</option>
                              <option>FINALIZADO</option>
                              <option>TODOS</option>
                          </select>
                      </div>                      
                      <div class="col-sm-3 my-1">
                          <select class="form-control form-control-sm" style="width: 100%;">
                              <option>MAY 2022</option>
                              <option>ENE 2022</option>
                              <option>FEB 2022</option>
                              <option>MAR 2022</option>
                              <option>ABR 2022</option>
                              <option>MAY 2022</option>
                              <option>JUN 2022</option>
                              <option>JUL 2022</option>
                          </select>
                      </div>
                      <div class="col-auto my-1">
                          <div class="form-check">
                              <input class="form-check-input" type="checkbox" name="TodasFechas" id="TodasFechas">
                              <label class="form-check-label" for="TodasFechas">
                                  Todos los registros
                              </label>
                          </div>
                      </div>  
                    <div class="col-sm-2 my-1">
                      
                      <button type="button" class="btn btn-block btn-outline-success btn-xs" data-toggle="modal" data-target="#AgregarPago">
                          <i class="fa fa-plus"></i> Agregar Pago</button>
                    </div>
                  </div>
              </div>
              <div class="card-body">
                <div id="tablaPagosBanco">
                <div class="row">
	<div class="col-sm-12">
        <div class="card-box table-responsive">
            <table class="table table-sm">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>CLIENTE</th>
                        <th>FECHA</th>            
                        <th>MES</th>
                        <th>N.OPE</th>
                        <th>IMPORTE</th> 
                        <th>FO. PAGO</th>       
                        <th>OBSERVACION</th>     
                    </tr>
                </thead>
                <tr class="table-info">
                    <td>DAD</td>
                    <td>DASSA</td>
                    <td>DADS</td>
                    <td>DADSA</td>
                    <td>DADSA</td>
                    <td>DAD</td>
                    <td>DADSA</td>
                    <td>DAD</td>
                </tr>       
                 
        </table>
            </div>
    </div>
</div>
                </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                Footer
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
                    <input class="form-control" type="date" name="FechaRep" value="<?=$fechaAnterior?>">
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
    
    
      <div class="modal fade" id="AgregarPago">
        <div class="modal-dialog">
          <div class="modal-content">
              <form id="agregarPago">
            <div class="modal-header">
              <h4 class="modal-title">Información pago</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-3">
                            <label class="col-form-label" for="nombre">Cliente:</label>
                            <input list="listaClientes" class="form-control form-control-sm" name="liCliente" id="liCliente">
                            <datalist id="listaClientes">
                                <?php while($listaClientes = sqlsrv_fetch_array($resultadoClientes)): ?>
                                <option value="<?=$listaClientes["CLIENTE"]?>"><?=$listaClientes["NOMBRE"]?></option>
                                <?php endwhile;?>
                            </datalist>
                        </div>
                        <div class="col-9">
                            <label class="col-form-label" for="nombre"><i class="fas fas fa-user"></i> Nombre:</label>
                            <input type="text" class="form-control form-control-sm" name="nombre" id="nombre" readonly>
                        </div>
                    </div>
                    
                </div>
                <div class="form-group">
                    <label class="col-form-label" for="numerooperacion"><i class="fas fa-key"></i> Numero de operación:</label>
                    <input class="form-control form-control-sm" type="text" placeholder="" id="numeroOperacion" onkeyup="javascript:this.value=this.value.toUpperCase();">
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <label class="col-form-label" for="mesPago"><i class="fas fa-calendar"></i> Mes:</label>
                            <select class="form-control form-control-sm" id="mesPago" name="mesPago">
                              <option>MAY 2022</option>
                              <option>ENE 2022</option>
                              <option>FEB 2022</option>
                              <option>MAR 2022</option>
                              <option>ABR 2022</option>
                              <option>MAY 2022</option>
                              <option>JUN 2022</option>
                              <option>JUL 2022</option>
                          </select>
                        </div>
                        <div class="col-6">
                            <label class="col-form-label" for="pago"><i class="fas fa-dollar-sign"></i> Pago:</label>
                            <input type="number" class="form-control form-control-sm" placeholder="$0.00" name="pago" id="pago">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <label class="col-form-label" for="formaPago"><i class="fas fa-comment-dollar"></i> Forma de pago:</label>
                            <select class="form-control form-control-sm" id="formaPago" name="formaPago"> 
                              <option>Deposito</option>
                              <option>Transferanicia </option>
                              <option>Efectivo</option>
                          </select>
                        </div>
                        <div class="col-6">
                            <label class="col-form-label" for="fechaDeposito"><i class="fas fa-calendar-day"></i> Fecha deposito:</label>
                            <input type="date" class="form-control form-control-sm" name="fechaDeposito" id="fechaDeposito" value="<?=$fecha?>">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-form-label" for="observacion"><i class="fas fa-eye"></i> Observaciones:</label>
                    <textarea class="form-control" rows="2" placeholder="..." name="observacion" id="observacion" ></textarea>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
              <button type="submit" class="btn btn-primary">Guradar</button>
            </div>
              </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
    
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
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<script src="../js/pagosBanco.js"></script>
</body>
</html>
