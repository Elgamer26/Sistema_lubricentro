<?php
require '../../modelo/modelo_carrito.php';
$MC = new modelo_carrito();
session_start();

/////////////////////////////////////////
if ($_POST["funcion"] === "logeo_cliente") {

    $email = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
    $cedula = htmlspecialchars($_POST['cedula'], ENT_QUOTES, 'UTF-8');
    $resutado = $MC->verifcar_usuario($email, $cedula);
    $data = json_encode($resutado, JSON_UNESCAPED_UNICODE);
    if (count($resutado) > 0) {
        echo $data;
    } else {
        echo 0;
    }
    exit();
}

///////////////////////////////////// 
if ($_POST["funcion"] === "session_cli") {
    $id_cli = $_POST["id_cli"];
    $nombre_cli = $_POST["nombre_cli"];

    $_SESSION["id_cli"] = $id_cli;
    $_SESSION["nombre_cli"] = $nombre_cli;
    echo 1;
    exit();
}

///////////////////////////////////////////// 
if ($_POST["funcion"] === "paguinar_prod_car") {

    $data = $MC->paguinar_prod_car();
    //jason encode para retornar los datos
    echo json_encode($data);

    exit();
}

///////////////////////////////////////////// 
if ($_POST["funcion"] === "pagination_ofertas") {

    $data = $MC->pagination_ofertas();
    //jason encode para retornar los datos
    echo json_encode($data);

    exit();
}

///////////////////////////////////////////// 
if ($_POST["funcion"] === "pagination_servicios") {

    $data = $MC->pagination_servicios();
    //jason encode para retornar los datos
    echo json_encode($data);

    exit();
}


/////////////////////////////////////////
if ($_POST["funcion"] === "agg_carrito") {

    if (isset($_SESSION["id_cli"]) && isset($_SESSION["nombre_cli"])) {

        $id_usua = $_SESSION["id_cli"];
        $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
        $resutado = $MC->agg_carrito($id, $id_usua);
        echo json_encode($resutado, JSON_UNESCAPED_UNICODE);
    } else {
        echo 100;
    }
    exit();
}

///////////////////////////////////////////// 
if ($_POST["funcion"] === "agregar_carrito_oferta") {

    if (isset($_SESSION["id_cli"]) && isset($_SESSION["nombre_cli"])) {

        $id_cli = $_SESSION['id_cli'];

        $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');

        $data = $MC->agregar_carrito_oferta($id, $id_cli);
        //jason encode para retornar los datos
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    } else {
        echo 100;
    }
    exit();
}

/////////////////////////////////////////
if ($_POST["funcion"] === "agg_carrito_servicios") {

    if (isset($_SESSION["id_cli"]) && isset($_SESSION["nombre_cli"])) {

        $id_usua = $_SESSION["id_cli"];
        $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
        $resutado = $MC->agg_carrito_servicios($id, $id_usua);
        echo json_encode($resutado, JSON_UNESCAPED_UNICODE);
    } else {
        echo 100;
    }
    exit();
}

/////////////////////////////////////////////
if ($_POST["funcion"] === "mostrar_tu_carrito") {

    if (isset($_SESSION["id_cli"]) && isset($_SESSION["nombre_cli"])) {

        $id_cli = $_SESSION['id_cli'];
        $data = $MC->mostrar_tu_carrito($id_cli);
        //jason encode para retornar los datos
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    } else {
        echo 100;
    }

    exit();
}

/////////////////////////////////////////////
if ($_POST["funcion"] === "vaciar_carrito") {

    if (isset($_SESSION["id_cli"]) && isset($_SESSION["nombre_cli"])) {

        $id_cli = $_SESSION['id_cli'];
        $data = $MC->vaciar_carrito($id_cli);
        //jason encode para retornar los datos
        echo $data;
    } else {
        echo 100;
    }

    exit();
}

///////////////////////////////////////////// 
if ($_POST["funcion"] === "mostrar_carrito_compra_detalle") {
    if (isset($_SESSION["id_cli"]) && isset($_SESSION["nombre_cli"])) {
        $id_cli = $_SESSION['id_cli'];
        $data = $MC->mostrar_carrito_compra_detalle($id_cli);
        //jason encode para retornar los datos
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    } else {
        echo 100;
    }
    exit();
}

///////////////////////////////////////////// 
if ($_POST["funcion"] === "mostrar_carrito_servicios") {
    if (isset($_SESSION["id_cli"]) && isset($_SESSION["nombre_cli"])) {
        $id_cli = $_SESSION['id_cli'];
        $data = $MC->mostrar_carrito_servicios($id_cli);
        //jason encode para retornar los datos
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    } else {
        echo 100;
    }
    exit();
}

///////////////////////////////////////////// 
if ($_POST["funcion"] === "listar_vehoculo_cliente") {
    if (isset($_SESSION["id_cli"]) && isset($_SESSION["nombre_cli"])) {
        $id_cli = $_SESSION['id_cli'];
        $data = $MC->listar_vehoculo_cliente($id_cli);
        //jason encode para retornar los datos
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    } else {
        echo 100;
    }
    exit();
}

///////////////////////////////////////////// 
if ($_POST["funcion"] === "quitar_servicio_detalle") {

    $id_cli = htmlspecialchars($_POST['id_cli'], ENT_QUOTES, 'UTF-8');
    $id_serv = htmlspecialchars($_POST['id_serv'], ENT_QUOTES, 'UTF-8');

    $data = $MC->quitar_servicio_detalle($id_cli, $id_serv);
    //jason encode para retornar los datos
    echo $data;

    exit();
}

///////////////////////////////////////////// 
if ($_POST["funcion"] === "cantidad_producto_carrito") {
    if (isset($_SESSION["id_cli"]) && isset($_SESSION["nombre_cli"])) {

        $idcli = htmlspecialchars($_POST['idcli'], ENT_QUOTES, 'UTF-8');
        $idpro = htmlspecialchars($_POST['idpro'], ENT_QUOTES, 'UTF-8');
        $cant = htmlspecialchars($_POST['cant'], ENT_QUOTES, 'UTF-8');

        $data = $MC->cantidad_producto_carrito($idcli, $idpro, $cant);
        //jason encode para retornar los datos
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }
    exit();
}

///////////////////////////////////////////// 
if ($_POST["funcion"] === "quitar_producto_detalle") {

    $id_cli = htmlspecialchars($_POST['id_cli'], ENT_QUOTES, 'UTF-8');
    $id_pro = htmlspecialchars($_POST['id_pro'], ENT_QUOTES, 'UTF-8');

    $data = $MC->quitar_producto_detalle($id_cli, $id_pro);
    //jason encode para retornar los datos
    echo $data;

    exit();
}

///////////////////////////////////////////// 
if ($_POST["funcion"] === "registrapago_paypal") {

    $id_cli = $_SESSION['id_cli'];
    // esta es la fecha correcta
    date_default_timezone_set('America/Guayaquil');
    $fecha_venta = date('Y-m-d');
    $numero = date("YmdHms");

    $sub = htmlspecialchars($_POST['sub'], ENT_QUOTES, 'UTF-8');
    $iva = htmlspecialchars($_POST['iva'], ENT_QUOTES, 'UTF-8');
    $total = htmlspecialchars($_POST['total'], ENT_QUOTES, 'UTF-8');
    $count = htmlspecialchars($_POST['count'], ENT_QUOTES, 'UTF-8');
    $impuesto = htmlspecialchars($_POST['impuesto'], ENT_QUOTES, 'UTF-8');
    $tipo_doc = htmlspecialchars($_POST['tipo_doc'], ENT_QUOTES, 'UTF-8');
    $numero_doc = $numero;

    $data = $MC->ingreso_de_compra_paypal($id_cli, $sub, $iva, $total, $count, $impuesto, $tipo_doc, $numero_doc, $fecha_venta);
    echo $data;

    exit();
}

///////////////////////////////////////////// 
if ($_POST["funcion"] === "registrar_detalle_compra") {

    $id_cli = $_SESSION['id_cli'];
    $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');

    $data = $MC->registrar_detalle_compra($id_cli, $id);
    echo json_encode($data, JSON_UNESCAPED_UNICODE);

    exit();
}

////////////////////
///////////////////////////////////// 
if ($_POST["funcion"] === "realizar_reservar_cliente") {

    $fecha_inicio = htmlspecialchars($_POST['fecha_inicio'], ENT_QUOTES, 'UTF-8');
    $fecha = htmlspecialchars($_POST['fecha'], ENT_QUOTES, 'UTF-8');
    $hora = htmlspecialchars($_POST['hora'], ENT_QUOTES, 'UTF-8');
    $asunto = htmlspecialchars($_POST['asunto'], ENT_QUOTES, 'UTF-8');
    $nota = htmlspecialchars($_POST['nota'], ENT_QUOTES, 'UTF-8');
    $id_cliente = $_SESSION["id_cli"];

    date_default_timezone_set('America/Guayaquil');
    $time_hoy = date('H:i:s', time());
    $fecha_hoy = date("Y-m-d");
    $hora_very  =  $hora . ":00";

    $inicio = "08:30:00";
    $fin = "17:30:00";

    if ($fecha === $fecha_hoy) {
        if ($hora_very > $time_hoy) {
            if ($hora_very > $inicio || $hora_very === $inicio) {

                if ($hora_very < $fin) {

                    $resutado = $MC->registrar_cita_reserva($fecha_inicio, $asunto, $nota, $id_cliente, $fecha, $hora);
                    echo json_encode($resutado, JSON_UNESCAPED_UNICODE);
                } else {
                    echo 20;
                }
            } else {
                echo 20;
            }
        } else {
            echo 10;
        }
    } else {
        if ($hora_very > $inicio || $hora_very === $inicio) {

            if ($hora_very < $fin) {

                $resutado = $MC->registrar_cita_reserva($fecha_inicio, $asunto, $nota, $id_cliente, $fecha, $hora);
                echo json_encode($resutado, JSON_UNESCAPED_UNICODE);
            } else {
                echo 20;
            }
        } else {
            echo 20;
        }
    }

    exit();
}

///////////////////////////////////////////// 
if ($_POST["funcion"] === "registrapago_paypal_servicio") {

    $color = "#FFFFFF";
    $color_etiqueta = "#ff0000";

    $fecha_inicio = htmlspecialchars($_POST['fecha_inicio'], ENT_QUOTES, 'UTF-8');
    // $fecha = htmlspecialchars($_POST['fecha'], ENT_QUOTES, 'UTF-8');
    // $hora = htmlspecialchars($_POST['hora'], ENT_QUOTES, 'UTF-8');
    $asunto = htmlspecialchars($_POST['asunto'], ENT_QUOTES, 'UTF-8');
    $nota = htmlspecialchars($_POST['nota'], ENT_QUOTES, 'UTF-8');
    $id_cli = $_SESSION['id_cli'];

    $vehiculo = htmlspecialchars($_POST['vehiculo'], ENT_QUOTES, 'UTF-8');
    $total_ser = htmlspecialchars($_POST['total_ser'], ENT_QUOTES, 'UTF-8');

    // esta es la fecha correcta
    date_default_timezone_set('America/Guayaquil');
    $fecha_venta = date('Y-m-d');
    $numero = date("YmdHms");

    $sub = htmlspecialchars($_POST['sub'], ENT_QUOTES, 'UTF-8');
    $iva = htmlspecialchars($_POST['iva'], ENT_QUOTES, 'UTF-8');
    $total = htmlspecialchars($_POST['total'], ENT_QUOTES, 'UTF-8');

    $impuesto = htmlspecialchars($_POST['impuesto'], ENT_QUOTES, 'UTF-8');
    $tipo_doc = htmlspecialchars($_POST['tipo_doc'], ENT_QUOTES, 'UTF-8');
    $numero_doc = $numero;

    $data = $MC->registrapago_paypal_servicio($color, $color_etiqueta, $fecha_inicio, $asunto, $nota, $id_cli, $vehiculo, $total_ser, $sub, $iva, $total, $impuesto, $tipo_doc, $numero_doc, $fecha_venta);
    echo $data;

    exit();
}

///////////////////////////////////////////// 
if ($_POST["funcion"] === "registrar_detalle_sericio_paypal") {

    $id_cli = $_SESSION['id_cli'];
    $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');

    $data = $MC->registrar_detalle_sericio_paypal($id_cli, $id);
    echo $data;

    exit();
}

///////////////////////////////////////////// 
if ($_POST["funcion"] === "registrar_detalle_producto_servicio_paypal") {

    $id_cli = $_SESSION['id_cli'];
    $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');

    $data = $MC->registrar_detalle_producto_servicio_paypal($id_cli, $id);
    echo $data;

    exit();
}


////////// datos cliente usuario
///////////////////////////////////// 
if ($_POST["funcion"] === "traer_datos_cliente") {
    $id =  $_SESSION["id_cli"];
    $consulta = $MC->traer_datos_cliente($id);
    $datos = json_encode($consulta, JSON_UNESCAPED_UNICODE);
    if (count($consulta) > 0) {
        echo $datos;
    } else {
        echo 0;
    }
    exit();
}

////////////////////
if ($_POST["funcion"] === "registrar_cliente_usuario") {

    $id =  $_SESSION["id_cli"];
    $nombre = htmlspecialchars($_POST['nombre'], ENT_QUOTES, 'UTF-8');
    $apellidos = htmlspecialchars($_POST['apellidos'], ENT_QUOTES, 'UTF-8');
    $direccion = htmlspecialchars($_POST['direccion'], ENT_QUOTES, 'UTF-8');
    $telefonoo = htmlspecialchars($_POST['telefonoo'], ENT_QUOTES, 'UTF-8');
    $correo = htmlspecialchars($_POST['correo'], ENT_QUOTES, 'UTF-8');
    $fecha = htmlspecialchars($_POST['fecha'], ENT_QUOTES, 'UTF-8');
    $sexo = htmlspecialchars($_POST['sexo'], ENT_QUOTES, 'UTF-8');
    $cedula = htmlspecialchars($_POST['numero_documento'], ENT_QUOTES, 'UTF-8');

    if (filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        $resutado = $MC->registrar_cliente_usuario($id, $nombre, $apellidos, $direccion, $telefonoo, $correo, $fecha, $sexo, $cedula);
        echo $resutado;
    } else {
        echo 20;
    }

    exit();
}

/////////////////////
if ($_POST["funcion"] === "listado_ventas_cliente") {
    $id =  $_SESSION["id_cli"];
    $data = $MC->listado_ventas_cliente($id);
    //jason encode para retornar los datos
    if ($data) {
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    } else {
        //este codigo sale cuando no se ecnuentra datos
        echo '{
        "sEcho": 1,
        "iTotalRecords": "0",
        "iTotalDisplayRecords": "0",
        "aaData": []
    }';
    }
    exit();
}

/////////////////////
if ($_POST["funcion"] === "lisra_servicios_clientes_usuario") {
    $id =  $_SESSION["id_cli"];
    $data = $MC->lisra_servicios_clientes_usuario($id);
    //jason encode para retornar los datos
    if ($data) {
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    } else {
        //este codigo sale cuando no se ecnuentra datos
        echo '{
        "sEcho": 1,
        "iTotalRecords": "0",
        "iTotalDisplayRecords": "0",
        "aaData": []
    }';
    }
    exit();
}

/////////////////////
if ($_POST["funcion"] === "listar_reservass_clientes_usuario") {
    $id =  $_SESSION["id_cli"];
    $data = $MC->listar_reservass_clientes_usuario($id);
    //jason encode para retornar los datos
    if ($data) {
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    } else {
        //este codigo sale cuando no se ecnuentra datos
        echo '{
        "sEcho": 1,
        "iTotalRecords": "0",
        "iTotalDisplayRecords": "0",
        "aaData": []
    }';
    }
    exit();
}

/////////////////////
if ($_POST["funcion"] === "listar_vehculos_clientess_usuario") {
    $id =  $_SESSION["id_cli"];
    $data = $MC->listar_vehculos_clientess_usuario($id);
    //jason encode para retornar los datos
    if ($data) {
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    } else {
        //este codigo sale cuando no se ecnuentra datos
        echo '{
        "sEcho": 1,
        "iTotalRecords": "0",
        "iTotalDisplayRecords": "0",
        "aaData": []
    }';
    }
    exit();
}