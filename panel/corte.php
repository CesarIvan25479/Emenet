<?php
set_time_limit(0);
$idRouter = $_POST["idRouter"];
$mesCorte = $_POST["mesCorte"];

require_once "../php/ConexionMySQL.php";
// Consulta para mostrar los datos del router para hacer corte
$queryMysql = "SELECT Nombre FROM router WHERE id = '$idRouter'";
$resultMysql = mysqli_query($Conexion, $queryMysql);
$datosRouter = mysqli_fetch_array($resultMysql);
//************************************ */

//Corte servicio
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
    <title>Corte <?= $datosRouter["Nombre"] ?></title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <link rel="icon" href="../dist/img/Logosinfondo.svg">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="../plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- Paginar Tabla-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <style>
        .spinner {
            border: 5px solid rgba(0, 0, 0, 0.1);
            margin-left: 5px;
            width: 25px;
            height: 25px;
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
                    <a href="../panel/Clientes.php" class="nav-link">Clientes</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link" data-toggle="modal" data-target="#IntFecha">Reporte Ventas</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="../panel/PagosBanco.php" class="nav-link">Pagos Banco</a>
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
                        <div class="col-sm-12">
                            <h1 class="m-0">Corte router <?= $datosRouter["Nombre"] ?> Mes <?= $mesCorte ?></h1>
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
                                        <h5>Clientes Cortados</h5>
                                        <div class="spinner" id="cargando"></div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div id="tablaCorte">

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
        <!-- Control Sidebar -->

        <div class="modal fade bs-example-modal-sm" id="mesCorte" tabindex="-1" role="dialog" aria-labelledby="SeleccionaMes" aria-hidden="true">
            <div class="modal-dialog modal-sm" role="document">
                <form name="mesDeCorte" action="../panel/corte.php" method="POST">
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
    <!-- bs-custom-file-input -->
    <script src="../plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="../plugins/sweetalert2/sweetalert2.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <!-- InputMask -->
    <script src="../plugins/moment/moment.min.js"></script>
    <script src="../plugins/inputmask/jquery.inputmask.min.js"></script>
    <script src="../js/corte.js"></script>
    <script>
        $(document).ready(() => {
            let id = "<?= $idRouter ?>";
            let mes = "<?= $mesCorte ?>";
            mesGet = mes.replace(" ", "%20");
            $("#tablaCorte").load("../panel/tablas/tablaCorte.php?idRouter=" + id + "&mesCorte=" + mesGet)
            let cadena = "idRouter=" + id + "&mesCorte=" + mes;
            $.ajax({
                type: "POST",
                url: "../php/corte/corteRouter.php",
                dataType: "JSON",
                data: cadena,
                success: (data) => {
                    if (data.estado = "listo") {
                        $("#cargando").removeClass("spinner");
                        let Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 5000
                        });
                        Toast.fire({
                            icon: 'success',
                            title: `Corte realizado correctamente ${data.count} clientes cortados`
                        })
                    } else {
                        console.log("No hay Conexion")
                    }
                }
            })
        })
    </script>
</body>

</html>