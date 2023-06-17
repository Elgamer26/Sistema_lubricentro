<?php
require '../../modelo/modelo_usuario.php';
$MU = new modelo_usuario();
session_start();

///////////////////////////////////// 
if ($_POST["funcion"] === "logeo") {

    $usu = htmlspecialchars($_POST['usuario'], ENT_QUOTES, 'UTF-8');
    $pass = htmlspecialchars($_POST['password'], ENT_QUOTES, 'UTF-8');
    $resutado = $MU->verifcar_usuario($usu, $pass);
    $data = json_encode($resutado, JSON_UNESCAPED_UNICODE);
    if (count($resutado) > 0) {
        echo $data;
    } else {
        echo 0;
    }
    exit();
}

///////////////////////////////////// 
if ($_POST["funcion"] === "session") {
    $id_usu = $_POST["id_usu"];
    $id_rol = $_POST["rol"];

    $_SESSION["id_usu"] = $id_usu;
    $_SESSION["id_rol"] = $id_rol;
    echo 1;
    exit();
}

///////////////////////////////////// 
if ($_POST["funcion"] === "traer_usuario") {
    $id =  $_SESSION["id_usu"];
    $consulta = $MU->traer_datos_usuario($id);
    $datos = json_encode($consulta, JSON_UNESCAPED_UNICODE);
    if (count($consulta) > 0) {
        echo $datos;
    } else {
        echo 0;
    }
    exit();
}

///////////////////////////////////// 
if ($_POST["funcion"] === "traer_usuario_perfil") {

    $id =  $_SESSION["id_usu"];
    $consulta = $MU->traer_datos_usuario_perfil($id);
    $datos = json_encode($consulta, JSON_UNESCAPED_UNICODE);
    if (count($consulta) > 0) {
        echo $datos;
    } else {
        echo 0;
    }

    exit();
}

///////////////////////////////////// 
if ($_POST["funcion"] === "cambiar_pass") {

    $id =  $_SESSION["id_usu"];
    $nueva = htmlspecialchars($_POST["nueva"], ENT_QUOTES, 'UTF-8');
    $consulta = $MU->editar_password($id, $nueva);
    echo $consulta;

    exit();
}

///////////////////////////////////// 
if ($_POST["funcion"] === "cambiar_foto_perfil_user") {

    $id_empe =  $_SESSION["id_usu"];
    $nombrearchivo = htmlspecialchars($_POST["nombrearchivo"], ENT_QUOTES, 'UTF-8');
    $ruta_actual = htmlspecialchars($_POST["ruta_actual"], ENT_QUOTES, 'UTF-8');
    //esto es para saber si el file trae datos
    if (is_array($_FILES) && count($_FILES) > 0) {
        if ($ruta_actual != "img/usuarios/user.jpg") {
            $delete = $ruta_actual;
            unlink("../../" . $delete);
        }
        if (move_uploaded_file($_FILES['foto']["tmp_name"], "../../img/usuarios/" . $nombrearchivo)) {
            $ruta = "img/usuarios/$nombrearchivo";
            $consulta = $MU->editar_foto_perfil_usuario($id_empe, $ruta);
            echo $consulta;
        } else {
            echo 0;
        }
    } else {
        echo 0;
    }

    exit();
}

///////////////////////////////////// 
if ($_POST["funcion"] === "cambiar_datos_perfil") {

    $id =  $_SESSION["id_usu"];
    $nomber = htmlspecialchars($_POST["nomber"], ENT_QUOTES, 'UTF-8');
    $apellido = htmlspecialchars($_POST["apellido"], ENT_QUOTES, 'UTF-8');
    $telefono = htmlspecialchars($_POST["telefono"], ENT_QUOTES, 'UTF-8');
    $email = htmlspecialchars($_POST["email"], ENT_QUOTES, 'UTF-8');
    $usuario = htmlspecialchars($_POST["usuario"], ENT_QUOTES, 'UTF-8');
    $sexo = htmlspecialchars($_POST["sexo"], ENT_QUOTES, 'UTF-8');
    $direcc_domi = htmlspecialchars($_POST["direcc_domi"], ENT_QUOTES, 'UTF-8');

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $consulta = $MU->editar_datos_usuario($id, $nomber, $apellido, $telefono, $email, $usuario, $sexo, $direcc_domi);
        echo $consulta;
    } else {
        echo 10;
    }

    exit();
}

if ($_POST["funcion"] === "listar_tipo_usuario") {
    // /esta fuencion se encargra de traer los datos del usuario
    $data = $MU->listar_tipo_usuario();
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
}

///////////////////////////////////// 
if ($_POST["funcion"] === "registro_tipo") {

    $tipo = htmlspecialchars($_POST['tipo'], ENT_QUOTES, 'UTF-8');
    $resutado = $MU->registrar_tipo_usuario($tipo);
    echo $resutado;

    exit();
}

///////////////////////////////////// 
if ($_POST["funcion"] === "estado_tipo") {

    $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
    $dato = htmlspecialchars($_POST['dato'], ENT_QUOTES, 'UTF-8');
    $resutado = $MU->cambiar_etado_tipo($id, $dato);
    echo $resutado;

    exit();
}

///////////////////////////////////// 
if ($_POST["funcion"] === "editar_tipo") {

    $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
    $tipo = htmlspecialchars($_POST['tipo'], ENT_QUOTES, 'UTF-8');
    $resutado = $MU->editar_tipo_usuario($tipo, $id);
    echo $resutado;

    exit();
}

///////////////////////////////////// 
if ($_POST["funcion"] === "listar_tipo_usuario_x") {

    $data = $MU->listar_tipo_usuario_x();
    //jason encode para retornar los datos
    echo json_encode($data, JSON_UNESCAPED_UNICODE);

    exit();
}

///////////////////////////////////// 
if ($_POST["funcion"] === "registrar_usuario_u") {

    $nombre = htmlspecialchars($_POST['nombre'], ENT_QUOTES, 'UTF-8');
    $apellidos = htmlspecialchars($_POST['apellidos'], ENT_QUOTES, 'UTF-8');
    $direccion = htmlspecialchars($_POST['direccion'], ENT_QUOTES, 'UTF-8');
    $telefono = htmlspecialchars($_POST['telefono'], ENT_QUOTES, 'UTF-8');
    $sexo = htmlspecialchars($_POST['sexo'], ENT_QUOTES, 'UTF-8');
    $cedula = htmlspecialchars($_POST['cedula'], ENT_QUOTES, 'UTF-8');
    $correo = htmlspecialchars($_POST['correo'], ENT_QUOTES, 'UTF-8');
    $tipo_usu = htmlspecialchars($_POST['tipo_usu'], ENT_QUOTES, 'UTF-8');
    $usuario = htmlspecialchars($_POST['usuario'], ENT_QUOTES, 'UTF-8');
    $pass = htmlspecialchars($_POST['pass'], ENT_QUOTES, 'UTF-8');

    $nombrearchivo = htmlspecialchars($_POST['nombrearchivo'], ENT_QUOTES, 'UTF-8');
    //esto es para saber si el file trae datos

    if (filter_var($correo, FILTER_VALIDATE_EMAIL)) {

        if (is_array($_FILES) && count($_FILES) > 0) {
            $ruta = "img/usuarios/$nombrearchivo";
            $consulta = $MU->registrar_usuario($nombre, $apellidos, $direccion, $telefono, $sexo, $cedula, $correo, $tipo_usu, $usuario, $pass, $ruta);
            if ($consulta == 1) {
                if (move_uploaded_file($_FILES['foto']["tmp_name"], "../../img/usuarios/" . $nombrearchivo)) {
                    echo $consulta;
                } else {
                    echo "a";
                }
            } else {
                echo $consulta;
            }
        } else {
            $ruta = "img/usuarios/user.jpg";
            $consulta = $MU->registrar_usuario($nombre, $apellidos, $direccion, $telefono, $sexo, $cedula, $correo, $tipo_usu, $usuario, $pass, $ruta);
            echo $consulta;
        }
    } else {
        echo "d";
    }
    exit();
}

///////////////////////////////////// 
if ($_POST["funcion"] === "crear_permisos") {

    $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
    $conf = htmlspecialchars($_POST["conf"], ENT_QUOTES, 'UTF-8');

    $emples = htmlspecialchars($_POST["emples"], ENT_QUOTES, 'UTF-8');
    $asistens = htmlspecialchars($_POST["asistens"], ENT_QUOTES, 'UTF-8');
    $mults = htmlspecialchars($_POST["mults"], ENT_QUOTES, 'UTF-8');
    $bens = htmlspecialchars($_POST["bens"], ENT_QUOTES, 'UTF-8');
    $bens = htmlspecialchars($_POST["bens"], ENT_QUOTES, 'UTF-8');
    $rols = htmlspecialchars($_POST["rols"], ENT_QUOTES, 'UTF-8');
    $prods = htmlspecialchars($_POST["prods"], ENT_QUOTES, 'UTF-8');
    $creat_pords = htmlspecialchars($_POST["creat_pords"], ENT_QUOTES, 'UTF-8');
    $provees = htmlspecialchars($_POST["provees"], ENT_QUOTES, 'UTF-8');
    $comps = htmlspecialchars($_POST["comps"], ENT_QUOTES, 'UTF-8');
    $list_comps = htmlspecialchars($_POST["list_comps"], ENT_QUOTES, 'UTF-8');
    $ofertas = htmlspecialchars($_POST["ofertas"], ENT_QUOTES, 'UTF-8');
    $servs = htmlspecialchars($_POST["servs"], ENT_QUOTES, 'UTF-8');
    $creat_cliens = htmlspecialchars($_POST["creat_cliens"], ENT_QUOTES, 'UTF-8');
    $crea_vehs = htmlspecialchars($_POST["crea_vehs"], ENT_QUOTES, 'UTF-8');
    $vents = htmlspecialchars($_POST["vents"], ENT_QUOTES, 'UTF-8');
    $cret_sers = htmlspecialchars($_POST["cret_sers"], ENT_QUOTES, 'UTF-8');
    $list_reser = htmlspecialchars($_POST["list_reser"], ENT_QUOTES, 'UTF-8');
    $reports = htmlspecialchars($_POST["reports"], ENT_QUOTES, 'UTF-8');
    $segurs = htmlspecialchars($_POST["segurs"], ENT_QUOTES, 'UTF-8');

    $consulta = $MU->crear_permisos_usuario(
        $id,
        $conf,
        $emples,
        $asistens,
        $mults,
        $bens,
        $rols,
        $prods,
        $creat_pords,
        $provees,
        $comps,
        $list_comps,
        $ofertas,
        $servs,
        $creat_cliens,
        $crea_vehs,
        $vents,
        $cret_sers,
        $list_reser,
        $reports,
        $segurs
    );

    echo $consulta;
    exit();
}

if ($_POST["funcion"] === "listar_usuarios_list") {
    // /esta fuencion se encargra de traer los datos del usuario
    $data = $MU->listar_usuarios_list();
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
}

///////////////////////////////////// 
if ($_POST["funcion"] === "estado_usuario") {

    $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
    $dato = htmlspecialchars($_POST['dato'], ENT_QUOTES, 'UTF-8');
    $resutado = $MU->estado_usuario($id, $dato);
    echo $resutado;

    exit();
}

///////////////////////////////////// 
if ($_POST["funcion"] === "editar_usuariosss") {

    $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
    $nombre = htmlspecialchars($_POST["nombre"], ENT_QUOTES, 'UTF-8');
    $apellidos = htmlspecialchars($_POST["apellidos"], ENT_QUOTES, 'UTF-8');
    $direccion = htmlspecialchars($_POST["direccion"], ENT_QUOTES, 'UTF-8');
    $telefono = htmlspecialchars($_POST["telefono"], ENT_QUOTES, 'UTF-8');
    $sexo = htmlspecialchars($_POST["sexo"], ENT_QUOTES, 'UTF-8');

    $cedula = htmlspecialchars($_POST["cedula"], ENT_QUOTES, 'UTF-8');
    $correo = htmlspecialchars($_POST["correo"], ENT_QUOTES, 'UTF-8');
    $tipo_usu = htmlspecialchars($_POST["tipo_usu"], ENT_QUOTES, 'UTF-8');
    $usuario = htmlspecialchars($_POST["usuario"], ENT_QUOTES, 'UTF-8');
    $pass = htmlspecialchars($_POST["pass"], ENT_QUOTES, 'UTF-8');

    $consulta = $MU->editar_usuariosss($id, $nombre, $apellidos, $direccion, $telefono, $sexo, $cedula, $correo, $tipo_usu, $usuario, $pass);
    echo $consulta;

    exit();
}

///////////////////////////////////// 
if ($_POST["funcion"] === "obtener_permisos") {

    $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
    $consulta = $MU->obtener_pemisos($id);
    $datos = json_encode($consulta, JSON_UNESCAPED_UNICODE);
    if (count($consulta) > 0) {
        echo $datos;
    } else {
        echo 0;
    }

    exit();
}

///////////////////////////////////// 
if ($_POST["funcion"] === "editar_permisos") {

    $id_permis = htmlspecialchars($_POST["id_permis"], ENT_QUOTES, 'UTF-8');
    $id_usu = htmlspecialchars($_POST["id_usu"], ENT_QUOTES, 'UTF-8');
    $conf = htmlspecialchars($_POST["conf"], ENT_QUOTES, 'UTF-8');

    $emples = htmlspecialchars($_POST["emples"], ENT_QUOTES, 'UTF-8');
    $asistens = htmlspecialchars($_POST["asistens"], ENT_QUOTES, 'UTF-8');
    $mults = htmlspecialchars($_POST["mults"], ENT_QUOTES, 'UTF-8');
    $bens = htmlspecialchars($_POST["bens"], ENT_QUOTES, 'UTF-8');
    $bens = htmlspecialchars($_POST["bens"], ENT_QUOTES, 'UTF-8');
    $rols = htmlspecialchars($_POST["rols"], ENT_QUOTES, 'UTF-8');
    $prods = htmlspecialchars($_POST["prods"], ENT_QUOTES, 'UTF-8');
    $creat_pords = htmlspecialchars($_POST["creat_pords"], ENT_QUOTES, 'UTF-8');
    $provees = htmlspecialchars($_POST["provees"], ENT_QUOTES, 'UTF-8');
    $comps = htmlspecialchars($_POST["comps"], ENT_QUOTES, 'UTF-8');
    $list_comps = htmlspecialchars($_POST["list_comps"], ENT_QUOTES, 'UTF-8');
    $ofertas = htmlspecialchars($_POST["ofertas"], ENT_QUOTES, 'UTF-8');
    $servs = htmlspecialchars($_POST["servs"], ENT_QUOTES, 'UTF-8');
    $creat_cliens = htmlspecialchars($_POST["creat_cliens"], ENT_QUOTES, 'UTF-8');
    $crea_vehs = htmlspecialchars($_POST["crea_vehs"], ENT_QUOTES, 'UTF-8');
    $vents = htmlspecialchars($_POST["vents"], ENT_QUOTES, 'UTF-8');
    $cret_sers = htmlspecialchars($_POST["cret_sers"], ENT_QUOTES, 'UTF-8');
    $list_reser = htmlspecialchars($_POST["list_reser"], ENT_QUOTES, 'UTF-8');
    $reports = htmlspecialchars($_POST["reports"], ENT_QUOTES, 'UTF-8');
    $segurs = htmlspecialchars($_POST["segurs"], ENT_QUOTES, 'UTF-8');

    $consulta = $MU->editar_permisos(
        $id_permis,
        $id_usu,
        $conf,
        $emples,
        $asistens,
        $mults,
        $bens,
        $rols,
        $prods,
        $creat_pords,
        $provees,
        $comps,
        $list_comps,
        $ofertas,
        $servs,
        $creat_cliens,
        $crea_vehs,
        $vents,
        $cret_sers,
        $list_reser,
        $reports,
        $segurs
    );
    echo $consulta;

    exit();
}

///////////////////////////////////// 
if ($_POST["funcion"] === "obtener_permisos_usuario_logeado") {

    $id =  $_SESSION["id_usu"];
    $consulta = $MU->obtener_pemisos($id);
    echo json_encode($consulta, JSON_UNESCAPED_UNICODE);

    exit();
}
