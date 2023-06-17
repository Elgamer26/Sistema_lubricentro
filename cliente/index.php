<?php
//esto es en caso de que no exista la session me llevara al login index
session_start();
if (!isset($_SESSION["id_cli"])) {
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
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="../ADMIN/template/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../ADMIN/template/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../ADMIN/template/dist/css/skins/_all-skins.min.css">


    <!-- esto son plugins apartes de binieron con la plantilla -->
    <link rel="stylesheet" href="../ADMIN/plugins/DATATABLES/datatables.min.css">
    <link rel="stylesheet" href="../ADMIN/plugins/SELECT2/css/select2.min.css">
    <link rel="stylesheet" href="../ADMIN/plugins/FULLCALENDAR/bootstrap-clockpicker.min.css">
    <link rel="stylesheet" href="../ADMIN/plugins/FULLCALENDAR/fullcalendar.min.css">
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
                                <img src="../ADMIN/img/usuarios/user.jpg" class="user-image" alt="User Image">
                                <span class="hidden-xs"><?php echo $_SESSION["nombre_cli"]; ?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="user-header">
                                    <img src="../ADMIN/img/usuarios/user.jpg" class="img-circle" alt="User Image">
                                    <p>
                                        <span><?php echo $_SESSION["nombre_cli"]; ?></span>
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
                                    <div class="pull-right">
                                        <a href="../CARRITO/layout/cerrar.php" class="btn btn-danger btn-flat"><i class="fa fa-reply"></i> Cerrar session</a>
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
                        <img src="../ADMIN/img/usuarios/user.jpg" class="img-circle" alt="User Image">
                    </div>
                    <div class="pull-left info">
                        <p><span id="datos_nombres_empleado_tres"><?php echo $_SESSION["nombre_cli"]; ?></span></p>
                        <a href="#"><i class="fa fa-circle text-success"></i><span id="tipo_usuario_centrad">Cliente</span></a>
                    </div><br>
                </div>

                <div id="global">

                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">

                        <li class="header">NAVEGACION PRINCIPAL</li>

                        <li class="treeview" id="permiso_config">
                            <a onclick="cargar_contenido('contenido_principal','vista/datos_cliente.php')">
                                <i class="fa fa-user"></i> <span>Datos personales</span>
                            </a>
                        </li>

                        <li class="treeview" id="permiso_config">
                            <a onclick="cargar_contenido('contenido_principal','vista/compras_presencial.php')">
                                <i class="fa fa-shopping-cart"></i> <span>Compras</span>
                            </a>
                        </li>

                        <li class="treeview" id="permiso_config">
                            <a onclick="cargar_contenido('contenido_principal','vista/listado_vehculos.php')">
                                <i class="fa fa-car"></i> <span>Vehiculos</span>
                            </a>
                        </li>

                        <li class="treeview" id="permiso_config">
                            <a onclick="cargar_contenido('contenido_principal','vista/servicios_cliente.php')">
                                <i class="fa fa-shopping-cart"></i> <span>Servicios</span>
                            </a>
                        </li>

                        <li class="treeview" id="permiso_config">
                            <a onclick="cargar_contenido('contenido_principal','vista/rservas_clientes.php')">
                                <i class="fa fa-calendar"></i> <span>Reservas</span>
                            </a>
                        </li>

                        <li class="treeview" id="permiso_config" style="background: red; color: white;">
                            <a href="../CARRITO/layout/cerrar.php"><i class="fa fa-reply"></i>
                                <span>Salir</span>
                            </a>
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
                            <h3 class="box-title">Bienvenido - "<?php echo $_SESSION["nombre_cli"]; ?>"</h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <img style="width: 100%;" src="../CARRITO/images/fondo.jpg" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>
    <!-- jQuery 2.2.0 -->
    <script src="../ADMIN/template/plugins/jQuery/jQuery-2.2.0.min.js"></script>
    <!-- Bootstrap 3.3.6 -->
    <script src="../ADMIN/template/bootstrap/js/bootstrap.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../ADMIN/template/dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../ADMIN/template/dist/js/demo.js"></script>

    <!-- ///// esot no esta dentro de template -->
    <script src="../ADMIN/plugins/js/sweetalert2/sweetalert2.all.min.js"></script>
    <script src="../ADMIN/plugins/DATATABLES/datatables.min.js"></script>
    <script src="../ADMIN/plugins/SELECT2/js/select2.min.js"></script>

    <!-- esto son plugins apartes de binieron con la plantilla -->
    <script src="../ADMIN/plugins/FULLCALENDAR/moment.min.js"></script>
    <script src="../ADMIN/plugins/FULLCALENDAR/fullcalendar.min.js"></script>
    <script src="../ADMIN/plugins/FULLCALENDAR/es.js"></script>
    <script src="../ADMIN/plugins/FULLCALENDAR/bootstrap-clockpicker.min.js"></script>

    <script src="../ADMIN/plugins/Chart/chart.min.js"></script>

</body>

</html>

<script src="../ADMIN/js/sytem.js"></script>


<script>
    var funcion;

    verificar_ofertas();

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

    // document.getElementById('email_per').addEventListener('input', function() {
    //     campo = event.target;
    //     //este codigo me da formato email
    //     email = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;

    //     //esto es para validar si es un email valida
    //     if (email.test(campo.value)) {
    //         //estilos para cambiar de color y ocultar el boton
    //         $(this).css("border", "1px solid green");
    //         $("#emailok").html("");
    //         $("#ocutar_p").show();
    //     } else {
    //         $(this).css("border", "1px solid red");
    //         $("#emailok").html("Email incorrecto");
    //         $("#ocutar_p").hide();
    //     }
    // });


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
</script>