<?php
require '../../modelo/modelo_empresa.php';
$ME = new modelo_empresa();

///////////////////////////////////// 
if ($_POST["funcion"] === "trae_datos_optica") {

    $id =  $_POST["id"];
    $consulta = $ME->traer_datos_optica($id);
    $datos = json_encode($consulta, JSON_UNESCAPED_UNICODE);
    echo $datos;


    exit();
}

///////////////////////////////////// 
if ($_POST["funcion"] === "cambiar_imagen") {

    $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
    $ruta_actual = htmlspecialchars($_POST['ruta_actual'], ENT_QUOTES, 'UTF-8');
    $nombrearchivo = htmlspecialchars($_POST["nombrearchivo"], ENT_QUOTES, 'UTF-8');

    //esto es para saber si el file trae datos
    if (is_array($_FILES) && count($_FILES) > 0) {

        if ($ruta_actual != "img/empresa/empresa.png") {
            $delete = $ruta_actual;
            unlink("../../" . $delete);
        }

        $ruta = "img/empresa/$nombrearchivo";
        $consulta = $ME->ediatar_imagen_optica($id, $ruta);
        if ($consulta == 1) {
            if (move_uploaded_file($_FILES['foto']["tmp_name"], "../../img/empresa/" . $nombrearchivo)) {
                echo $consulta;
            } else {
                echo 10;
            }
        } else {
            echo $consulta;
        }
    }

    exit();
}

///////////////////////////////////// 
if ($_POST["funcion"] === "editar_datos_optica") {
    
        $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
        $haci_nombre = htmlspecialchars($_POST['haci_nombre'], ENT_QUOTES, 'UTF-8');
        $Direccion = htmlspecialchars($_POST['Direccion'], ENT_QUOTES, 'UTF-8');
        $Telefono = htmlspecialchars($_POST['Telefono'], ENT_QUOTES, 'UTF-8');
        $Ruc = htmlspecialchars($_POST['Ruc'], ENT_QUOTES, 'UTF-8');
        $email = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
        $fecha_fun = htmlspecialchars($_POST['fecha_fun'], ENT_QUOTES, 'UTF-8');
        $lema = htmlspecialchars($_POST['lema'], ENT_QUOTES, 'UTF-8');
        $Actividad = htmlspecialchars($_POST['Actividad'], ENT_QUOTES, 'UTF-8');

        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $consulta = $ME->editar_empresa_optica($id, $haci_nombre, $Direccion, $Telefono, $Ruc, $email, $fecha_fun, $lema, $Actividad);
            echo $consulta;
        } else {
            echo 10;
        }
    
    exit();
}