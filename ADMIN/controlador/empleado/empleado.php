<?php
require '../../modelo/modelo_empleado.php';
$ME = new modelo_empleado();

///////////////
if ($_POST["funcion"] === "listar_cargo_") {
    // /esta fuencion se encargra de traer los datos del usuario
    $data = $ME->listar_cargo_();
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
    $resutado = $ME->estado_tipo($id, $dato);
    echo $resutado;

    exit();
}

///////////////////////////////////// 
if ($_POST["funcion"] === "registro_cargo") {

    $cargo = htmlspecialchars($_POST['cargo'], ENT_QUOTES, 'UTF-8');
    $resutado = $ME->registro_cargo($cargo);
    echo $resutado;

    exit();
}

///////////////////////////////////// 
if ($_POST["funcion"] === "editar_cargo") {

    $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
    $cargo = htmlspecialchars($_POST['cargo'], ENT_QUOTES, 'UTF-8');
    $resutado = $ME->editar_cargo($cargo, $id);
    echo $resutado;

    exit();
}

///////////////////////////////////// 
if ($_POST["funcion"] === "listar_combo_cargo") {

    $data = $ME->listar_combo_cargo();
    //jason encode para retornar los datos
    echo json_encode($data, JSON_UNESCAPED_UNICODE);

    exit();
}

///////////////////////////////////// 
if ($_POST["funcion"] === "registrar_empleado") {

    $nombres = htmlspecialchars($_POST['nombres'], ENT_QUOTES, 'UTF-8');
    $apellidos = htmlspecialchars($_POST['apellidos'], ENT_QUOTES, 'UTF-8');
    $estado_civil = htmlspecialchars($_POST['estado_civil'], ENT_QUOTES, 'UTF-8');
    $direccion = htmlspecialchars($_POST['direccion'], ENT_QUOTES, 'UTF-8');
    $telefono = htmlspecialchars($_POST['telefono'], ENT_QUOTES, 'UTF-8');
    $correo = htmlspecialchars($_POST['correo'], ENT_QUOTES, 'UTF-8');
    $fecha_n = htmlspecialchars($_POST['fecha_n'], ENT_QUOTES, 'UTF-8');
    $sexo = htmlspecialchars($_POST['sexo'], ENT_QUOTES, 'UTF-8');
    $cedula = htmlspecialchars($_POST['cedula'], ENT_QUOTES, 'UTF-8');
    $nivel_es = htmlspecialchars($_POST['nivel_es'], ENT_QUOTES, 'UTF-8');
    $totulo = htmlspecialchars($_POST['totulo'], ENT_QUOTES, 'UTF-8');
    $experiencia = htmlspecialchars($_POST['experiencia'], ENT_QUOTES, 'UTF-8');
    $fech_i = htmlspecialchars($_POST['fech_i'], ENT_QUOTES, 'UTF-8');
    $cargo = htmlspecialchars($_POST['cargo'], ENT_QUOTES, 'UTF-8');
    $valor_hora = htmlspecialchars($_POST['valor_hora'], ENT_QUOTES, 'UTF-8');

    $resutado = $ME->registrar_empleado($nombres, $apellidos, $estado_civil, $direccion, $telefono, $correo, $fecha_n, $sexo, $cedula, $nivel_es, $totulo, $experiencia, $fech_i, $cargo, $valor_hora);
    echo $resutado;

    exit();
}

///////////////
if ($_POST["funcion"] === "listado_empleados") {
    // /esta fuencion se encargra de traer los datos del usuario
    $data = $ME->listado_empleados();
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
if ($_POST["funcion"] === "estado_tipo_empleado") {

    $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
    $dato = htmlspecialchars($_POST['dato'], ENT_QUOTES, 'UTF-8');
    $resutado = $ME->estado_tipo_empleado($id, $dato);
    echo $resutado;

    exit();
}

///////////////////////////////////// 
if ($_POST["funcion"] === "editar_empleadod") {

    $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
    $nombres = htmlspecialchars($_POST['nombres'], ENT_QUOTES, 'UTF-8');
    $apellidos = htmlspecialchars($_POST['apellidos'], ENT_QUOTES, 'UTF-8');
    $estado_civil = htmlspecialchars($_POST['estado_civil'], ENT_QUOTES, 'UTF-8');
    $direccion = htmlspecialchars($_POST['direccion'], ENT_QUOTES, 'UTF-8');
    $telefono = htmlspecialchars($_POST['telefono'], ENT_QUOTES, 'UTF-8');
    $correo = htmlspecialchars($_POST['correo'], ENT_QUOTES, 'UTF-8');
    $fecha_n = htmlspecialchars($_POST['fecha_n'], ENT_QUOTES, 'UTF-8');
    $sexo = htmlspecialchars($_POST['sexo'], ENT_QUOTES, 'UTF-8');
    $cedula = htmlspecialchars($_POST['cedula'], ENT_QUOTES, 'UTF-8');
    $nivel_es = htmlspecialchars($_POST['nivel_es'], ENT_QUOTES, 'UTF-8');
    $totulo = htmlspecialchars($_POST['totulo'], ENT_QUOTES, 'UTF-8');
    $experiencia = htmlspecialchars($_POST['experiencia'], ENT_QUOTES, 'UTF-8');
    $fech_i = htmlspecialchars($_POST['fech_i'], ENT_QUOTES, 'UTF-8');
    $cargo = htmlspecialchars($_POST['cargo'], ENT_QUOTES, 'UTF-8');
    $valor_hora = htmlspecialchars($_POST['valor_hora'], ENT_QUOTES, 'UTF-8');

    $resutado = $ME->editar_empleadod($id, $nombres, $apellidos, $estado_civil, $direccion, $telefono, $correo, $fecha_n, $sexo, $cedula, $nivel_es, $totulo, $experiencia, $fech_i, $cargo, $valor_hora);
    echo $resutado;

    exit();
}

///////////////////////////////////// 
if ($_POST["funcion"] === "listar_comob_empplado") {

    $data = $ME->listar_comob_empplado();
    //jason encode para retornar los datos
    echo json_encode($data, JSON_UNESCAPED_UNICODE);

    exit();
}

///////////////////////////////////// 
if ($_POST["funcion"] === "registrar_asistencia") {

    $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
    $fecha = htmlspecialchars($_POST['fecha'], ENT_QUOTES, 'UTF-8');
    $hotra_ingreso = htmlspecialchars($_POST['hotra_ingreso'], ENT_QUOTES, 'UTF-8');
    $hotra_salida = htmlspecialchars($_POST['hotra_salida'], ENT_QUOTES, 'UTF-8');
    $estado = htmlspecialchars($_POST['estado'], ENT_QUOTES, 'UTF-8');

    $resutado = $ME->registrar_asistencia($id, $fecha, $hotra_ingreso, $hotra_salida, $estado);
    echo $resutado;

    exit();
}

///////////////////////////////////// 
if ($_POST["funcion"] === "editar_asistencia") {

    $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
    $fechaingreso = htmlspecialchars($_POST['fechaingreso'], ENT_QUOTES, 'UTF-8');
    $hora_ingreso = htmlspecialchars($_POST['hora_ingreso'], ENT_QUOTES, 'UTF-8');
    $hora_saida = htmlspecialchars($_POST['hora_saida'], ENT_QUOTES, 'UTF-8');
    $estado = htmlspecialchars($_POST['estado'], ENT_QUOTES, 'UTF-8');

    $resutado = $ME->editar_asistencia($id, $fechaingreso, $hora_ingreso, $hora_saida, $estado);
    echo $resutado;

    exit();
}

///////////////
if ($_POST["funcion"] === "listar_asistencias") {
    // /esta fuencion se encargra de traer los datos del usuario
    $data = $ME->listar_asistencias();
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
if ($_POST["funcion"] === "eliminar_asistencia") {

    $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
    $resutado = $ME->eliminar_asistencia($id);
    echo $resutado;

    exit();
}

///////////////////////////////////// 
if ($_POST["funcion"] === "registrar_multa") {

    $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
    $fecha = htmlspecialchars($_POST['fecha'], ENT_QUOTES, 'UTF-8');
    $tipo = htmlspecialchars($_POST['tipo'], ENT_QUOTES, 'UTF-8');
    $monto = htmlspecialchars($_POST['monto'], ENT_QUOTES, 'UTF-8');
    $observacion = htmlspecialchars($_POST['observacion'], ENT_QUOTES, 'UTF-8');

    $resutado = $ME->registrar_multa($id, $fecha, $tipo, $monto, $observacion);
    echo $resutado;

    exit();
}

///////////////
if ($_POST["funcion"] === "listar_multas") {
    // /esta fuencion se encargra de traer los datos del usuario
    $data = $ME->listar_multas();
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
if ($_POST["funcion"] === "eliminar_multa") {

    $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
    $resutado = $ME->eliminar_multa($id);
    echo $resutado;

    exit();
}

///////////////////////////////////// 
if ($_POST["funcion"] === "registra_permiso") {

    $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
    $fecha = htmlspecialchars($_POST['fecha'], ENT_QUOTES, 'UTF-8');
    $tipo = htmlspecialchars($_POST['tipo'], ENT_QUOTES, 'UTF-8');
    $observacion = htmlspecialchars($_POST['observacion'], ENT_QUOTES, 'UTF-8');

    $resutado = $ME->registra_permiso($id, $fecha, $tipo, $observacion);
    echo $resutado;

    exit();
}

///////////////
if ($_POST["funcion"] === "listar_permisos") {
    // /esta fuencion se encargra de traer los datos del usuario
    $data = $ME->listar_permisos();
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
if ($_POST["funcion"] === "eliminar_permiso") {

    $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
    $resutado = $ME->eliminar_permiso($id);
    echo $resutado;

    exit();
}

/////////////////
///////////////////////////////////// 
if ($_POST["funcion"] === "traer_asistencias") {
    $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
    $consulta = $ME->traer_asistencias($id);
    if (!empty($consulta)) {
        echo json_encode($consulta, JSON_UNESCAPED_UNICODE);
    } else {
        echo 0;
    }
    exit();
}

///////////////////
if ($_POST["funcion"] === "traer_costo_hora") {
    $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
    $consulta = $ME->traer_costo_hora($id);
    echo json_encode($consulta, JSON_UNESCAPED_UNICODE);
    exit();
}

///////////////////////////////////// 
if ($_POST["funcion"] === "traer_multas") {
    $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
    $consulta = $ME->traer_multas($id);
    if (!empty($consulta)) {
        echo json_encode($consulta, JSON_UNESCAPED_UNICODE);
    } else {
        echo 0;
    }
    exit();
}

/////////////////////////
if ($_POST["funcion"] === "registrar_beneficio") {

    $nombre = htmlspecialchars($_POST["nombre"], ENT_QUOTES, 'UTF-8');
    $valor = htmlspecialchars($_POST["valor"], ENT_QUOTES, 'UTF-8');
    $tipo = htmlspecialchars($_POST["tipo"], ENT_QUOTES, 'UTF-8');

    $consulta = $ME->registrar_beneficio($nombre, $valor, $tipo);
    echo $consulta;

    exit();
}

///////////////
if ($_POST["funcion"] === "listra_beneficios") {
    // /esta fuencion se encargra de traer los datos del usuario
    $data = $ME->listra_beneficios();
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
if ($_POST["funcion"] === "estado_benedifico") {

    $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
    $dato = htmlspecialchars($_POST['dato'], ENT_QUOTES, 'UTF-8');
    $resutado = $ME->estado_benedifico($id, $dato);
    echo $resutado;

    exit();
}

///////////////////////////////////// 
if ($_POST["funcion"] === "editr_beneficio") {

    $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
    $nombre = htmlspecialchars($_POST["nombre"], ENT_QUOTES, 'UTF-8');
    $valor = htmlspecialchars($_POST["valor"], ENT_QUOTES, 'UTF-8');
    $tipo = htmlspecialchars($_POST["tipo"], ENT_QUOTES, 'UTF-8');

    $resutado = $ME->editr_beneficio($id, $nombre, $valor, $tipo);
    echo $resutado;

    exit();
}

///////////////
if ($_POST["funcion"] === "listar_bebficios_rol") {
    // /esta fuencion se encargra de traer los datos del usuario
    $data = $ME->listar_bebficios_rol();
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
if ($_POST["funcion"] === "registrar_rol_de_pagos") {

    $id_empleado = htmlspecialchars($_POST["id_empleado"], ENT_QUOTES, 'UTF-8');
    $fecha_pago = htmlspecialchars($_POST["fecha_pago"], ENT_QUOTES, 'UTF-8');
    $valor_hora = htmlspecialchars($_POST["valor_hora"], ENT_QUOTES, 'UTF-8');
    $monto_dra = htmlspecialchars($_POST["monto_dra"], ENT_QUOTES, 'UTF-8');

    $total_ingreso = htmlspecialchars($_POST["total_ingreso"], ENT_QUOTES, 'UTF-8');
    $total_egreso = htmlspecialchars($_POST["total_egreso"], ENT_QUOTES, 'UTF-8');
    $txtneto_pagar = htmlspecialchars($_POST["txtneto_pagar"], ENT_QUOTES, 'UTF-8');
    $count_ingreso = htmlspecialchars($_POST["count_ingreso"], ENT_QUOTES, 'UTF-8');
    $count_egreso = htmlspecialchars($_POST["count_egreso"], ENT_QUOTES, 'UTF-8');

    $consulta = $ME->registrar_rol_de_pagos($id_empleado, $fecha_pago, $valor_hora, $monto_dra, $total_ingreso, $total_egreso, $txtneto_pagar, $count_ingreso, $count_egreso);

    echo $consulta;

    exit();
}

///////////////////////////////////// 
if ($_POST["funcion"] === "registrar_detalle_ingreso") {

    $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
    $nombre = htmlspecialchars($_POST['nombre'], ENT_QUOTES, 'UTF-8');
    $cantidad = htmlspecialchars($_POST['cantidad'], ENT_QUOTES, 'UTF-8');

    $arraglo_nombre = explode(",", $nombre); //aqui separo los datos
    $arraglo_cantidad = explode(",", $cantidad); //aqui separo los datos  

    //bucle para contar la cantidad de datos
    for ($i = 0; $i < count($arraglo_nombre); $i++) {
        $consulta = $ME->registrar_detalle_ingreso(
            $id,
            $arraglo_nombre[$i],
            $arraglo_cantidad[$i]
        );
    }

    echo $consulta;

    exit();
}

///////////////////////////////////// 
if ($_POST["funcion"] === "registrar_detalle_egreso") {

    $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
    $nombre = htmlspecialchars($_POST['nombre'], ENT_QUOTES, 'UTF-8');
    $cantidad = htmlspecialchars($_POST['cantidad'], ENT_QUOTES, 'UTF-8');

    $arraglo_nombre = explode(",", $nombre); //aqui separo los datos
    $arraglo_cantidad = explode(",", $cantidad); //aqui separo los datos  

    //bucle para contar la cantidad de datos
    for ($i = 0; $i < count($arraglo_nombre); $i++) {
        $consulta = $ME->registrar_detalle_egreso(
            $id,
            $arraglo_nombre[$i],
            $arraglo_cantidad[$i]
        );
    }

    echo $consulta;

    exit();
}

///////////////////////////////////// 
if ($_POST["funcion"] === "pagar_multa_sancion") { 

        $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
        $id_multa = htmlspecialchars($_POST['id_multa'], ENT_QUOTES, 'UTF-8');

        $arraglo_id_multa = explode(",", $id_multa); //aqui separo los datos 

        //bucle para contar la cantidad de datos
        for ($i = 0; $i < count($arraglo_id_multa); $i++) {
            $consulta = $ME->pagar_multa_sancion(
                $id,
                $arraglo_id_multa[$i]
            );
        }
        echo $consulta;
  
    exit();
}

//////////////////////////////
if ($_POST["funcion"] === "sacra_asistencias") { 

        $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
        $idasistencia = htmlspecialchars($_POST['idasistencia'], ENT_QUOTES, 'UTF-8');

        $arraglo_idasistencia = explode(",", $idasistencia); //aqui separo los datos 

        //bucle para contar la cantidad de datos
        for ($i = 0; $i < count($arraglo_idasistencia); $i++) {
            $consulta = $ME->sacra_asistencias(
                $id,
                $arraglo_idasistencia[$i]
            );
        }
        echo $consulta;
   
    exit();
}

///////////////
if ($_POST["funcion"] === "listar_rol_pagos") {
    // /esta fuencion se encargra de traer los datos del usuario
    $data = $ME->listar_rol_pagos();
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