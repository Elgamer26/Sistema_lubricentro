<?php
require '../../modelo/modelo_sistema.php';
$MSY = new modelo_sistema();
session_start();

///////////////////////////////////// 
if ($_POST["funcion"] === "verificar_ofertas") {

    $resutado = $MSY->eliminar_ofertas_pasadas();
    echo $resutado;

    exit();
}

///////////////////////////////////////////// 
if ($_POST["funcion"] === "traer_datos_dasboard_admin") {

    $total_cliente = $MSY->total_cliente();
    $total_empleaodos = $MSY->total_empleaodos();
    $total_productos = $MSY->total_productos();
    $stock_servicios = $MSY->stock_servicios();

    $arreglo[] = array("cliente" => $total_cliente, "empleado" => $total_empleaodos, "productos" => $total_productos, 'servicios' => $stock_servicios);
    echo json_encode($arreglo, JSON_UNESCAPED_UNICODE);

    exit();
}

//// 
if ($_POST["funcion"] === "productos_mas_comprados") {

    $datos = $MSY->productos_mas_comprados();
    if (!empty($datos)) {
        echo json_encode($datos, JSON_UNESCAPED_UNICODE);
    } else {
        echo 0;
    }

    exit();
}

//// 
if ($_POST["funcion"] === "servicios_mas_comprados") {

    $datos = $MSY->servicios_mas_comprados();
    if (!empty($datos)) {
        echo json_encode($datos, JSON_UNESCAPED_UNICODE);
    } else {
        echo 0;
    }

    exit();
}

//////////////////////////
/////////////////////////////////
if ($_POST["funcion"] === "realizar_respaldo") {

    date_default_timezone_set('America/Guayaquil');
    $fecha_archivo = date("YmdHis");

    $id = $_SESSION["id_usu"];
    $pass =  htmlspecialchars($_POST['pass1'], ENT_QUOTES, 'UTF-8');

    $consulta = $MSY->realizar_respaldo($id, $pass, $fecha_archivo);

    if ($consulta === 10 || $consulta === 20) {
        echo $consulta;
        exit();
    } else {
        $db_host = $consulta["host"]; //Host del Servidor MySQL
        $db_name = $consulta["name"]; //Nombre de la Base de datos
        $db_user = $consulta["user"]; //Usuario de MySQL
        $db_pass = $consulta["pass"]; //Password de Usuario MySQL

        $salida_sql = '../../img/backup/' . $fecha_archivo . '_' . $db_name . '.sql';
        $dump = "mysqldump --h$db_host -u$db_user -p$db_pass --opt $db_name > $salida_sql";
        system($dump, $output);

        $zip = new ZipArchive();
        $salida_zip = '../../img/backup/' . $fecha_archivo . '_' . $db_name . '.zip';

        if ($zip->open($salida_zip, ZIPARCHIVE::CREATE) === true) {
            $zip->addFile($salida_sql);
            $zip->close();
            unlink($salida_sql);
            echo 1;
        } else {
            echo 0;
        }
    }

    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "listar_respaldo") {

    $data = $MSY->listar_respaldo();
    if ($data) {
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    } else {
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
if ($_POST["funcion"] === "listar_auditoria_ventas") {

    $data = $MSY->listar_auditoria_ventas();
    if ($data) {
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    } else {
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
if ($_POST["funcion"] === "listar_auditoria_compras") {

    $data = $MSY->listar_auditoria_compras();
    if ($data) {
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    } else {
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
if ($_POST["funcion"] === "listar_auditoria_servicios") {

    $data = $MSY->listar_auditoria_servicios();
    if ($data) {
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    } else {
        echo '{
                "sEcho": 1,
                "iTotalRecords": "0",
                "iTotalDisplayRecords": "0",
                "aaData": []
            }';
    }

    exit();
}
