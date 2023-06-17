<?php
require '../../modelo/modelo_producto.php';
$MTP = new modelo_producto();
session_start();

///////////////////////////////////// 
if ($_POST["funcion"] === "registrar_tipo") {

    $tipo_producto = htmlspecialchars($_POST['tipo_producto'], ENT_QUOTES, 'UTF-8');
    $resutado = $MTP->registrar_tipo($tipo_producto);
    echo $resutado;

    exit();
}

///////////////
if ($_POST["funcion"] === "listar_tipo_") {
    // /esta fuencion se encargra de traer los datos del usuario
    $data = $MTP->listar_tipo_();
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
    $resutado = $MTP->estado_tipo($id, $dato);
    echo $resutado;

    exit();
}

///////////////////////////////////// 
if ($_POST["funcion"] === "editar_tipo__") {

    $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
    $tipo_producto = htmlspecialchars($_POST['tipo_producto'], ENT_QUOTES, 'UTF-8');
    $resutado = $MTP->editar_tipo__($id, $tipo_producto);
    echo $resutado;

    exit();
}

///////////////////////////////////// 
if ($_POST["funcion"] === "registrar_marca") {

    $marca_pro = htmlspecialchars($_POST['marca_pro'], ENT_QUOTES, 'UTF-8');
    $resutado = $MTP->registrar_marca($marca_pro);
    echo $resutado;

    exit();
}

///////////////
if ($_POST["funcion"] === "listar_marcas") {
    // /esta fuencion se encargra de traer los datos del usuario
    $data = $MTP->listar_marcas();
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
if ($_POST["funcion"] === "estado_marca") {

    $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
    $dato = htmlspecialchars($_POST['dato'], ENT_QUOTES, 'UTF-8');
    $resutado = $MTP->estado_marca($id, $dato);
    echo $resutado;

    exit();
}

///////////////////////////////////// 
if ($_POST["funcion"] === "editar__marca") {

    $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
    $marca_edit = htmlspecialchars($_POST['marca_edit'], ENT_QUOTES, 'UTF-8');
    $resutado = $MTP->editar__marca($id, $marca_edit);
    echo $resutado;

    exit();
}

///////////////////////////////////// 
if ($_POST["funcion"] === "listar_tipo_producto") {
    $data = $MTP->listar_tipo_producto();
    //jason encode para retornar los datos
    echo json_encode($data, JSON_UNESCAPED_UNICODE);

    exit();
}

///////////////////////////////////// 
if ($_POST["funcion"] === "listar_marca_producto") {
    $data = $MTP->listar_marca_producto();
    //jason encode para retornar los datos
    echo json_encode($data, JSON_UNESCAPED_UNICODE);

    exit();
}

///////////////////////////////////// 
if ($_POST["funcion"] === "registra_producto") {

    $codigo = htmlspecialchars($_POST['codigo'], ENT_QUOTES, 'UTF-8');
    $nombre = htmlspecialchars($_POST['nombre'], ENT_QUOTES, 'UTF-8');
    $tipo = htmlspecialchars($_POST['tipo'], ENT_QUOTES, 'UTF-8');
    $marca = htmlspecialchars($_POST['marca'], ENT_QUOTES, 'UTF-8');
    $detalle = htmlspecialchars($_POST['detalle'], ENT_QUOTES, 'UTF-8');
    $precio = htmlspecialchars($_POST['precio'], ENT_QUOTES, 'UTF-8');

    $equiva = htmlspecialchars($_POST['equiva'], ENT_QUOTES, 'UTF-8');
    $especifi = htmlspecialchars($_POST['especifi'], ENT_QUOTES, 'UTF-8');

    $nombrearchivo = htmlspecialchars($_POST['nombrearchivo'], ENT_QUOTES, 'UTF-8');
    //esto es para saber si el file trae datos
    if (is_array($_FILES) && count($_FILES) > 0) {
        $ruta = "img/producto/$nombrearchivo";
        $consulta = $MTP->registrar_producto($codigo, $nombre, $tipo, $marca, $detalle, $precio, $ruta, $equiva, $especifi);
        if ($consulta == 1) {
            if (move_uploaded_file($_FILES['foto']["tmp_name"], "../../img/producto/" . $nombrearchivo)) {
                echo $consulta;
            } else {
                echo 10;
            }
        } else {
            echo $consulta;
        }
    } else {
        $ruta = "img/producto/producto.jpg";
        $consulta = $MTP->registrar_producto($codigo, $nombre, $tipo, $marca, $detalle, $precio, $ruta, $equiva, $especifi);
        echo $consulta;
    }

    exit();
}

///////////////
if ($_POST["funcion"] === "listar_producto") {
    // /esta fuencion se encargra de traer los datos del usuario
    $data = $MTP->listar_producto();
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
if ($_POST["funcion"] === "cambiar_foto_producto") {

    $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
    $nombrearchivo = htmlspecialchars($_POST["nombrearchivo"], ENT_QUOTES, 'UTF-8');
    $ruta_actual = htmlspecialchars($_POST["ruta_actual"], ENT_QUOTES, 'UTF-8');
    //esto es para saber si el file trae datos
    if (is_array($_FILES) && count($_FILES) > 0) {
        if ($ruta_actual != "img/producto/producto.jpg") {
            $delete = $ruta_actual;
            unlink("../../" . $delete);
        }

        $ruta = "img/producto/$nombrearchivo";
        $consulta = $MTP->editar_foto_producto($id, $ruta);
        if ($consulta == 1) {
            if (move_uploaded_file($_FILES['foto']["tmp_name"], "../../img/producto/" . $nombrearchivo)) {
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

///////////////////////////////////// 
if ($_POST["funcion"] === "estado_producto") {
    $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
    $estado = htmlspecialchars($_POST["res"], ENT_QUOTES, 'UTF-8');
    $consulta = $MTP->cambiar_estado_producto($id, $estado);
    echo $consulta;
    exit();
}

///////////////////////////////////// 
if ($_POST["funcion"] === "editar_producto") {
    $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
    $codigo = htmlspecialchars($_POST["codigo"], ENT_QUOTES, 'UTF-8');
    $nombre = htmlspecialchars($_POST["nombre"], ENT_QUOTES, 'UTF-8');
    $tipo = htmlspecialchars($_POST["tipo"], ENT_QUOTES, 'UTF-8');
    $marca = htmlspecialchars($_POST["marca"], ENT_QUOTES, 'UTF-8');
    $detalle = htmlspecialchars($_POST["detalle"], ENT_QUOTES, 'UTF-8');
    $precio = htmlspecialchars($_POST["precio"], ENT_QUOTES, 'UTF-8');

    $especifi = htmlspecialchars($_POST["especifi"], ENT_QUOTES, 'UTF-8');
    $equiva = htmlspecialchars($_POST["equiva"], ENT_QUOTES, 'UTF-8');

    $consulta = $MTP->editar_producto($id, $codigo, $nombre, $tipo, $marca, $detalle, $precio, $especifi, $equiva);
    echo $consulta;

    exit();
}

//////////////// proveedor
/////////////////////////////////////
if ($_POST["funcion"] === "registrar_proveedor") {
    $razon = htmlspecialchars($_POST["razon"], ENT_QUOTES, 'UTF-8');
    $numero = htmlspecialchars($_POST["numero"], ENT_QUOTES, 'UTF-8');
    $direccion = htmlspecialchars($_POST["direccion"], ENT_QUOTES, 'UTF-8');
    $provincia = htmlspecialchars($_POST["provincia"], ENT_QUOTES, 'UTF-8');
    $ciudad = htmlspecialchars($_POST["ciudad"], ENT_QUOTES, 'UTF-8');
    $numero_telefono = htmlspecialchars($_POST["numero_telefono"], ENT_QUOTES, 'UTF-8');
    $correo = htmlspecialchars($_POST["correo"], ENT_QUOTES, 'UTF-8');
    $actividad = htmlspecialchars($_POST["actividad"], ENT_QUOTES, 'UTF-8');
    $nombre_enca = htmlspecialchars($_POST["nombre_enca"], ENT_QUOTES, 'UTF-8');
    $sexo = htmlspecialchars($_POST["sexo"], ENT_QUOTES, 'UTF-8');
    $telefono_encargado = htmlspecialchars($_POST["telefono_encargado"], ENT_QUOTES, 'UTF-8');

    if (filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        $consulta = $MTP->crear_proveedor($razon, $numero, $direccion, $provincia, $ciudad, $numero_telefono, $correo, $actividad, $nombre_enca, $sexo, $telefono_encargado);
        echo $consulta;
    } else {
        echo 5;
    }

    exit();
}

///////////////
if ($_POST["funcion"] === "listar_proveedor") {
    // /esta fuencion se encargra de traer los datos del usuario
    $data = $MTP->listar_proveedor();
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
if ($_POST["funcion"] === "estado_proveedor") {

    $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
    $dato = htmlspecialchars($_POST['dato'], ENT_QUOTES, 'UTF-8');
    $resutado = $MTP->cambiar_etado_proveedor($id, $dato);
    echo $resutado;

    exit();
}

///////////////////////////////////// 
if ($_POST["funcion"] === "editar_datos_proveedor") {

    $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
    $razon = htmlspecialchars($_POST["razon"], ENT_QUOTES, 'UTF-8');
    $numero = htmlspecialchars($_POST["numero"], ENT_QUOTES, 'UTF-8');
    $direccion = htmlspecialchars($_POST["direccion"], ENT_QUOTES, 'UTF-8');
    $provincia = htmlspecialchars($_POST["provincia"], ENT_QUOTES, 'UTF-8');
    $ciudad = htmlspecialchars($_POST["ciudad"], ENT_QUOTES, 'UTF-8');
    $numero_telefono = htmlspecialchars($_POST["numero_telefono"], ENT_QUOTES, 'UTF-8');
    $correo = htmlspecialchars($_POST["correo"], ENT_QUOTES, 'UTF-8');
    $actividad = htmlspecialchars($_POST["actividad"], ENT_QUOTES, 'UTF-8');
    $nombre_enca = htmlspecialchars($_POST["nombre_enca"], ENT_QUOTES, 'UTF-8');
    $sexo = htmlspecialchars($_POST["sexo"], ENT_QUOTES, 'UTF-8');
    $telefono_encargado = htmlspecialchars($_POST["telefono_encargado"], ENT_QUOTES, 'UTF-8');

    if (filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        $consulta = $MTP->editar_datos_proveedor($id, $razon, $numero, $direccion, $provincia, $ciudad, $numero_telefono, $correo, $actividad, $nombre_enca, $sexo, $telefono_encargado);
        echo $consulta;
    } else {
        echo 5;
    }

    exit();
}

///////////////
if ($_POST["funcion"] === "listar_proveedor_compra") {
    // /esta fuencion se encargra de traer los datos del usuario
    $data = $MTP->listar_proveedor_compra();
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

///////////////
if ($_POST["funcion"] === "listado_productos_agg") {
    // /esta fuencion se encargra de traer los datos del usuario
    $data = $MTP->listado_productos_agg();
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
///////////////////////////////////
/////////////////////////////////////
///esta fuencion se encarga de registrar el ingreso de productos
if ($_POST["funcion"] === "registrar_ingreso") {

    $id =  $_SESSION["id_usu"];
    $id_provee = htmlspecialchars($_POST['id_provee'], ENT_QUOTES, 'UTF-8');
    $inpuesto = htmlspecialchars($_POST['inpuesto'], ENT_QUOTES, 'UTF-8');
    $tipo_compro = htmlspecialchars($_POST['tipo_compro'], ENT_QUOTES, 'UTF-8');
    $serie_compro = htmlspecialchars($_POST['serie_compro'], ENT_QUOTES, 'UTF-8');
    $numero_compro = htmlspecialchars($_POST['numero_compro'], ENT_QUOTES, 'UTF-8');
    $txt_totalneto = htmlspecialchars($_POST['txt_totalneto'], ENT_QUOTES, 'UTF-8');
    $txt_impuesto = htmlspecialchars($_POST['txt_impuesto'], ENT_QUOTES, 'UTF-8');
    $txt_a_pagar = htmlspecialchars($_POST['txt_a_pagar'], ENT_QUOTES, 'UTF-8');
    $count = htmlspecialchars($_POST['count'], ENT_QUOTES, 'UTF-8');

    $consulta = $MTP->registrar_ingreso($id, $id_provee, $inpuesto, $tipo_compro, $serie_compro, $numero_compro, $txt_totalneto, $txt_impuesto, $txt_a_pagar, $count);
    echo $consulta;

    exit();
}

///////////////////////////////////// 
if ($_POST["funcion"] === "registrar_detalle_insumo") {

    $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
    $idproducto = htmlspecialchars($_POST['idproducto'], ENT_QUOTES, 'UTF-8');
    $cantidad = htmlspecialchars($_POST['cantidad'], ENT_QUOTES, 'UTF-8');
    $unidad = htmlspecialchars($_POST['unidad'], ENT_QUOTES, 'UTF-8');
    $precio = htmlspecialchars($_POST['precio'], ENT_QUOTES, 'UTF-8');

    $descuento = htmlspecialchars($_POST['descuento'], ENT_QUOTES, 'UTF-8');
    $subtotal = htmlspecialchars($_POST['subtotal'], ENT_QUOTES, 'UTF-8');

    $arraglo_idproducto = explode(",", $idproducto); //aqui separo los datos
    $arraglo_cantidad = explode(",", $cantidad); //aqui separo los datos
    $arraglo_unidad = explode(",", $unidad); //aqui separo los datos
    $arraglo_precio = explode(",", $precio); //aqui separo los datos
    $arraglo_descuento = explode(",", $descuento); //aqui separo los datos
    $arraglo_subtotal = explode(",", $subtotal); //aqui separo los datos

    //bucle para contar la cantidad de datos
    for ($i = 0; $i < count($arraglo_idproducto); $i++) {
        $consulta = $MTP->registrar_detalle_ingreso($id, $arraglo_idproducto[$i], $arraglo_cantidad[$i], $arraglo_unidad[$i], $arraglo_precio[$i], $arraglo_descuento[$i], $arraglo_subtotal[$i]);
    }

    echo $consulta;

    exit();
}

///////////////
if ($_POST["funcion"] === "listar_ingreso") {
    // /esta fuencion se encargra de traer los datos del usuario
    $data = $MTP->listar_ingreso();
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

///////////////
if ($_POST["funcion"] === "listar_detalle_ingreso") {

    $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');

    $data = $MTP->listar_detalle_ingreso($id);
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
if ($_POST["funcion"] === "anular_ingreso") {

    $id_usu =  $_SESSION["id_usu"];
    $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
    $consulta = $MTP->anular_ingreso($id, $id_usu);
    echo json_encode($consulta, JSON_UNESCAPED_UNICODE);

    exit();
}

///////////////////////////////////// 
if ($_POST["funcion"] === "listar_productos_ofertas") {
    $data = $MTP->listar_productos_ofertas();
    //jason encode para retornar los datos
    echo json_encode($data, JSON_UNESCAPED_UNICODE);

    exit();
}

/////////////////////////////////////
///registrar las ofertas de los productos
if ($_POST["funcion"] === "registrar_ofertass") {

    $producto_id = htmlspecialchars($_POST['producto_id'], ENT_QUOTES, 'UTF-8');
    $fecha_inic = htmlspecialchars($_POST['fecha_inic'], ENT_QUOTES, 'UTF-8');
    $fecha_fin = htmlspecialchars($_POST['fecha_fin'], ENT_QUOTES, 'UTF-8');
    $nombre_oferta = htmlspecialchars($_POST['nombre_oferta'], ENT_QUOTES, 'UTF-8');
    $procentaje = htmlspecialchars($_POST['procentaje'], ENT_QUOTES, 'UTF-8');
    $tipo_descue = htmlspecialchars($_POST['tipo_descue'], ENT_QUOTES, 'UTF-8');

    $consulta = $MTP->registrar_ofertass($producto_id, $fecha_inic, $fecha_fin, $nombre_oferta, $procentaje, $tipo_descue);
    echo $consulta;

    exit();
}

///////////////////////////////////////////// 
if ($_POST["funcion"] === "paguinar") {

    $data = $MTP->paguinar();
    //jason encode para retornar los datos
    echo json_encode($data);

    exit();
}

if ($_POST["funcion"] === "eliminar_ofertas") {

    $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');

    $consulta = $MTP->eliminar_ofertas($id);
    echo $consulta;

    exit();
}

if ($_POST["funcion"] === "traer_datos_editar") {

    $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');

    $consulta = $MTP->traer_datos_editar($id);
    echo json_encode($consulta, JSON_UNESCAPED_UNICODE);

    exit();
}

if ($_POST["funcion"] === "editar_ofertas") {

    $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
    $fecha_inic = htmlspecialchars($_POST['fecha_inic'], ENT_QUOTES, 'UTF-8');
    $fecha_fin = htmlspecialchars($_POST['fecha_fin'], ENT_QUOTES, 'UTF-8');
    $nombre_oferta = htmlspecialchars($_POST['nombre_oferta'], ENT_QUOTES, 'UTF-8');
    $procentaje = htmlspecialchars($_POST['procentaje'], ENT_QUOTES, 'UTF-8');
    $tipo_descue = htmlspecialchars($_POST['tipo_descue'], ENT_QUOTES, 'UTF-8');

    $consulta = $MTP->editar_ofertas($id, $fecha_inic, $fecha_fin, $nombre_oferta, $procentaje, $tipo_descue);
    echo $consulta;

    exit();
}
