<?php
//esto es en caso de que no exista la session me llevara al login index
session_start();
if (!isset($_SESSION["id_usu"])) {
    header("location: ../");
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SISTEMA DON DATO</title>
    <!-- <link rel="shortcut icon" href="../LOGIN/images/lentes.png"> -->
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="icon" href="img/icono.jpg">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="template/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="template/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="template/dist/css/skins/_all-skins.min.css">


    <!-- esto son plugins apartes de binieron con la plantilla -->
    <link rel="stylesheet" href="plugins/DATATABLES/datatables.min.css">
    <link rel="stylesheet" href="plugins/SELECT2/css/select2.min.css">
    <link rel="stylesheet" href="plugins/FULLCALENDAR/bootstrap-clockpicker.min.css">
    <link rel="stylesheet" href="plugins/FULLCALENDAR/fullcalendar.min.css">

    <!-- CSS -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
    <!-- Default theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css" />
    <!-- Semantic UI theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.min.css" />
    <!-- Bootstrap theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css" />
</head>

<style>
    body {
        padding-right: 0 !important;
    }

    /* este estlo es para que la alerta de swetalert2 sea mas grande */
    .swal2-popup {
        font-size: 1.6rem !important;
    }

    .dataTables_length {
        padding: 10px;
    }

    .azuldete {
        color: #fff !important;
        background: #17a2b8 !important;
        border-color: #17a2b8 !important;
    }

    .redfule {
        color: #fff !important;
        background: #dc3545 !important;
        border-color: #dc3545 !important;
    }

    .greenlover {
        color: #fff !important;
        background: #28a745 !important;
        border-color: #28a745 !important;
    }

    .moverabajo {
        padding-top: 22px;
    }


    .fc th {
        padding: 10px 0px !important;
        vertical-align: middle !important;
        background: greenyellow !important;
    }

    #global {
        height: 510px;
        overflow-y: scroll;
        border-radius: 20px;
        border: 3px solid orange;
    }

    #global::-webkit-scrollbar-track {
        background-color: transparent;
    }

    #global::-webkit-scrollbar {
        width: 1px;
        background-color: transparent;
    }

    #global::-webkit-scrollbar-thumb {
        background-color: #000000;
    }
</style>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <header class="main-header">
            <a href="index.php" class="logo">
                <span class="logo-mini"><b>D</b> KAT</span>
                <span class="logo-lg"><b>DON</b> GATO</span>
            </a>
            <nav class="navbar navbar-static-top">
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">

                        <li class="dropdown user user-menu">
                            <a href="../CARRITO/" target="_blank">
                                <i class="fa fa-shopping-cart" style="color: black"></i>
                                <span class="hidden-xs">Ir a Tienda</span>
                            </a>
                        </li>
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img id="foto_user_uno" class="user-image" alt="User Image">
                                <span class="hidden-xs" id="datos_nombres_empleado_dos"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="user-header">
                                    <img id="foto_user_dos" class="img-circle" alt="User Image">
                                    <p>
                                        <span id="datos_nombres_empleado"></span>
                                        <?php
                                        date_default_timezone_set('America/Guayaquil');
                                        function fechaC()
                                        {
                                            $mes = array(
                                                "", "Enero",
                                                "Febrero",
                                                "Marzo",
                                                "Abril",
                                                "Mayo",
                                                "Junio",
                                                "Julio",
                                                "Agosto",
                                                "Septiembre",
                                                "Octubre",
                                                "Noviembre",
                                                "Diciembre"
                                            );
                                            return date('d') . " de " . $mes[date('n')] . " de " . date('Y');
                                        }
                                        ?>
                                        <small><b>Milagro - </b> <?php echo fechaC(); ?></small>
                                    </p>
                                </li>
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="#" onclick="abrirmodaleditarconta();" class="btn btn-primary btn-flat"><i class="fa fa-user"></i> Perfil</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="controlador/usuarios/cerrar_session.php" class="btn btn-danger btn-flat"><i class="fa fa-reply"></i> Cerrar session</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        <!-- =============================================== -->

        <aside class="main-sidebar">
            <section class="sidebar">
                <div class="user-panel">
                    <div class="pull-left image">
                        <img id="foto_user_tres" class="img-circle" alt="User Image">
                    </div>
                    <div class="pull-left info">
                        <p><span id="datos_nombres_empleado_tres"></span></p>
                        <a href="#"><i class="fa fa-circle text-success"></i> <span id="tipo_usuario_centrad"></span></a>
                    </div><br>
                </div>

                <div id="global">

                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">

                        <li class="header">NAVEGACION PRINCIPAL</li>

                        <li class="treeview" id="permiso_config">
                            <a href="#">
                                <i class="fa fa-wrench"></i> <span>Configuracion</span> <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">

                                <li><a onclick="cargar_contenido('contenido_principal','vista/usuario/vista_tipo_usuario.php')"><i class="fa fa-circle-o"></i> Tipo usuario</a></li>
                                <li><a onclick="cargar_contenido('contenido_principal','vista/usuario/registrar_usuario.php')"><i class="fa fa-user"></i> Registro de usuarios</a></li>
                                <li><a onclick="cargar_contenido('contenido_principal','vista/usuario/listado_usuarios.php')"><i class="fa fa-users"></i> Listado de usuarios</a></li>
                                <li><a onclick="cargar_contenido('contenido_principal','vista/empresa/empresa.php')"><i class="fa fa-home"></i> Datos de empresa</a></li>

                            </ul>
                        </li>

                        <li class="treeview" id="permiso_emples">
                            <a href="#">
                                <i class="fa fa-user"></i> <span>Empleado</span> <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">

                                <li><a onclick="cargar_contenido('contenido_principal','vista/empleado/tipo_cargo.php')"><i class="fa fa-circle-o"></i> Tipo de cargo</a></li>
                                <li><a onclick="cargar_contenido('contenido_principal','vista/empleado/nuevo_empleado.php')"><i class="fa fa-circle-o"></i> Registar empleado</a></li>
                                <li><a onclick="cargar_contenido('contenido_principal','vista/empleado/listado_empleado.php')"><i class="fa fa-circle-o"></i> Listado de empleados</a></li>
                                <li id="permiso_asistens"><a onclick="cargar_contenido('contenido_principal','vista/empleado/asistencia.php')"><i class="fa fa-circle-o"></i> Asistencias</a></li>
                                <li id="permiso_mults"><a onclick="cargar_contenido('contenido_principal','vista/empleado/multas.php')"><i class="fa fa-circle-o"></i> Multas</a></li>
                                <li><a onclick="cargar_contenido('contenido_principal','vista/empleado/permisos.php')"><i class="fa fa-circle-o"></i> Permisos</a></li>
                                <li id="permiso_bens"><a onclick="cargar_contenido('contenido_principal','vista/empleado/beneficios.php')"><i class="fa fa-circle-o"></i> Beneficios</a></li>
                                <li id="permiso_rols"><a onclick="cargar_contenido('contenido_principal','vista/empleado/rol_pagos.php')"><i class="fa fa-circle-o"></i> Rol de pagos</a></li>
                                <li><a onclick="cargar_contenido('contenido_principal','vista/empleado/listado_rol_pagos.php')"><i class="fa fa-circle-o"></i> Listado rol pagos</a></li>
                                <!-- <li><a onclick="cargar_contenido('contenido_principal','vista/usuario/registrar_usuario.php')"><i class="fa fa-user"></i> Registro de usuarios</a></li>
                                <li><a onclick="cargar_contenido('contenido_principal','vista/usuario/listado_usuarios.php')"><i class="fa fa-users"></i> Listado de usuarios</a></li>
                                <li><a onclick="cargar_contenido('contenido_principal','vista/empresa/empresa.php')"><i class="fa fa-home"></i> Datos de empresa</a></li> -->

                            </ul>
                        </li>

                        <li class="treeview" id="permiso_prods">
                            <a href="#">
                                <i class="fa fa-cubes"></i> <span>Gestión de productos</span> <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">

                                <li><a onclick="cargar_contenido('contenido_principal','vista/productos/tipo_produto.php')"><i class="fa fa-circle-o"></i> Tipo de producto</a></li>
                                <li><a onclick="cargar_contenido('contenido_principal','vista/productos/marcas.php')"><i class="fa fa-circle-o"></i> Marcas</a></li>
                                <li id="permiso_creat_pords"><a onclick="cargar_contenido('contenido_principal','vista/productos/nuevo_producto.php')"><i class="fa fa-circle-o"></i> Registro de producto</a></li>
                                <li><a onclick="cargar_contenido('contenido_principal','vista/productos/listado_productos.php')"><i class="fa fa-circle-o"></i> Listado de producto</a></li>
                                <li id="permiso_provees"><a onclick="cargar_contenido('contenido_principal','vista/productos/proveedore.php')"><i class="fa fa-circle-o"></i> Proveedores</a></li>
                                <li><a onclick="cargar_contenido('contenido_principal','vista/productos/listado_proveedore.php')"><i class="fa fa-circle-o"></i> Listado de proveedores</a></li>
                                <li id="permiso_comps"><a onclick="cargar_contenido('contenido_principal','vista/productos/compra_producto.php')"><i class="fa fa-circle-o"></i> Nueva compra</a></li>
                                <li id="permiso_list_comps"><a onclick="cargar_contenido('contenido_principal','vista/productos/listado_compras.php')"><i class="fa fa-circle-o"></i> Listado compra</a></li>
                                <li id="permiso_ofertas"><a onclick="cargar_contenido('contenido_principal','vista/productos/ofertas.php')"><i class="fa fa-circle-o"></i> Ofertas</a></li>

                            </ul>
                        </li>

                        <li class="treeview" id="permiso_servs">
                            <a href="#">
                                <i class="fa fa-car"></i> <span>Servicios y Mantenimiento </span> <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">

                                <li><a onclick="cargar_contenido('contenido_principal','vista/servicio/tiposervicio.php')"><i class="fa fa-circle-o"></i> Tipo de servicio</a></li>
                                <li><a onclick="cargar_contenido('contenido_principal','vista/servicio/tipovehiculo.php')"><i class="fa fa-circle-o"></i> Tipo de vehículo</a></li>
                                <li><a onclick="cargar_contenido('contenido_principal','vista/servicio/marcah_vehoculos.php')"><i class="fa fa-circle-o"></i> Marca de vehículo</a></li>
                                <li id="permiso_creat_cliens"><a onclick="cargar_contenido('contenido_principal','vista/servicio/registro_cliente.php')"><i class="fa fa-circle-o"></i> Registro cliente</a></li>
                                <li><a onclick="cargar_contenido('contenido_principal','vista/servicio/listado_clientes.php')"><i class="fa fa-circle-o"></i> Listado cliente</a></li>
                                <li id="permiso_crea_vehs"><a onclick="cargar_contenido('contenido_principal','vista/servicio/registro_vehiculo.php')"><i class="fa fa-circle-o"></i> Registro de vehículo</a></li>
                                <li><a onclick="cargar_contenido('contenido_principal','vista/servicio/listado_vehiculos.php')"><i class="fa fa-circle-o"></i> Listado de vehículo</a></li>

                                <li id="permiso_vents"><a onclick="cargar_contenido('contenido_principal','vista/servicio/nueva_venta.php')"><i class="fa fa-circle-o"></i> Nueva venta</a></li>
                                <li><a onclick="cargar_contenido('contenido_principal','vista/servicio/listar_ventas.php')"><i class="fa fa-circle-o"></i> Listado de venta</a></li>

                                <li id="permiso_cret_sers"><a onclick="cargar_contenido('contenido_principal','vista/servicio/registro_servicios.php')"><i class="fa fa-circle-o"></i> Registro de servicios</a></li>
                                <li id="permiso_list_reser"><a onclick="cargar_contenido('contenido_principal','vista/servicio/listado_servicoos.php')"><i class="fa fa-circle-o"></i> Listado de servicios</a></li>


                                <li class="treeview" id="permiso_reports">
                                    <a href="#">
                                        <i class="fa fa-calendar"></i> <span>Reservas </span> <i class="fa fa-angle-left pull-right"></i>
                                    </a>
                                    <ul class="treeview-menu">

                                        <li><a onclick="cargar_contenido('contenido_principal','vista/servicio/reserva_citas.php')"><i class="fa fa-circle-o"></i> Calendario de reservas</a></li>

                                        <li><a onclick="cargar_contenido('contenido_principal','vista/servicio/listado_reservas.php')"><i class="fa fa-circle-o"></i> Listado de reservas</a></li>

                                    </ul>
                                </li>


                            </ul>
                        </li>

                        <li class="treeview" id="permiso_reports">
                            <a href="#">
                                <i class="fa fa-file"></i> <span>Reportes </span> <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">

                                <li><a onclick="cargar_contenido('contenido_principal','vista/reportess/reporte_empleados.php')"><i class="fa fa-circle-o"></i> Reporte rol de pago </a></li>
                                <li><a onclick="cargar_contenido('contenido_principal','vista/reportess/reporte_empleados_lis.php')"><i class="fa fa-circle-o"></i> Reporte empleados </a></li>
                                <li><a onclick="cargar_contenido('contenido_principal','vista/reportess/reporte_proveedor.php')"><i class="fa fa-circle-o"></i> Reporte de proveedores</a></li>

                                <li><a onclick="cargar_contenido('contenido_principal','vista/reportess/reporte_compras.php')"><i class="fa fa-circle-o"></i> Reporte de compras </a></li>
                                <li><a onclick="cargar_contenido('contenido_principal','vista/reportess/reporte_ventas.php')"><i class="fa fa-circle-o"></i> Reporte de ventas</a></li>

                                <li><a onclick="cargar_contenido('contenido_principal','vista/reportess/reporte_clientes.php')"><i class="fa fa-circle-o"></i> Reporte de clientes</a></li>
                                <li><a onclick="cargar_contenido('contenido_principal','vista/reportess/reporte_servicios.php')"><i class="fa fa-circle-o"></i> Reporte de servicios</a></li>

                                <li><a onclick="cargar_contenido('contenido_principal','vista/reportess/reporte_productos.php')"><i class="fa fa-circle-o"></i> Inventario de productos</a></li>

                            </ul>
                        </li>

                        <li class="treeview" id="permiso_segurs">
                            <a href="#">
                                <i class="fa fa-key"></i> <span>Seguridad </span> <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">

                                <li><a onclick="cargar_contenido('contenido_principal','vista/seguridad/backup.php')"><i class="fa fa-circle-o"></i> Backup </a></li>

                                <li class="treeview">
                                    <a href="#">
                                        <i class="fa fa-circle-o"></i> <span>Auditoria de transacción </span> <i class="fa fa-angle-left pull-right"></i>
                                    </a>
                                    <ul class="treeview-menu">

                                        <li><a onclick="cargar_contenido('contenido_principal','vista/seguridad/audi_ventas.php')"><i class="fa fa-circle-o"></i> Ventas </a></li>
                                        <li><a onclick="cargar_contenido('contenido_principal','vista/seguridad/audi_compras.php')"><i class="fa fa-circle-o"></i> Compras </a></li>
                                        <li><a onclick="cargar_contenido('contenido_principal','vista/seguridad/audi_servicios.php')"><i class="fa fa-circle-o"></i> Servicios </a></li>

                                    </ul>
                                </li>

                            </ul>
                        </li>

                    </ul>

                </div>

            </section>
        </aside>

        <!-- =============================================== -->
        <div class="content-wrapper" id="contenido_principal">
            <div class="content">
                <div class="col-md-13">
                    <div class="box box-success box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title">Contenido principal - DON GATO</h3>
                        </div>
                        <div class="box-body">
                            <div class="row">

                                <div class="col-lg-3 col-xs-6">
                                    <div class="small-box bg-yellow">
                                        <div class="inner">
                                            <h2 id="Empleados_id"></h2>

                                            <p>Empleados </p>
                                        </div>
                                        <div class="icon">
                                            <i class="fa fa-user"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-xs-6">
                                    <div class="small-box bg-yellow">
                                        <div class="inner">
                                            <h2 id="Clientes_id"></h2>

                                            <p>Clientes </p>
                                        </div>
                                        <div class="icon">
                                            <i class="ion ion-person-add"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-xs-6">
                                    <div class="small-box bg-green">
                                        <div class="inner">
                                            <h2 id="Productos_id"></h2>

                                            <p>Productos</p>
                                        </div>
                                        <div class="icon">
                                            <i class="fa fa-cubes"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-xs-6">
                                    <div class="small-box bg-red">
                                        <div class="inner">
                                            <h2 id="Servicios_id"></h2>

                                            <p>Servicios</p>
                                        </div>
                                        <div class="icon">
                                            <i class="fa fa-cube"></i>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="col-lg-6">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <h4 class="card-title"> <label>
                                                <center>Top 10 productos mas vendidos</center>
                                            </label></h4>
                                        <p class="card-text">
                                        <div class="chart_p">
                                            <canvas id="areaChart_p" style="height:0"></canvas>
                                        </div>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <h4 class="card-title"> <label>
                                                <center>Top 10 servicios mas vendidos</center>
                                            </label></h4>
                                        <p class="card-text">
                                        <div class="chart_s">
                                            <canvas id="areaChart_s" style="height:0"></canvas>
                                        </div>
                                        </p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 2.5
        </div>
        <strong>Copyright &copy; 2022-2023 <a>DON GATO</a>.</strong> Derechos reservados.
    </footer> -->

    </div>
    <!-- jQuery 2.2.0 -->
    <script src="template/plugins/jQuery/jQuery-2.2.0.min.js"></script>
    <!-- Bootstrap 3.3.6 -->
    <script src="template/bootstrap/js/bootstrap.min.js"></script>
    <!-- AdminLTE App -->
    <script src="template/dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="template/dist/js/demo.js"></script>

    <!-- ///// esot no esta dentro de template -->
    <script src="plugins/js/sweetalert2/sweetalert2.all.min.js"></script>
    <script src="plugins/DATATABLES/datatables.min.js"></script>
    <script src="plugins/SELECT2/js/select2.min.js"></script>

    <!-- esto son plugins apartes de binieron con la plantilla -->
    <script src="plugins/FULLCALENDAR/moment.min.js"></script>
    <script src="plugins/FULLCALENDAR/fullcalendar.min.js"></script>
    <script src="plugins/FULLCALENDAR/es.js"></script>
    <script src="plugins/FULLCALENDAR/bootstrap-clockpicker.min.js"></script>

    <script src="plugins/Chart/chart.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
</body>

</html>

<script src="js/usuario.js"></script>
<script src="js/sytem.js"></script>

<!-- //////////////////// -->
<!-- ./Modal para editra datos usuario -->
<div class="modal fade" id="modal_ediat_contra" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background: #00a65a; color:white;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="text-align: center;"><B> DATOS DE USUARIO</B></h4>
            </div>
            <div class="modal-body">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_30" data-toggle="tab" aria-expanded="true">Datos de usuario</a></li>
                        <li><a href="#tab_31" data-toggle="tab" aria-expanded="true">Cambiar contraseña</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_30">
                            <div class="box box-primary">
                                <div class="row">
                                    <div class="col-lg-5"><br>
                                        <div class="box-body box-profile">
                                            <img id="fotocambio" height="10px" width="10px" class="profile-user-img img-responsive img-circle" alt="User profile picture">
                                            <h3 class="profile-username text-center">Foto de perfil</h3>
                                            <input type="file" id="foto_perfoil"><br>
                                            <input hidden type="text" id="foto_delte">
                                            <a href="#" onclick="editar_foto();" class="btn btn-primary btn-block"><i class="fa fa-undo"></i> <b>Cambiar foto de perfil</b></a>
                                        </div>
                                        <!-- /.box-body -->
                                    </div>
                                    <div class="row"><br>
                                        <div class="col-lg-3">
                                            <label for="pefil_nombre">Nombres</label>
                                            <input type="text" class="form-control" id="pefil_nombre" onkeypress="return soloLetras(event)"><br>
                                        </div>
                                        <div class="col-lg-3">
                                            <label for="ap_pater_perfil">Apellidos</label>
                                            <input type="text" class="form-control" id="ap_pater_perfil" onkeypress="return soloLetras(event)"><br>
                                        </div>

                                        <div class="col-lg-3">
                                            <label for="cedula_per">cedula</label>
                                            <input readonly type="text" maxlength="10" class="form-control" id="cedula_per">
                                            <label for="" id="cedula_p" style="color: red; font-size: 12px;"></label><br>
                                        </div>
                                        <div class="col-lg-3">
                                            <label for="telefono_per">Telefono</label>
                                            <input type="text" maxlength="10" min="0" class="form-control" id="telefono_per" onkeypress="return soloNumeros(event)"><br>
                                        </div>
                                        <div class="col-lg-6">
                                            <label for="email_per">Email</label>
                                            <input type="email" class="form-control" id="email_per">
                                            <label for="" id="emailok" style="color: red;"></label><br>
                                        </div>
                                        <div class="col-lg-4">
                                            <label for="usuario_per">Actualizar nombre de usuario</label>
                                            <input type="text" class="form-control" id="usuario_per"><br>
                                        </div>
                                        <div class="col-lg-4">
                                            <label for="direcc_domi">Direccion de domicilio</label>
                                            <input type="text" class="form-control" id="direcc_domi"><br>
                                        </div>
                                        <div class="col-lg-3">
                                            <label>Sexo</label>
                                            <select id="sexo_perfil" style="width: 100%;" class="select form-control">
                                                <option value="Masculino">Masculino</option>
                                                <option value="Femenino">Femenino</option>
                                            </select><br>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>
                                    <button onclick="editar_usuario_perfil()" id="ocutar_p" class="btn btn-success"><i class="fa fa-edit"></i> Modificar datos personales</button>
                                </div>
                            </div>
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="tab_31">
                            <div class="col-lg-11">
                                <input hidden type="text" id="txt_contra_bd">
                                <label for="">Contraseña Actual</label>
                                <input type="password" class=" form-control" id="txt_contra1" placeholder="Ingrese contraseña Actual"><br>
                            </div>

                            <div class="col-lg-1">
                                <label for="">.</label>
                                <button class="btn btn-danger" title="Ver password de usuario" onclick="ver_contra_user()"><i class="fa fa-eye"></i></button><br>
                            </div>

                            <div class="col-lg-6">
                                <label for="">Nueva contraseña</label>
                                <input type="password" class="form-control" id="txt_contra2" placeholder="contraseña Nueva"><br>
                            </div>

                            <div class="col-lg-6">
                                <label for="">Repita contraseña</label>
                                <input type="password" class="form-control" id="txt_contra3" placeholder="Repita contraseña"><br>
                            </div>


                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>
                                <button type="button" class="btn btn-success" onclick="editar_contra()"><i class="fa fa-edit"></i> Modificar clave</button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var funcion;

    traer_datos_dasboard_admin();
    productos_mas_comprados();
    servicios_mas_comprados();
    verificar_ofertas();

    traer_datos_usuario();
    traer_datos_permisos_usuario();

    function ver_contra_user() {
        var txt_contra1 = document.getElementById("txt_contra1");
        var txt_contra2 = document.getElementById("txt_contra2");
        var txt_contra3 = document.getElementById("txt_contra3");

        if (txt_contra1.type == "password") {
            txt_contra1.type = "text";
            txt_contra2.type = "text";
            txt_contra3.type = "text";
        } else {
            txt_contra1.type = "password";
            txt_contra2.type = "password";
            txt_contra3.type = "password";
        }
    }

    ////// esto es para la vista y validaciones
    function cargar_contenido(contenedor, contenido) {
        $("#" + contenedor).load(contenido);
    }

    function soloLetras(e) {
        key = e.keyCode || e.which;
        tecla = String.fromCharCode(key).toLowerCase();
        letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
        especiales = "8-37-39-46";
        tecla_especial = false
        for (var i in especiales) {
            if (key == especiales[i]) {
                tecla_especial = true;
                break;
            }
        }
        if (letras.indexOf(tecla) == -1 && !tecla_especial) {
            return swal.fire(
                "No se permiten numeros!!",
                "Solo se permiten letras",
                "warning"
            );
        }
    }

    function soloNumeros(e) {
        var key = window.event ? e.which : e.keyCode;
        if (key < 48 || key > 57) {
            return swal.fire(
                "No se permiten letras!!",
                "Solo se permiten numeros",
                "warning"
            );
        }
    }

    ////
    //funcion para validar decimales
    function filterfloat(evt, input) {
        var key = window.Event ? evt.which : evt.keyCode;
        var chark = String.fromCharCode(key);
        var tempvalue = input.value + chark;
        if (key >= 48 && key <= 57) {
            if (filter(tempvalue) === false) {
                return false;
            } else {
                return true;
            }
        } else {
            if (key == 8 || key == 13 || key == 0) {
                return false;
            } else if (key === 46) {
                if (filter(tempvalue) === false) {
                    return false;
                } else {
                    return true;
                }
            } else {
                return swal.fire(
                    "No se permiten letras!!",
                    "Solo se permiten numeros decimales",
                    "warning"
                );
            }
        }
    }

    function filter(__val__) {
        var preg = /^([0-9]+\.?[0-9]{0,2})$/;
        if (preg.test(__val__) === true) {
            return true;
        } else {
            return false;
        }
    }

    document.getElementById('email_per').addEventListener('input', function() {
        campo = event.target;
        //este codigo me da formato email
        email = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;

        //esto es para validar si es un email valida
        if (email.test(campo.value)) {
            //estilos para cambiar de color y ocultar el boton
            $(this).css("border", "1px solid green");
            $("#emailok").html("");
            $("#ocutar_p").show();
        } else {
            $(this).css("border", "1px solid red");
            $("#emailok").html("Email incorrecto");
            $("#ocutar_p").hide();
        }
    });


    /////////////////////////
    function mostar_loader_datos(alerta) {
        var texto = null;
        var mostrar = false;

        switch (alerta[0]) {
            case "datos":
                texto = alerta[1];
                mostrar = true;
                break;
        }
        if (mostrar) {
            Swal.fire({
                title: alerta[2],
                html: texto,
                allowOutsideClick: false,
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading();
                },
            });
        }
    }

    function cerrar_loader_datos(alerta) {
        var tipo = null;
        var texto = null;
        var mostrar = false;

        switch (alerta[0]) {
            case "exito":
                tipo = alerta[1];
                texto = alerta[2];
                mostrar = true;
                break;

            case "existe":
                tipo = alerta[1];
                texto = alerta[2];
                mostrar = true;
                break;

            case "error":
                tipo = alerta[1];
                texto = alerta[2];
                mostrar = true;
                break;

            default:
                swal.close();
                break;
        }
        if (mostrar) {
            Swal.fire({
                position: "center",
                icon: tipo,
                text: texto,
                showConfirmButton: true,
                allowOutsideClick: false,
            });
        }
    }

    document.getElementById("foto_perfoil").addEventListener("change", () => {
        var filename = document.getElementById("foto_perfoil").value;
        var idxdot = filename.lastIndexOf(".") + 1;
        var extfile = filename.substr(idxdot, filename.length).toLowerCase();
        if (extfile == "jpg" || extfile == "jpeg" || extfile == "png") {} else {
            swal.fire(
                "Mensaje de informacion",
                "Solo se aceptan imagenes - USTED SUBIO UN ARCHIVO CON LA EXTENCIO ." + extfile,
                "warning"
            );
            document.getElementById("foto_perfoil").value = "";
        }
    });
</script>