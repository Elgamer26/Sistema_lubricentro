<?php
require_once 'modelo_conexion.php';
class modelo_usuario extends modelo_conexion
{
    function verifcar_usuario($usuario, $passs)
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            usuario.id_usuario, 
            usuario.pass, 
            usuario.usuario, 
            usuario.estado, 
            usuario.id_rol
            FROM
            usuario WHERE binary  usuario.pass = ? AND binary usuario.usuario = ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $passs);
            $query->bindParam(2, $usuario);
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_BOTH);
            $arreglo = array();
            foreach ($result as $respuesta) {
                $arreglo[] = $respuesta;
            }
            return $arreglo;
            //cerramos la conexion
            modelo_conexion::cerrar_conexion();
        } catch (Exception $e) {
            modelo_conexion::cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function traer_datos_usuario($id)
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            usuario.id_usuario,
            usuario.nombres,
            usuario.apellidos,
            usuario.foto,
            usuario.sexo,
            usuario.cedual,
            usuario.telefono,
            usuario.direccion,
            usuario.usuario,
            usuario.pass,
            usuario.id_rol,
            usuario.estado,
            rol.tipo_rol 
        FROM
            rol
            INNER JOIN usuario ON rol.id_rol = usuario.id_rol WHERE usuario.id_usuario = ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $id);
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            $arreglo = array();
            foreach ($result as $respuesta) {
                $arreglo[] = $respuesta;
            }
            return $arreglo;
            //cerramos la conexion
            modelo_conexion::cerrar_conexion();
        } catch (Exception $e) {
            modelo_conexion::cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function traer_datos_usuario_perfil($id)
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            usuario.id_usuario,
            usuario.nombres,
            usuario.apellidos,
            usuario.foto,
            usuario.sexo,
            usuario.cedual,
            usuario.telefono,
            usuario.direccion,
            usuario.usuario,
            usuario.pass,
            usuario.id_rol,
            usuario.estado,
            rol.tipo_rol,
            usuario.correo
        FROM
            rol
            INNER JOIN usuario ON rol.id_rol = usuario.id_rol WHERE usuario.id_usuario = ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $id);
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            $arreglo = array();
            foreach ($result as $respuesta) {
                $arreglo[] = $respuesta;
            }
            return $arreglo;
            //cerramos la conexion
            modelo_conexion::cerrar_conexion();
        } catch (Exception $e) {
            modelo_conexion::cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function editar_password($id, $nueva)
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "UPDATE usuario SET pass = ? WHERE id_usuario = ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $nueva);
            $query->bindParam(2, $id);
            if ($query->execute()) {
                return 1;
            } else {
                return 0;
            }
            //cerramos la conexion
            modelo_conexion::cerrar_conexion();
        } catch (Exception $e) {
            modelo_conexion::cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function editar_foto_perfil_usuario($id_empe, $ruta)
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "UPDATE usuario SET foto = ? WHERE id_usuario = ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $ruta);
            $query->bindParam(2, $id_empe);
            if ($query->execute()) {
                return 1;
            } else {
                return 0;
            }
            //cerramos la conexion
            modelo_conexion::cerrar_conexion();
        } catch (Exception $e) {
            modelo_conexion::cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function editar_datos_usuario($id, $nomber, $paterno, $telefono, $email, $usuario, $sexo, $direcc_domi)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * FROM usuario where binary usuario = ? AND id_usuario != ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $usuario);
            $query->bindParam(2, $id);
            $query->execute();
            $data = $query->fetch(PDO::FETCH_ASSOC);

            if (empty($data)) {
                $sql_a = "UPDATE usuario SET nombres = ?, apellidos = ?,
                            telefono = ?, 
                            correo = ?, usuario = ?,  
                            sexo = ?, direccion = ? WHERE id_usuario = ?";

                $querya = $c->prepare($sql_a);
                $querya->bindParam(1, $nomber);
                $querya->bindParam(2, $paterno);
                $querya->bindParam(3, $telefono);
                $querya->bindParam(4, $email);
                $querya->bindParam(5, $usuario);
                $querya->bindParam(6, $sexo);

                $querya->bindParam(7, $direcc_domi);
                $querya->bindParam(8, $id);

                if ($querya->execute()) {
                    $res = 1;
                } else {
                    $res = 0;
                }
            } else {
                $res = 2;
            }
            return $res;

            //cerramos la conexion
            modelo_conexion::cerrar_conexion();
        } catch (Exception $e) {
            modelo_conexion::cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function listar_tipo_usuario()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            *
            FROM
            rol
            ";
            $query = $c->prepare($sql);
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            $arreglo = array();
            foreach ($result as $respuesta) {
                $arreglo["data"][] = $respuesta;
            }
            return $arreglo;
            //cerramos la conexion
            modelo_conexion::cerrar_conexion();
        } catch (Exception $e) {
            modelo_conexion::cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function registrar_tipo_usuario($tipo)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_a = "SELECT * FROM rol where tipo_rol = ?";
            $query_a = $c->prepare($sql_a);
            $query_a->bindParam(1, $tipo);
            $query_a->execute();
            $data_a = $query_a->fetch(PDO::FETCH_ASSOC);

            if (empty($data_a)) {
                $sql_B = "INSERT INTO rol (tipo_rol) VALUES (?)";
                $query_b = $c->prepare($sql_B);
                $query_b->bindParam(1, $tipo);
                if ($query_b->execute()) {
                    $res = 1;
                } else {
                    $res = 0;
                }
            } else {
                $res = 2;
            }
            return $res;

            //cerramos la conexion
            modelo_conexion::cerrar_conexion();
        } catch (Exception $e) {
            modelo_conexion::cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function cambiar_etado_tipo($id, $dato)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_B = "UPDATE rol SET estado = ? WHERE id_rol = ?";
            $query_b = $c->prepare($sql_B);
            $query_b->bindParam(1, $dato);
            $query_b->bindParam(2, $id);
            if ($query_b->execute()) {
                $res = 1;
            } else {
                $res = 0;
            }
            return $res;

            //cerramos la conexion
            modelo_conexion::cerrar_conexion();
        } catch (Exception $e) {
            modelo_conexion::cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function editar_tipo_usuario($tipo, $id)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_a = "SELECT * FROM rol where tipo_rol = ? AND id_rol != ?";
            $query_a = $c->prepare($sql_a);
            $query_a->bindParam(1, $tipo);
            $query_a->bindParam(2, $id);
            $query_a->execute();
            $data_a = $query_a->fetch(PDO::FETCH_ASSOC);

            if (empty($data_a)) {
                $sql_B = "UPDATE rol SET tipo_rol = ? WHERE id_rol = ?";
                $query_b = $c->prepare($sql_B);
                $query_b->bindParam(1, $tipo);
                $query_b->bindParam(2, $id);
                if ($query_b->execute()) {
                    $res = 1;
                } else {
                    $res = 0;
                }
            } else {
                $res = 2;
            }
            return $res;

            //cerramos la conexion
            modelo_conexion::cerrar_conexion();
        } catch (Exception $e) {
            modelo_conexion::cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function listar_tipo_usuario_x()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * FROM rol WHERE estado = 1";
            $query = $c->prepare($sql);
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_BOTH);
            $arreglo = array();
            foreach ($result as $respuesta) {
                $arreglo[] = $respuesta;
            }
            return $arreglo;
            //cerramos la conexion
            modelo_conexion::cerrar_conexion();
        } catch (Exception $e) {
            modelo_conexion::cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    ///////////////////
    function registrar_usuario($nombre, $apellidos, $direccion, $telefono, $sexo, $cedula, $correo, $tipo_usu, $usuario, $pass, $ruta)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_a = "SELECT * FROM usuario where cedual = ?";
            $query_a = $c->prepare($sql_a);
            $query_a->bindParam(1, $cedula);
            $query_a->execute();
            $data_a = $query_a->fetch(PDO::FETCH_ASSOC);
            if (empty($data_a)) {
                $sql_b = "SELECT * FROM usuario where correo = ?";
                $query_b = $c->prepare($sql_b);
                $query_b->bindParam(1, $correo);
                $query_b->execute();
                $data_b = $query_b->fetch(PDO::FETCH_ASSOC);
                if (empty($data_b)) {

                    $sql_x = "SELECT * FROM usuario where usuario = ?";
                    $query_x = $c->prepare($sql_x);
                    $query_x->bindParam(1, $usuario);
                    $query_x->execute();
                    $data_x = $query_x->fetch(PDO::FETCH_ASSOC);
                    if (empty($data_x)) {

                        $sql_c = "INSERT INTO usuario (nombres, apellidos, foto, sexo, cedual, telefono, direccion, id_rol, usuario, pass, correo) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
                        $query_c = $c->prepare($sql_c);
                        $query_c->bindParam(1, $nombre);
                        $query_c->bindParam(2, $apellidos);
                        $query_c->bindParam(3, $ruta);
                        $query_c->bindParam(4, $sexo);
                        $query_c->bindParam(5, $cedula);
                        $query_c->bindParam(6, $telefono);
                        $query_c->bindParam(7, $direccion);
                        $query_c->bindParam(8, $tipo_usu);
                        $query_c->bindParam(9, $usuario);
                        $query_c->bindParam(10, $pass);
                        $query_c->bindParam(11, $correo);
                        if ($query_c->execute()) {
                            $res = $c->lastInsertId(); // registro exitoso
                        } else {
                            $res = "a"; // error en la inserccion
                        }
                    } else {
                        $res = "e"; // ya existe el usuario
                    }
                } else {
                    $res = "c"; // ya existe el correo de un empleado
                }
            } else {
                $res = "b"; // ya existe la cedula o numero documento
            }
            return $res;
            //cerramos la conexion
            modelo_conexion::cerrar_conexion();
        } catch (Exception $e) {
            modelo_conexion::cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function crear_permisos_usuario(
        $id,
        string $conf,
        string $emples,
        string $asistens,
        string $mults,
        string $bens,
        string $rols,
        string $prods,
        string $creat_pords,
        string $provees,
        string $comps,
        string $list_comps,
        string $ofertas,
        string $servs,
        string $creat_cliens,
        string $crea_vehs,
        string $vents,
        string $cret_sers,
        string $list_reser,
        string $reports,
        string $segurs
    ) {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_a = "INSERT INTO permisos (id_usuario, configuracion, emples, asistens, mults, bens, rols, prods, creat_pords, provees, comps, list_comps, ofertas, servs, creat_cliens, crea_vehs, vents, cret_sers, list_reser, reports, segurs) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $querya = $c->prepare($sql_a);
            $querya->bindParam(1, $id);
            $querya->bindParam(2, $conf);

            $querya->bindParam(3, $emples);
            $querya->bindParam(4, $asistens);
            $querya->bindParam(5, $mults);
            $querya->bindParam(6, $bens);
            $querya->bindParam(7, $rols);
            $querya->bindParam(8, $prods);
            $querya->bindParam(9, $creat_pords);
            $querya->bindParam(10, $provees);
            $querya->bindParam(11, $comps);
            $querya->bindParam(12, $list_comps);
            $querya->bindParam(13, $ofertas);
            $querya->bindParam(14, $servs);
            $querya->bindParam(15, $creat_cliens);
            $querya->bindParam(16, $crea_vehs);
            $querya->bindParam(17, $vents);
            $querya->bindParam(18, $cret_sers);
            $querya->bindParam(19, $list_reser);
            $querya->bindParam(20, $reports);
            $querya->bindParam(21, $segurs);

            if ($querya->execute()) {
                $res = 1; // SE INSERT CORRECTAMENTE
            } else {
                $res = 0; // FALLO EN LA MATRIX
            }
            return $res;

            //cerramos la conexion
            modelo_conexion::cerrar_conexion();
        } catch (Exception $e) {
            modelo_conexion::cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function listar_usuarios_list()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            usuario.id_usuario,
                CONCAT_WS( ' ', usuario.nombres, usuario.apellidos ) AS nombres,
                usuario.foto,
                usuario.nombres,
                usuario.apellidos,
                usuario.sexo,
                usuario.cedual,
                usuario.telefono,
                usuario.direccion,
                usuario.id_rol,
                usuario.usuario,
                usuario.pass,
                usuario.estado,
                usuario.correo,
                rol.tipo_rol 
            FROM
            rol
            INNER JOIN usuario ON rol.id_rol = usuario.id_rol";
            $query = $c->prepare($sql);
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            $arreglo = array();
            foreach ($result as $respuesta) {
                $arreglo["data"][] = $respuesta;
            }
            return $arreglo;
            //cerramos la conexion
            modelo_conexion::cerrar_conexion();
        } catch (Exception $e) {
            modelo_conexion::cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function estado_usuario($id, $dato)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_B = "UPDATE usuario SET estado = ? WHERE id_usuario = ?";
            $query_b = $c->prepare($sql_B);
            $query_b->bindParam(1, $dato);
            $query_b->bindParam(2, $id);
            if ($query_b->execute()) {
                $res = 1;
            } else {
                $res = 0;
            }
            return $res;

            //cerramos la conexion
            modelo_conexion::cerrar_conexion();
        } catch (Exception $e) {
            modelo_conexion::cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function editar_usuariosss($id, $nombre, $apellidos, $direccion, $telefono, $sexo, $cedula, $correo, $tipo_usu, $usuario, $pass)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_a = "SELECT * FROM usuario where cedual = ? AND id_usuario != ?";
            $query_a = $c->prepare($sql_a);
            $query_a->bindParam(1, $cedula);
            $query_a->bindParam(2, $id);
            $query_a->execute();
            $data_a = $query_a->fetch(PDO::FETCH_ASSOC);
            if (empty($data_a)) {
                $sql_b = "SELECT * FROM usuario where correo = ? AND id_usuario != ?";
                $query_b = $c->prepare($sql_b);
                $query_b->bindParam(1, $correo);
                $query_b->bindParam(2, $id);
                $query_b->execute();
                $data_b = $query_b->fetch(PDO::FETCH_ASSOC);
                if (empty($data_b)) {
                    $sql_x = "SELECT * FROM usuario where usuario = ? AND id_usuario != ?";
                    $query_x = $c->prepare($sql_x);
                    $query_x->bindParam(1, $usuario);
                    $query_x->bindParam(2, $id);
                    $query_x->execute();
                    $data_x = $query_x->fetch(PDO::FETCH_ASSOC);
                    if (empty($data_x)) {

                        $sql_c = "UPDATE usuario SET nombres = ?, apellidos = ?, sexo = ?, cedual = ?, telefono = ?, direccion = ?, id_rol = ?, usuario = ?, correo = ?, pass = ? WHERE id_usuario = ?";
                        $query_c = $c->prepare($sql_c);
                        $query_c->bindParam(1, $nombre);
                        $query_c->bindParam(2, $apellidos);
                        $query_c->bindParam(3, $sexo);
                        $query_c->bindParam(4, $cedula);
                        $query_c->bindParam(5, $telefono);
                        $query_c->bindParam(6, $direccion);
                        $query_c->bindParam(7, $tipo_usu);
                        $query_c->bindParam(8, $usuario);
                        $query_c->bindParam(9, $correo);
                        $query_c->bindParam(10, $pass);
                        $query_c->bindParam(11, $id);
                        if ($query_c->execute()) {
                            $res = 1; // registro exitoso
                        } else {
                            $res = "a"; // error en la inserccion
                        }
                    } else {
                        $res = "e"; // ya existe el usuario
                    }
                } else {
                    $res = "c"; // ya existe el correo de un empleado
                }
            } else {
                $res = "b"; // ya existe la cedula o numero documento
            }
            return $res;
            //cerramos la conexion
            modelo_conexion::cerrar_conexion();
        } catch (Exception $e) {
            modelo_conexion::cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function obtener_pemisos($id)
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * FROM permisos WHERE id_usuario = ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $id);
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            $arreglo = array();
            foreach ($result as $respuesta) {
                $arreglo[] = $respuesta;
            }
            return $arreglo;
            //cerramos la conexion
            modelo_conexion::cerrar_conexion();
        } catch (Exception $e) {
            modelo_conexion::cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function editar_permisos(
        $id_permis,
        $id_usu,
        string $conf,
        string $emples,
        string $asistens,
        string $mults,
        string $bens,
        string $rols,
        string $prods,
        string $creat_pords,
        string $provees,
        string $comps,
        string $list_comps,
        string $ofertas,
        string $servs,
        string $creat_cliens,
        string $crea_vehs,
        string $vents,
        string $cret_sers,
        string $list_reser,
        string $reports,
        string $segurs
    ) {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_a = "UPDATE permisos SET configuracion = ?, emples = ?, asistens = ?, mults = ?, bens = ?, rols = ?, prods = ?, creat_pords = ?, provees = ?, comps = ?, list_comps = ?, ofertas = ?, servs = ?, creat_cliens = ?, crea_vehs = ?, vents = ?, cret_sers = ?, list_reser = ?, reports = ?, segurs = ? WHERE id_usuario = ? AND permido_id = ?";
            $querya = $c->prepare($sql_a);
            $querya->bindParam(1, $conf);
            $querya->bindParam(2, $emples);
            $querya->bindParam(3, $asistens);
            $querya->bindParam(4, $mults);
            $querya->bindParam(5, $bens);
            $querya->bindParam(6, $rols);
            $querya->bindParam(7, $prods);
            $querya->bindParam(8, $creat_pords);
            $querya->bindParam(9, $provees);
            $querya->bindParam(10, $comps);
            $querya->bindParam(11, $list_comps);
            $querya->bindParam(12, $ofertas);
            $querya->bindParam(13, $servs);
            $querya->bindParam(14, $creat_cliens);
            $querya->bindParam(15, $crea_vehs);
            $querya->bindParam(16, $vents);
            $querya->bindParam(17, $cret_sers);
            $querya->bindParam(18, $list_reser);
            $querya->bindParam(19, $reports);
            $querya->bindParam(20, $segurs);
            $querya->bindParam(21, $id_usu);
            $querya->bindParam(22, $id_permis);

            if ($querya->execute()) {
                $res = 1; // SE INSERT CORRECTAMENTE
            } else {
                $res = 0; // FALLO EN LA MATRIX
            }
            return $res;

            //cerramos la conexion
            // modelo_conexion::cerrar_conexion();
        } catch (Exception $e) {
            // modelo_conexion::cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }
}
