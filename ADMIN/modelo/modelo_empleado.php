<?php
require_once 'modelo_conexion.php';
class modelo_empleado extends modelo_conexion
{

    function listar_cargo_()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            *
            FROM
            cargo
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

    function estado_tipo($id, $dato)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_B = "UPDATE cargo SET estado = ? WHERE id_cargo = ?";
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

    function registro_cargo($cargo)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_a = "SELECT * FROM cargo where tipo_cargo = ?";
            $query_a = $c->prepare($sql_a);
            $query_a->bindParam(1, $cargo);
            $query_a->execute();
            $data_a = $query_a->fetch(PDO::FETCH_ASSOC);

            if (empty($data_a)) {
                $sql_B = "INSERT INTO cargo (tipo_cargo) VALUES (?)";
                $query_b = $c->prepare($sql_B);
                $query_b->bindParam(1, $cargo);
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

    function editar_cargo($cargo, $id)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_a = "SELECT * FROM cargo where tipo_cargo = ? AND id_cargo != ?";
            $query_a = $c->prepare($sql_a);
            $query_a->bindParam(1, $cargo);
            $query_a->bindParam(2, $id);
            $query_a->execute();
            $data_a = $query_a->fetch(PDO::FETCH_ASSOC);

            if (empty($data_a)) {
                $sql_B = "UPDATE cargo SET tipo_cargo = ? WHERE id_cargo = ?";
                $query_b = $c->prepare($sql_B);
                $query_b->bindParam(1, $cargo);
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

    function listar_combo_cargo()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            *
            FROM
            cargo
            WHERE estado = 1";
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

    function registrar_empleado($nombres, $apellidos, $estado_civil, $direccion, $telefono, $correo, $fecha_n, $sexo, $cedula, $nivel_es, $totulo, $experiencia, $fech_i, $cargo, $valor_hora)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_a = "SELECT * FROM empleado where cedula = ?";
            $query_a = $c->prepare($sql_a);
            $query_a->bindParam(1, $cedula);
            $query_a->execute();
            $data_a = $query_a->fetch(PDO::FETCH_ASSOC);

            if (empty($data_a)) {
                $sql_d = "SELECT * FROM empleado where correo = ?";
                $query_d = $c->prepare($sql_d);
                $query_d->bindParam(1, $correo);
                $query_d->execute();
                $data_d = $query_d->fetch(PDO::FETCH_ASSOC);

                if (empty($data_d)) {
                    $sql_B = "INSERT INTO empleado (nombres, apellidos, estado_civil, direccion, telefono, correo, fecha_n, sexo, cedula, nivel_es, totulo, experiencia, fech_i, id_cargo, valor_hora) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
                    $query_b = $c->prepare($sql_B);
                    $query_b->bindParam(1, $nombres);
                    $query_b->bindParam(2, $apellidos);
                    $query_b->bindParam(3, $estado_civil);
                    $query_b->bindParam(4, $direccion);
                    $query_b->bindParam(5, $telefono);
                    $query_b->bindParam(6, $correo);
                    $query_b->bindParam(7, $fecha_n);
                    $query_b->bindParam(8, $sexo);
                    $query_b->bindParam(9, $cedula);
                    $query_b->bindParam(10, $nivel_es);
                    $query_b->bindParam(11, $totulo);
                    $query_b->bindParam(12, $experiencia);
                    $query_b->bindParam(13, $fech_i);
                    $query_b->bindParam(14, $cargo);
                    $query_b->bindParam(15, $valor_hora);

                    if ($query_b->execute()) {
                        $res = 1;
                    } else {
                        $res = 0;
                    }
                } else {
                    $res = 3; // correo ya existe                
                }
            } else {
                $res = 2; // cedula existe
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

    function listado_empleados()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            empleado.id_empleado, 
            empleado.nombres, 
            empleado.apellidos, 
            empleado.estado_civil, 
            empleado.direccion, 
            empleado.telefono, 
            empleado.correo, 
            empleado.fecha_n, 
            empleado.sexo, 
            empleado.cedula, 
            empleado.nivel_es, 
            empleado.totulo, 
            empleado.experiencia, 
            empleado.fech_i, 
            empleado.id_cargo, 
            cargo.tipo_cargo, 
            empleado.valor_hora, 
            empleado.estado,
            CONCAT_WS( ' ', empleado.nombres, empleado.apellidos ) AS empleado 
            FROM
            cargo
            INNER JOIN
            empleado
            ON 
                cargo.id_cargo = empleado.id_cargo ORDER BY id_empleado DESC";
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

    function estado_tipo_empleado($id, $dato)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_B = "UPDATE empleado SET estado = ? WHERE id_empleado = ?";
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

    function editar_empleadod($id, $nombres, $apellidos, $estado_civil, $direccion, $telefono, $correo, $fecha_n, $sexo, $cedula, $nivel_es, $totulo, $experiencia, $fech_i, $cargo, $valor_hora)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_a = "SELECT * FROM empleado where cedula = ? AND id_empleado != ?";
            $query_a = $c->prepare($sql_a);
            $query_a->bindParam(1, $cedula);
            $query_a->bindParam(2, $id);
            $query_a->execute();
            $data_a = $query_a->fetch(PDO::FETCH_ASSOC);

            if (empty($data_a)) {
                $sql_d = "SELECT * FROM empleado where correo = ? AND id_empleado != ?";
                $query_d = $c->prepare($sql_d);
                $query_d->bindParam(1, $correo);
                $query_d->bindParam(2, $id);
                $query_d->execute();
                $data_d = $query_d->fetch(PDO::FETCH_ASSOC);

                if (empty($data_d)) {
                    $sql_B = "UPDATE empleado set nombres = ?, apellidos = ?, estado_civil = ?, direccion = ?, telefono = ?, correo = ?, fecha_n = ?, sexo = ?, cedula = ?, nivel_es = ?, totulo = ?, experiencia = ?, fech_i = ?, id_cargo = ?, valor_hora = ? WHERE id_empleado = ?";
                    $query_b = $c->prepare($sql_B);
                    $query_b->bindParam(1, $nombres);
                    $query_b->bindParam(2, $apellidos);
                    $query_b->bindParam(3, $estado_civil);
                    $query_b->bindParam(4, $direccion);
                    $query_b->bindParam(5, $telefono);
                    $query_b->bindParam(6, $correo);
                    $query_b->bindParam(7, $fecha_n);
                    $query_b->bindParam(8, $sexo);
                    $query_b->bindParam(9, $cedula);
                    $query_b->bindParam(10, $nivel_es);
                    $query_b->bindParam(11, $totulo);
                    $query_b->bindParam(12, $experiencia);
                    $query_b->bindParam(13, $fech_i);
                    $query_b->bindParam(14, $cargo);
                    $query_b->bindParam(15, $valor_hora);
                    $query_b->bindParam(16, $id);

                    if ($query_b->execute()) {
                        $res = 1;
                    } else {
                        $res = 0;
                    }
                } else {
                    $res = 3; // correo ya existe                
                }
            } else {
                $res = 2; // cedula existe
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

    function listar_comob_empplado()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            empleado.id_empleado, 
            CONCAT_WS( ' ', empleado.nombres, empleado.apellidos, empleado.cedula) AS empleado 
            FROM
            cargo
            INNER JOIN
            empleado
            ON 
                cargo.id_cargo = empleado.id_cargo WHERE empleado.estado = 1 ORDER BY id_empleado DESC";
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

    function registrar_asistencia($id, $fecha, $hotra_ingreso, $hotra_salida, $estado)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_a = "SELECT * FROM asistencia where fecha = ? AND id_empleado = ? AND estado = 1 AND rol_pagos = 1";
            $query_a = $c->prepare($sql_a);
            $query_a->bindParam(1, $fecha);
            $query_a->bindParam(2, $id);
            $query_a->execute();
            $data_a = $query_a->fetch(PDO::FETCH_ASSOC);

            if (empty($data_a)) {

                $sql_B = "INSERT INTO asistencia (id_empleado, fecha, hora_ingreso, hora_salida, asistencia) VALUES (?,?,?,?,?)";
                $query_b = $c->prepare($sql_B);
                $query_b->bindParam(1, $id);
                $query_b->bindParam(2, $fecha);
                $query_b->bindParam(3, $hotra_ingreso);
                $query_b->bindParam(4, $hotra_salida);
                $query_b->bindParam(5, $estado);

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

    function editar_asistencia($id, $fechaingreso, $hora_ingreso, $hora_saida, $estado)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_a = "SELECT * FROM asistencia where fecha = ? AND estado = 1 AND rol_pagos = 1 AND id_asistencia != ?";
            $query_a = $c->prepare($sql_a);
            $query_a->bindParam(1, $fechaingreso);
            $query_a->bindParam(2, $id);
            $query_a->execute();
            $data_a = $query_a->fetch(PDO::FETCH_ASSOC);

            if (empty($data_a)) {

                $sql_B = "UPDATE asistencia SET fecha = ?, hora_ingreso = ?, hora_salida = ?, asistencia = ? WHERE id_asistencia = ?";
                $query_b = $c->prepare($sql_B);
                $query_b->bindParam(1, $fechaingreso);
                $query_b->bindParam(2, $hora_ingreso);
                $query_b->bindParam(3, $hora_saida);
                $query_b->bindParam(4, $estado);
                $query_b->bindParam(5, $id);

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

    function listar_asistencias()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            asistencia.id_asistencia, 
            empleado.nombres, 
            empleado.apellidos, 
            cargo.tipo_cargo, 
            asistencia.fecha, 
            asistencia.hora_ingreso, 
            asistencia.hora_salida, 
            asistencia.asistencia, 
            asistencia.estado, 
            asistencia.rol_pagos,
            CONCAT_WS(' ',empleado.nombres, 
            empleado.apellidos) as nombres
            FROM
            asistencia
            INNER JOIN
            empleado
            ON 
                asistencia.id_empleado = empleado.id_empleado
            INNER JOIN
            cargo
            ON 
                empleado.id_cargo = cargo.id_cargo ORDER BY asistencia.id_asistencia DESC";
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

    function eliminar_asistencia($id)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_B = "DELETE FROM asistencia WHERE id_asistencia = ?";
            $query_b = $c->prepare($sql_B);
            $query_b->bindParam(1, $id);

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

    function registrar_multa($id, $fecha, $tipo, $monto, $observacion)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_B = "INSERT INTO multas (id_empleado, fecha, tipo, monto, observacion) VALUES (?,?,?,?,?)";
            $query_b = $c->prepare($sql_B);
            $query_b->bindParam(1, $id);
            $query_b->bindParam(2, $fecha);
            $query_b->bindParam(3, $tipo);
            $query_b->bindParam(4, $monto);
            $query_b->bindParam(5, $observacion);

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

    function listar_multas()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            multas.id_multa,
            CONCAT_WS(' ',empleado.nombres,
            empleado.apellidos) as nombre,
            cargo.tipo_cargo,
            multas.fecha,
            multas.tipo,
            multas.monto,
            multas.observacion,
            multas.estado 
            FROM
            multas
            INNER JOIN empleado ON multas.id_empleado = empleado.id_empleado
            INNER JOIN cargo ON empleado.id_cargo = cargo.id_cargo ORDER BY multas.id_multa DESC";
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

    function eliminar_multa($id)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_B = "DELETE FROM multas WHERE id_multa = ?";
            $query_b = $c->prepare($sql_B);
            $query_b->bindParam(1, $id);

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

    function registra_permiso($id, $fecha, $tipo, $observacion)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_B = "INSERT INTO permiso (id_empleado, fecha, tipo, motivo) VALUES (?,?,?,?)";
            $query_b = $c->prepare($sql_B);
            $query_b->bindParam(1, $id);
            $query_b->bindParam(2, $fecha);
            $query_b->bindParam(3, $tipo);
            $query_b->bindParam(4, $observacion);

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

    function listar_permisos()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            permiso.id_permiso,
            CONCAT_WS( ' ', empleado.nombres, empleado.apellidos ) AS empledao,
            cargo.tipo_cargo,
            permiso.fecha,
            permiso.tipo,
            permiso.motivo 
            FROM
            permiso
            INNER JOIN empleado ON permiso.id_empleado = empleado.id_empleado
            INNER JOIN cargo ON empleado.id_cargo = cargo.id_cargo ORDER BY permiso.id_permiso DESC";
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

    function eliminar_permiso($id)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_B = "DELETE FROM permiso WHERE id_permiso = ?";
            $query_b = $c->prepare($sql_B);
            $query_b->bindParam(1, $id);

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

    function traer_asistencias($id)
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            asistencia.id_asistencia,
            asistencia.id_empleado,
            asistencia.fecha,
            asistencia.hora_ingreso,
            asistencia.hora_salida,
            asistencia.asistencia,
            asistencia.estado,
            asistencia.rol_pagos 
            FROM
            asistencia WHERE asistencia.estado = 1 AND asistencia.rol_pagos = 1 AND asistencia.id_empleado = ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $id);
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

    function traer_costo_hora($id)
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            empleado.valor_hora
            FROM
            empleado WHERE empleado.id_empleado = ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $id);
            $query->execute();
            $result = $query->fetch(PDO::FETCH_BOTH);
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

    function traer_multas($id)
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            multas.id_multa, 
            multas.id_empleado, 
            multas.fecha, 
            multas.tipo, 
            multas.monto, 
            multas.observacion, 
            multas.estado
            FROM
            multas WHERE multas.estado = 1 AND multas.id_empleado = ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $id);
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

    function registrar_beneficio($nombre, $valor, $tipo)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * FROM beneficio where nombre = ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $nombre);
            $query->execute();
            $data = $query->fetch(PDO::FETCH_ASSOC);

            if (empty($data)) {
                $sql_a = "INSERT INTO beneficio (nombre, valor, tipo) VALUES (?,?,?)";
                $querya = $c->prepare($sql_a);
                $querya->bindParam(1, $nombre);
                $querya->bindParam(2, $valor);
                $querya->bindParam(3, $tipo);

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

    function listra_beneficios()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            *
            FROM
            beneficio";
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

    function estado_benedifico($id, $dato)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_B = "UPDATE beneficio SET estado = ? WHERE id_beneficio = ?";
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

    function editr_beneficio($id, $nombre, $valor, $tipo)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * FROM beneficio where nombre = ? AND id_beneficio != ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $nombre);
            $query->bindParam(2, $id);
            $query->execute();
            $data = $query->fetch(PDO::FETCH_ASSOC);

            if (empty($data)) {
                $sql_a = "UPDATE beneficio SET nombre = ?, valor = ?, tipo = ? where id_beneficio = ?";
                $querya = $c->prepare($sql_a);
                $querya->bindParam(1, $nombre);
                $querya->bindParam(2, $valor);
                $querya->bindParam(3, $tipo);
                $querya->bindParam(4, $id);

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

    function listar_bebficios_rol()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            *
            FROM
            beneficio WHERE estado = 1";
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

    function registrar_rol_de_pagos($id_empleado, $fecha_pago, $valor_hora, $monto_dra, $total_ingreso, $total_egreso, $txtneto_pagar, $count_ingreso, $count_egreso)
    {
        try {
            $res = ""; 
            $c = modelo_conexion::conexionPDO();
            $sql_a = "INSERT INTO rol_pagos (id_empleado, fecha_pago, valor_hora, monto, total_ingreso, total_egreso, txtneto_pagar) VALUES (?,?,?,?,?,?,?)";
            $querya = $c->prepare($sql_a);
            $querya->bindParam(1, $id_empleado);
            $querya->bindParam(2, $fecha_pago);
            $querya->bindParam(3, $valor_hora);
            $querya->bindParam(4, $monto_dra);
            $querya->bindParam(5, $total_ingreso);
            $querya->bindParam(6, $total_egreso);
            $querya->bindParam(7, $txtneto_pagar); 

            if ($querya->execute()) {
                $res = $c->lastInsertId();
            } else {
                $res = 0;
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

    function registrar_detalle_ingreso($id, $arraglo_nombre, $arraglo_cantidad)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_a = "INSERT INTO detalle_rol_pago_ingreso (id_rol_pagos, nombre, cantidad) VALUES (?,?,?)";
            $querya = $c->prepare($sql_a);
            $querya->bindParam(1, $id);
            $querya->bindParam(2, $arraglo_nombre);
            $querya->bindParam(3, $arraglo_cantidad);

            if ($querya->execute()) {
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

    function registrar_detalle_egreso($id, $arraglo_nombre, $arraglo_cantidad)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_a = "INSERT INTO detalle_rol_pago_egreso (id_rol_pagos, nombre, cantidad) VALUES (?,?,?)";
            $querya = $c->prepare($sql_a);
            $querya->bindParam(1, $id);
            $querya->bindParam(2, $arraglo_nombre);
            $querya->bindParam(3, $arraglo_cantidad);

            if ($querya->execute()) {
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

    function pagar_multa_sancion($id, $arraglo_id_multa)
    {
        date_default_timezone_set('America/Guayaquil');
        $fecha = date("Y-m-d H:i:s");
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_a = "UPDATE multas SET estado = 0, fecha_paga_multa = ? WHERE id_empleado = ? AND id_multa = ?";
            $querya = $c->prepare($sql_a);
            $querya->bindParam(1, $fecha);
            $querya->bindParam(2, $id);
            $querya->bindParam(3, $arraglo_id_multa);

            if ($querya->execute()) {
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

    function sacra_asistencias($id, $arraglo_idasistencia)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_a = "UPDATE asistencia SET rol_pagos = 0 WHERE id_empleado = ? AND id_asistencia = ?";
            $querya = $c->prepare($sql_a);
            $querya->bindParam(1, $id);
            $querya->bindParam(2, $arraglo_idasistencia); 

            if ($querya->execute()) {
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

    function listar_rol_pagos()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            rol_pagos.id_rol_pagos,
            CONCAT_WS( ' ', empleado.nombres, empleado.apellidos, empleado.cedula ) AS empleado,
            cargo.tipo_cargo,
            rol_pagos.fecha_pago,
            rol_pagos.valor_hora,
            rol_pagos.monto,
            rol_pagos.total_ingreso,
            rol_pagos.total_egreso,
            rol_pagos.txtneto_pagar,
            rol_pagos.estado 
            FROM
            cargo
            INNER JOIN empleado ON cargo.id_cargo = empleado.id_cargo
            INNER JOIN rol_pagos ON empleado.id_empleado = rol_pagos.id_empleado ORDER BY rol_pagos.id_rol_pagos DESC";
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
}
