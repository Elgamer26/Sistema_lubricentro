<?php
require '../../modelo/modelo_servicio.php';
$MS = new modelo_servicio();
session_start();

///////////////////////////////////// 
if ($_POST["funcion"] === "registrar_servicio") {

    $servicio = htmlspecialchars($_POST['servicio'], ENT_QUOTES, 'UTF-8');
    $precio = htmlspecialchars($_POST['precio'], ENT_QUOTES, 'UTF-8');
    $detalle = htmlspecialchars($_POST['detalle'], ENT_QUOTES, 'UTF-8');    
    $nombrearchivo = htmlspecialchars($_POST['nombrearchivo'], ENT_QUOTES, 'UTF-8');
    //esto es para saber si el file trae datos
    if (is_array($_FILES) && count($_FILES) > 0) {
        $ruta = "img/servicio/$nombrearchivo";

        $consulta = $MS->registrar_servicio($servicio, $precio, $detalle, $ruta);
 
        if ($consulta == 1) {
            if (move_uploaded_file($_FILES['foto']["tmp_name"], "../../img/servicio/" . $nombrearchivo)) {
                echo $consulta;
            } else {
                echo 10;
            }
        } else {
            echo $consulta;
        }
    } else {
        $ruta = "img/servicio/servicio.jpg";
        $consulta = $MS->registrar_servicio($servicio, $precio, $detalle, $ruta);
        echo $consulta;
    }

    exit();

}

/////////////////////
if ($_POST["funcion"] === "listar_servicios_") {
    // /esta fuencion se encargra de traer los datos del usuario
    $data = $MS->listar_servicios_();
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

///////////////////////////////////// 
if ($_POST["funcion"] === "estado_tipo") {

    $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
    $dato = htmlspecialchars($_POST['dato'], ENT_QUOTES, 'UTF-8');
    $resutado = $MS->estado_tipo($id, $dato);
    echo $resutado;

    exit();
}

///////////////////////////////////// 
if ($_POST["funcion"] === "editar_servicio") {

    $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
    $servicio = htmlspecialchars($_POST['servicio'], ENT_QUOTES, 'UTF-8');
    $precio = htmlspecialchars($_POST['precio'], ENT_QUOTES, 'UTF-8');
    $detalle = htmlspecialchars($_POST['detalle'], ENT_QUOTES, 'UTF-8');
    $resutado = $MS->editar_servicio($id, $servicio, $precio, $detalle);
    echo $resutado;

    exit();
}

///////////////////////////////////// 
if ($_POST["funcion"] === "cambiar_foto_servicio") {

    $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
    $nombrearchivo = htmlspecialchars($_POST["nombrearchivo"], ENT_QUOTES, 'UTF-8');
    $ruta_actual = htmlspecialchars($_POST["ruta_actual"], ENT_QUOTES, 'UTF-8');

    //esto es para saber si el file trae datos
    if (is_array($_FILES) && count($_FILES) > 0) {
        if ($ruta_actual != "img/servicio/servicio.jpg") {
            $delete = $ruta_actual;
            unlink("../../" . $delete);
        }

        $ruta = "img/servicio/$nombrearchivo";
        $consulta = $MS->cambiar_foto_servicio($id, $ruta);
        if ($consulta == 1) {
            if (move_uploaded_file($_FILES['foto']["tmp_name"], "../../img/servicio/" . $nombrearchivo)) {
                echo $consulta;
            } else {
                echo 10;
            }
        } else {
            echo $consulta;
        }
    } else {
        echo 0;
    }

    exit();
}

////////////////////
if ($_POST["funcion"] === "registrar_cliente") {

    $nombre = htmlspecialchars($_POST['nombre'], ENT_QUOTES, 'UTF-8');
    $apellidos = htmlspecialchars($_POST['apellidos'], ENT_QUOTES, 'UTF-8');
    $direccion = htmlspecialchars($_POST['direccion'], ENT_QUOTES, 'UTF-8');
    $telefonoo = htmlspecialchars($_POST['telefonoo'], ENT_QUOTES, 'UTF-8');
    $correo = htmlspecialchars($_POST['correo'], ENT_QUOTES, 'UTF-8');
    $fecha = htmlspecialchars($_POST['fecha'], ENT_QUOTES, 'UTF-8');
    $sexo = htmlspecialchars($_POST['sexo'], ENT_QUOTES, 'UTF-8');
    $cedula = htmlspecialchars($_POST['numero_documento'], ENT_QUOTES, 'UTF-8');

    if (filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        $resutado = $MS->registrar_cliente($nombre, $apellidos, $direccion, $telefonoo, $correo, $fecha, $sexo, $cedula);
        echo $resutado;
    } else {
        echo 20;
    }

    exit();
}

/////////////////////
if ($_POST["funcion"] === "listar_clientes") {
    // /esta fuencion se encargra de traer los datos del usuario
    $data = $MS->listar_clientes();
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

///////////////////////////////////// 
if ($_POST["funcion"] === "estado_cliente") {

    $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
    $dato = htmlspecialchars($_POST['dato'], ENT_QUOTES, 'UTF-8');
    $resutado = $MS->estado_cliente($id, $dato);
    echo $resutado;

    exit();
}

////////////////////
if ($_POST["funcion"] === "editar_clientee") {

    $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
    $nombre = htmlspecialchars($_POST['nombre'], ENT_QUOTES, 'UTF-8');
    $apellidos = htmlspecialchars($_POST['apellidos'], ENT_QUOTES, 'UTF-8');
    $direccion = htmlspecialchars($_POST['direccion'], ENT_QUOTES, 'UTF-8');
    $telefonoo = htmlspecialchars($_POST['telefonoo'], ENT_QUOTES, 'UTF-8');
    $correo = htmlspecialchars($_POST['correo'], ENT_QUOTES, 'UTF-8');
    $fecha = htmlspecialchars($_POST['fecha'], ENT_QUOTES, 'UTF-8');
    $sexo = htmlspecialchars($_POST['sexo'], ENT_QUOTES, 'UTF-8');
    $cedula = htmlspecialchars($_POST['numero_documento'], ENT_QUOTES, 'UTF-8');

    if (filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        $resutado = $MS->editar_clientee($id, $nombre, $apellidos, $direccion, $telefonoo, $correo, $fecha, $sexo, $cedula);
        echo $resutado;
    } else {
        echo 20;
    }

    exit();
}

/////////////////////
if ($_POST["funcion"] === "listado_clientesss") {
    // /esta fuencion se encargra de traer los datos del usuario
    $data = $MS->listado_clientesss();
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

///////////////////////////////////// 
if ($_POST["funcion"] === "registrar_cita") {

    $fecha_inicio = htmlspecialchars($_POST['fecha_inicio'], ENT_QUOTES, 'UTF-8');
    $color = htmlspecialchars($_POST['color'], ENT_QUOTES, 'UTF-8');
    $color_etiqueta = htmlspecialchars($_POST['color_etiqueta'], ENT_QUOTES, 'UTF-8');
    $asunto = htmlspecialchars($_POST['asunto'], ENT_QUOTES, 'UTF-8');
    $nota = htmlspecialchars($_POST['nota'], ENT_QUOTES, 'UTF-8');
    $id_cliente = htmlspecialchars($_POST['id_cliente'], ENT_QUOTES, 'UTF-8');
    $fecha = htmlspecialchars($_POST['fecha'], ENT_QUOTES, 'UTF-8');
    $hora = htmlspecialchars($_POST['hora'], ENT_QUOTES, 'UTF-8');

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

                    $resutado = $MS->registrar_cita($fecha_inicio, $color, $color_etiqueta, $asunto, $nota, $id_cliente, $fecha, $hora);
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

                $resutado = $MS->registrar_cita($fecha_inicio, $color, $color_etiqueta, $asunto, $nota, $id_cliente, $fecha, $hora);
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

/////////////////////////////////////
///esta fuencion se encargra de editar la cita
if ($_POST["funcion"] === "editar_cita") {

    $id_cita = htmlspecialchars($_POST['id_cita'], ENT_QUOTES, 'UTF-8');
    $fecha_inicio = htmlspecialchars($_POST['fecha_inicio'], ENT_QUOTES, 'UTF-8');
    $color = htmlspecialchars($_POST['color'], ENT_QUOTES, 'UTF-8');
    $color_etiqueta = htmlspecialchars($_POST['color_etiqueta'], ENT_QUOTES, 'UTF-8');
    $asunto = htmlspecialchars($_POST['asunto'], ENT_QUOTES, 'UTF-8');
    $nota = htmlspecialchars($_POST['nota'], ENT_QUOTES, 'UTF-8');
    $id_cliente = htmlspecialchars($_POST['id_cliente'], ENT_QUOTES, 'UTF-8');
    $fecha = htmlspecialchars($_POST['fecha'], ENT_QUOTES, 'UTF-8');
    $hora = htmlspecialchars($_POST['hora'], ENT_QUOTES, 'UTF-8');

    date_default_timezone_set('America/Guayaquil');
    $fecha_hoy = date("Y-m-d");

    if ($fecha >= $fecha_hoy) {
        $resutado = $MS->editar_cita($id_cita, $fecha_inicio, $color, $color_etiqueta, $asunto, $nota, $id_cliente, $fecha, $hora);
        echo $resutado;
    } else {
        echo 10;
    }

    exit();
}

if ($_POST["funcion"] === "registrar_vehiculo") {

    $vehiculo = htmlspecialchars($_POST['vehiculo'], ENT_QUOTES, 'UTF-8');
    $resutado = $MS->registrar_vehiculo($vehiculo);
    echo $resutado;

    exit();
}

/////////////////////
if ($_POST["funcion"] === "listar_vehiculo") {
    // /esta fuencion se encargra de traer los datos del usuario
    $data = $MS->listar_vehiculo();
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

///////////////////////////////////// 
if ($_POST["funcion"] === "estado_vehiculo") {

    $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
    $dato = htmlspecialchars($_POST['dato'], ENT_QUOTES, 'UTF-8');
    $resutado = $MS->estado_vehiculo($id, $dato);
    echo $resutado;

    exit();
}

if ($_POST["funcion"] === "editar_vehiculo") {

    $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
    $vehiculo = htmlspecialchars($_POST['vehiculo'], ENT_QUOTES, 'UTF-8');
    $resutado = $MS->editar_vehiculo($vehiculo, $id);
    echo $resutado;

    exit();
}

if ($_POST["funcion"] === "listar_cliente_combo") {

    $resutado = $MS->listar_cliente_combo();
    echo json_encode($resutado, JSON_UNESCAPED_UNICODE);

    exit();
}

if ($_POST["funcion"] === "listar_tpi_vehculo_combo") {

    $resutado = $MS->listar_tpi_vehculo_combo();
    echo json_encode($resutado, JSON_UNESCAPED_UNICODE);

    exit();
}

if ($_POST["funcion"] === "listar_marca_combo") {

    $resutado = $MS->listar_marca_combo();
    echo json_encode($resutado, JSON_UNESCAPED_UNICODE);

    exit();
}

///////////////////////////////////// 
if ($_POST["funcion"] === "registrar_marca") {

    $marca = htmlspecialchars($_POST['marca'], ENT_QUOTES, 'UTF-8');
    $resutado = $MS->registrar_marca($marca);
    echo $resutado;

    exit();
}

/////////////////////
if ($_POST["funcion"] === "listar_marcha_vehiculo") {
    // /esta fuencion se encargra de traer los datos del usuario
    $data = $MS->listar_marcha_vehiculo();
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

///////////////////////////////////// 
if ($_POST["funcion"] === "cambiar_estado_m_hiculo") {

    $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
    $dato = htmlspecialchars($_POST['dato'], ENT_QUOTES, 'UTF-8');
    $resutado = $MS->cambiar_estado_m_hiculo($id, $dato);
    echo $resutado;

    exit();
}

///////////////////////////////////// 
if ($_POST["funcion"] === "editar_marca_vehocuo") {

    $marca = htmlspecialchars($_POST['marca'], ENT_QUOTES, 'UTF-8');
    $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
    $resutado = $MS->editar_marca_vehocuo($marca, $id);
    echo $resutado;

    exit();
}

////////////
///////////////////////////////////// 
if ($_POST["funcion"] === "registra_vehoculo_cliente") {

    $cliente = htmlspecialchars($_POST['cliente'], ENT_QUOTES, 'UTF-8');
    $fecha = htmlspecialchars($_POST['fecha'], ENT_QUOTES, 'UTF-8');
    $tipo_vehoculo = htmlspecialchars($_POST['tipo_vehoculo'], ENT_QUOTES, 'UTF-8');
    $tipo_marca = htmlspecialchars($_POST['tipo_marca'], ENT_QUOTES, 'UTF-8');
    $matrcula = htmlspecialchars($_POST['matrcula'], ENT_QUOTES, 'UTF-8');
    $color = htmlspecialchars($_POST['color'], ENT_QUOTES, 'UTF-8');
    $detalle = htmlspecialchars($_POST['detalle'], ENT_QUOTES, 'UTF-8');

    $nombrearchivo = htmlspecialchars($_POST['nombrearchivo'], ENT_QUOTES, 'UTF-8');
    //esto es para saber si el file trae datos
    if (is_array($_FILES) && count($_FILES) > 0) {
        $ruta = "img/vehiculo/$nombrearchivo";
        $consulta = $MS->registra_vehoculo_cliente($cliente, $fecha, $tipo_vehoculo, $tipo_marca, $matrcula, $color, $detalle, $ruta);
        if ($consulta == 1) {
            if (move_uploaded_file($_FILES['foto']["tmp_name"], "../../img/vehiculo/" . $nombrearchivo)) {
                echo $consulta;
            } else {
                echo 10;
            }
        } else {
            echo $consulta;
        }
    } else {
        $ruta = "img/vehiculo/vehiculo.jpg";
        $consulta = $MS->registra_vehoculo_cliente($cliente, $fecha, $tipo_vehoculo, $tipo_marca, $matrcula, $color, $detalle, $ruta);
        echo $consulta;
    }

    exit();
}

///////////////////////////////////// 
if ($_POST["funcion"] === "cambiar_foto_vehoculo") {

    $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
    $nombrearchivo = htmlspecialchars($_POST["nombrearchivo"], ENT_QUOTES, 'UTF-8');
    $ruta_actual = htmlspecialchars($_POST["ruta_actual"], ENT_QUOTES, 'UTF-8');
    //esto es para saber si el file trae datos
    if (is_array($_FILES) && count($_FILES) > 0) {
        if ($ruta_actual != "img/vehiculo/vehiculo.jpg") {
            $delete = $ruta_actual;
            unlink("../../" . $delete);
        }

        $ruta = "img/vehiculo/$nombrearchivo";
        $consulta = $MS->cambiar_foto_vehoculo($id, $ruta);
        if ($consulta == 1) {
            if (move_uploaded_file($_FILES['foto']["tmp_name"], "../../img/vehiculo/" . $nombrearchivo)) {
                echo $nombrearchivo;
            } else {
                echo 10;
            }
        } else {
            echo $consulta;
        }
    } else {
        echo 0;
    }

    exit();
}

/////////////////////
if ($_POST["funcion"] === "listar_vehculos_clientess") {
    // /esta fuencion se encargra de traer los datos del usuario
    $data = $MS->listar_vehculos_clientess();
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

///////////////////////////////////// 
if ($_POST["funcion"] === "cambiar_estado_vehiculo_registro_cli") {

    $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
    $dato = htmlspecialchars($_POST['dato'], ENT_QUOTES, 'UTF-8');
    $resutado = $MS->cambiar_estado_vehiculo_registro_cli($id, $dato);
    echo $resutado;

    exit();
}

///////////////////////////////////// 
if ($_POST["funcion"] === "editar_vehiculo_cliente") {

    $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
    $cliente = htmlspecialchars($_POST['cliente'], ENT_QUOTES, 'UTF-8');
    $fecha = htmlspecialchars($_POST['fecha'], ENT_QUOTES, 'UTF-8');
    $tipo_vehoculo = htmlspecialchars($_POST['tipo_vehoculo'], ENT_QUOTES, 'UTF-8');
    $tipo_marca = htmlspecialchars($_POST['tipo_marca'], ENT_QUOTES, 'UTF-8');
    $matrcula = htmlspecialchars($_POST['matrcula'], ENT_QUOTES, 'UTF-8');
    $color = htmlspecialchars($_POST['color'], ENT_QUOTES, 'UTF-8');
    $detalle = htmlspecialchars($_POST['detalle'], ENT_QUOTES, 'UTF-8');

    $consulta = $MS->editar_vehiculo_cliente($id, $cliente, $fecha, $tipo_vehoculo, $tipo_marca, $matrcula, $color, $detalle);
    echo $consulta;


    exit();
}

/////////////////////
if ($_POST["funcion"] === "listar_clientes_agg") {
    // /esta fuencion se encargra de traer los datos del usuario
    $data = $MS->listar_clientes_agg();
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
if ($_POST["funcion"] === "listado_prodcutos_venta_agg") {
    // /esta fuencion se encargra de traer los datos del usuario
    $data = $MS->listado_prodcutos_venta_agg();
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

///////////////////////////////////// 
if ($_POST["funcion"] === "traer_promocion_prod") {

    $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
    $consulta = $MS->traer_promocion_prod($id);
    echo json_encode($consulta, JSON_UNESCAPED_UNICODE);

    exit();
}

///////////////////////////////////// 
if ($_POST["funcion"] === "registrar_venta") {

    $id = $_SESSION["id_usu"];
    $id_cliente = htmlspecialchars($_POST['id_cliente'], ENT_QUOTES, 'UTF-8');
    $impuesto = htmlspecialchars($_POST['impuesto'], ENT_QUOTES, 'UTF-8');
    $tipo_comprobante = htmlspecialchars($_POST['tipo_comprobante'], ENT_QUOTES, 'UTF-8');
    $num_compro = htmlspecialchars($_POST['num_compro'], ENT_QUOTES, 'UTF-8');
    $fecha_venta = htmlspecialchars($_POST['fecha_venta'], ENT_QUOTES, 'UTF-8');
    $count = htmlspecialchars($_POST['count'], ENT_QUOTES, 'UTF-8');
    $txt_totalneto = htmlspecialchars($_POST['txt_totalneto'], ENT_QUOTES, 'UTF-8');
    $txt_impuesto = htmlspecialchars($_POST['txt_impuesto'], ENT_QUOTES, 'UTF-8');
    $txt_a_pagar = htmlspecialchars($_POST['txt_a_pagar'], ENT_QUOTES, 'UTF-8');

    $consulta = $MS->registrar_venta($id_cliente, $impuesto, $tipo_comprobante, $num_compro, $fecha_venta, $count, $txt_totalneto, $txt_impuesto, $txt_a_pagar, $id);
    echo $consulta;

    exit();
}

///////////////////////////////////// 
if ($_POST["funcion"] === "registrar_detalle_venta") {

    $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');

    $idproducto = htmlspecialchars($_POST['idproducto'], ENT_QUOTES, 'UTF-8');
    $cantidad = htmlspecialchars($_POST['cantidad'], ENT_QUOTES, 'UTF-8');
    $precio = htmlspecialchars($_POST['precio'], ENT_QUOTES, 'UTF-8');
    $des_promo = htmlspecialchars($_POST['des_promo'], ENT_QUOTES, 'UTF-8');
    $tipo_promo = htmlspecialchars($_POST['tipo_promo'], ENT_QUOTES, 'UTF-8');
    $descuento_moneda = htmlspecialchars($_POST['descuento_moneda'], ENT_QUOTES, 'UTF-8');
    $subtotal = htmlspecialchars($_POST['subtotal'], ENT_QUOTES, 'UTF-8');

    $arraglo_idproducto = explode(",", $idproducto); //aqui separo los datos
    $arraglo_cantidad = explode(",", $cantidad); //aqui separo los datos
    $arraglo_precio = explode(",", $precio); //aqui separo los datos
    $arraglo_des_promo  = explode(",", $des_promo); //aqui separo los datos
    $arraglo_tipo_promo = explode(",", $tipo_promo); //aqui separo los datos
    $arraglo_descuento_moneda = explode(",", $descuento_moneda); //aqui separo los datos
    $arraglo_subtotal = explode(",", $subtotal); //aqui separo los datos 


    //bucle para contar la cantidad de datos
    for ($i = 0; $i < count($arraglo_idproducto); $i++) {
        $consulta = $MS->registrar_detalle_venta(
            $id,
            $arraglo_idproducto[$i],
            $arraglo_cantidad[$i],
            $arraglo_precio[$i],
            $arraglo_des_promo[$i],
            $arraglo_tipo_promo[$i],
            $arraglo_descuento_moneda[$i],
            $arraglo_subtotal[$i]
        );
    }
    echo $consulta;

    exit();
}

/////////////////////
if ($_POST["funcion"] === "listado_ventas") {
    // /esta fuencion se encargra de traer los datos del usuario
    $data = $MS->listado_ventas();
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

///////////////////////////////////// 
if ($_POST["funcion"] === "detalle_de_venta") {

    $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
    $consulta = $MS->detalle_de_venta($id);
    echo json_encode($consulta, JSON_UNESCAPED_UNICODE);

    exit();
}

///////////////////////////////////// 
if ($_POST["funcion"] === "anula_venta") {
    $id_ussu = $_SESSION["id_usu"];
    $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');

    $consulta = $MS->anular_venta($id, $id_ussu);
    echo json_encode($consulta, JSON_UNESCAPED_UNICODE);

    exit();
}

///////////////////////////////////// 
if ($_POST["funcion"] === "listar_clientes_vehoculos") {
    $data = $MS->listar_clientes_vehoculos();
    //jason encode para retornar los datos
    echo json_encode($data, JSON_UNESCAPED_UNICODE);

    exit();
}

///////////////////////////////////// 
if ($_POST["funcion"] === "traer_datos_vehiculos_clientes") {
    $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
    $data = $MS->traer_datos_vehiculos_clientes($id);
    //jason encode para retornar los datos
    echo json_encode($data, JSON_UNESCAPED_UNICODE);

    exit();
}

///////////////////////////////////// 
if ($_POST["funcion"] === "listar_servicios") {
    $data = $MS->listar_servicios();
    //jason encode para retornar los datos
    echo json_encode($data, JSON_UNESCAPED_UNICODE);

    exit();
}

///////////////////////////////////// 
if ($_POST["funcion"] === "traer_precio_servicios") {
    $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
    $data = $MS->traer_precio_servicios($id);
    //jason encode para retornar los datos
    echo json_encode($data, JSON_UNESCAPED_UNICODE);

    exit();
}

///////////////////////////////////// 
if ($_POST["funcion"] === "registar_servicio_cliente") {

    $id_ussu = $_SESSION["id_usu"];
    $vehculos_id = htmlspecialchars($_POST['vehculos_id'], ENT_QUOTES, 'UTF-8');
    $inpuesto = htmlspecialchars($_POST['inpuesto'], ENT_QUOTES, 'UTF-8');
    $tipo_comprobante = htmlspecialchars($_POST['tipo_comprobante'], ENT_QUOTES, 'UTF-8');
    $num_compro = htmlspecialchars($_POST['num_compro'], ENT_QUOTES, 'UTF-8');
    $fecha = htmlspecialchars($_POST['fecha'], ENT_QUOTES, 'UTF-8');
    $txt_total_servico = htmlspecialchars($_POST['txt_total_servico'], ENT_QUOTES, 'UTF-8');
    $txt_totalneto = htmlspecialchars($_POST['txt_totalneto'], ENT_QUOTES, 'UTF-8');
    $txt_impuesto = htmlspecialchars($_POST['txt_impuesto'], ENT_QUOTES, 'UTF-8');
    $txt_a_pagar = htmlspecialchars($_POST['txt_a_pagar'], ENT_QUOTES, 'UTF-8');

    $consulta = $MS->registar_servicio_cliente($vehculos_id, $inpuesto, $tipo_comprobante, $num_compro, $fecha, $txt_total_servico, $txt_totalneto, $txt_impuesto, $txt_a_pagar, $id_ussu);
    echo $consulta;

    exit();
}

///////////////////////////////////// 
if ($_POST["funcion"] === "registrar_detalle_servicioo") {

    $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');

    $idservicio = htmlspecialchars($_POST['idservicio'], ENT_QUOTES, 'UTF-8');
    $precio = htmlspecialchars($_POST['precio'], ENT_QUOTES, 'UTF-8');
    $cantidad = htmlspecialchars($_POST['cantidad'], ENT_QUOTES, 'UTF-8');
    $descuento = htmlspecialchars($_POST['descuento'], ENT_QUOTES, 'UTF-8');
    $subtotal = htmlspecialchars($_POST['subtotal'], ENT_QUOTES, 'UTF-8');

    $arraglo_idservicio = explode(",", $idservicio); //aqui separo los datos
    $arraglo_precio = explode(",", $precio); //aqui separo los datos
    $arraglo_cantidad = explode(",", $cantidad); //aqui separo los datos
    $arraglo_descuento  = explode(",", $descuento); //aqui separo los datos
    $arraglo_subtotal = explode(",", $subtotal); //aqui separo los datos 


    //bucle para contar la cantidad de datos
    for ($i = 0; $i < count($arraglo_idservicio); $i++) {
        $consulta = $MS->registrar_detalle_servicioo(
            $id,
            $arraglo_idservicio[$i],
            $arraglo_precio[$i],
            $arraglo_cantidad[$i],
            $arraglo_descuento[$i],
            $arraglo_subtotal[$i]
        );
    }
    echo $consulta;

    exit();
}

///////////////////////////////////// 
if ($_POST["funcion"] === "registrar_detalle_producto_servicio") {

    $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');

    $idproducto = htmlspecialchars($_POST['idproducto'], ENT_QUOTES, 'UTF-8');
    $cantidad = htmlspecialchars($_POST['cantidad'], ENT_QUOTES, 'UTF-8');
    $precio = htmlspecialchars($_POST['precio'], ENT_QUOTES, 'UTF-8');
    $des_promo = htmlspecialchars($_POST['des_promo'], ENT_QUOTES, 'UTF-8');
    $tipo_promo = htmlspecialchars($_POST['tipo_promo'], ENT_QUOTES, 'UTF-8');
    $descuento_moneda = htmlspecialchars($_POST['descuento_moneda'], ENT_QUOTES, 'UTF-8');
    $subtotal = htmlspecialchars($_POST['subtotal'], ENT_QUOTES, 'UTF-8');

    $arraglo_idproducto = explode(",", $idproducto); //aqui separo los datos
    $arraglo_cantidad = explode(",", $cantidad); //aqui separo los datos
    $arraglo_precio = explode(",", $precio); //aqui separo los datos
    $arraglo_des_promo  = explode(",", $des_promo); //aqui separo los datos
    $arraglo_tipo_promo = explode(",", $tipo_promo); //aqui separo los datos
    $arraglo_descuento_moneda = explode(",", $descuento_moneda); //aqui separo los datos
    $arraglo_subtotal = explode(",", $subtotal); //aqui separo los datos 

    //bucle para contar la cantidad de datos
    for ($i = 0; $i < count($arraglo_idproducto); $i++) {
        $consulta = $MS->registrar_detalle_producto_servicio(
            $id,
            $arraglo_idproducto[$i],
            $arraglo_cantidad[$i],
            $arraglo_precio[$i],
            $arraglo_des_promo[$i],
            $arraglo_tipo_promo[$i],
            $arraglo_descuento_moneda[$i],
            $arraglo_subtotal[$i]
        );
    }
    echo $consulta;

    exit();
}

/////////////////////
if ($_POST["funcion"] === "lisra_servicios_clientes") {
    // /esta fuencion se encargra de traer los datos del usuario
    $data = $MS->lisra_servicios_clientes();
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

///////////////////////////////////// 
if ($_POST["funcion"] === "cargar_detalle_servciio") {

    $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
    $consulta = $MS->cargar_detalle_servciio($id);
    echo json_encode($consulta, JSON_UNESCAPED_UNICODE);

    exit();
}

///////////////////////////////////// 
if ($_POST["funcion"] === "cargar_detalle_venta_servicio") {

    $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
    $consulta = $MS->cargar_detalle_venta_servicio($id);
    if (!empty($consulta)) {
        echo json_encode($consulta, JSON_UNESCAPED_UNICODE);
    } else {
        echo 0;
    }
    exit();
}

///////////////////////////////////// 
if ($_POST["funcion"] === "anula_servicio_compra") {

    $id_ussu = $_SESSION["id_usu"];
    $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
    $consulta = $MS->anula_servicio_compra($id, $id_ussu);
    echo json_encode($consulta, JSON_UNESCAPED_UNICODE);

    exit();
}

/////////////////////
if ($_POST["funcion"] === "listar_reservass") {
    // /esta fuencion se encargra de traer los datos del usuario
    $data = $MS->listar_reservass();
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

///////////////////////////////////// 
if ($_POST["funcion"] === "atendiendo_servicio_reserva") {

    $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
    $consulta = $MS->atendiendo_servicio_reserva($id);
    echo $consulta;
    exit();
}

///////////////////////////////////// 
if ($_POST["funcion"] === "eliminar_reserva_cliente") {

    $id_cita = htmlspecialchars($_POST['id_cita'], ENT_QUOTES, 'UTF-8');
    $id_reserva = htmlspecialchars($_POST['id_reserva'], ENT_QUOTES, 'UTF-8');
    $consulta = $MS->eliminar_reserva_cliente($id_cita, $id_reserva);
    echo $consulta;
    exit();
}

/////////////////////////////////////  ciente usu
if ($_POST["funcion"] === "editar_vehiculo_cliente_usu") {

    $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
    $cliente = $_SESSION["id_cli"];
    $fecha = htmlspecialchars($_POST['fecha'], ENT_QUOTES, 'UTF-8');
    $tipo_vehoculo = htmlspecialchars($_POST['tipo_vehoculo'], ENT_QUOTES, 'UTF-8');
    $tipo_marca = htmlspecialchars($_POST['tipo_marca'], ENT_QUOTES, 'UTF-8');
    $matrcula = htmlspecialchars($_POST['matrcula'], ENT_QUOTES, 'UTF-8');
    $color = htmlspecialchars($_POST['color'], ENT_QUOTES, 'UTF-8');
    $detalle = htmlspecialchars($_POST['detalle'], ENT_QUOTES, 'UTF-8');

    $consulta = $MS->editar_vehiculo_cliente($id, $cliente, $fecha, $tipo_vehoculo, $tipo_marca, $matrcula, $color, $detalle);
    echo $consulta;

    exit();
}

///////////////////////////////////// 
if ($_POST["funcion"] === "registra_vehoculo_cliente_usu") {

    $cliente = $_SESSION["id_cli"];
    $fecha = htmlspecialchars($_POST['fecha'], ENT_QUOTES, 'UTF-8');
    $tipo_vehoculo = htmlspecialchars($_POST['tipo_vehoculo'], ENT_QUOTES, 'UTF-8');
    $tipo_marca = htmlspecialchars($_POST['tipo_marca'], ENT_QUOTES, 'UTF-8');
    $matrcula = htmlspecialchars($_POST['matrcula'], ENT_QUOTES, 'UTF-8');
    $color = htmlspecialchars($_POST['color'], ENT_QUOTES, 'UTF-8');
    $detalle = htmlspecialchars($_POST['detalle'], ENT_QUOTES, 'UTF-8');

    $nombrearchivo = htmlspecialchars($_POST['nombrearchivo'], ENT_QUOTES, 'UTF-8');
    //esto es para saber si el file trae datos
    if (is_array($_FILES) && count($_FILES) > 0) {
        $ruta = "img/vehiculo/$nombrearchivo";
        $consulta = $MS->registra_vehoculo_cliente($cliente, $fecha, $tipo_vehoculo, $tipo_marca, $matrcula, $color, $detalle, $ruta);
        if ($consulta == 1) {
            if (move_uploaded_file($_FILES['foto']["tmp_name"], "../../img/vehiculo/" . $nombrearchivo)) {
                echo $consulta;
            } else {
                echo 10;
            }
        } else {
            echo $consulta;
        }
    } else {
        $ruta = "img/vehiculo/vehiculo.jpg";
        $consulta = $MS->registra_vehoculo_cliente($cliente, $fecha, $tipo_vehoculo, $tipo_marca, $matrcula, $color, $detalle, $ruta);
        echo $consulta;
    }

    exit();
}
