<?php
require_once 'modelo_conexion.php';
class modelo_servicio extends modelo_conexion
{

    function registrar_servicio($servicio, $precio, $detalle, $ruta)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_a = "SELECT * FROM servicio where servicio = ?";
            $query_a = $c->prepare($sql_a);
            $query_a->bindParam(1, $servicio);
            $query_a->execute();
            $data_a = $query_a->fetch(PDO::FETCH_ASSOC);

            if (empty($data_a)) {
                $sql_B = "INSERT INTO servicio (servicio, precio, detalle, foto) VALUES (?,?,?,?)";
                $query_b = $c->prepare($sql_B);
                $query_b->bindParam(1, $servicio);
                $query_b->bindParam(2, $precio);
                $query_b->bindParam(3, $detalle);
                $query_b->bindParam(4, $ruta);
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

    function listar_servicios_()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            *
            FROM
            servicio
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
            $sql_B = "UPDATE servicio SET estado = ? WHERE id_servicio = ?";
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

    function editar_servicio($id, $servicio, $precio, $detalle)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_a = "SELECT * FROM servicio where servicio = ? AND id_servicio != ?";
            $query_a = $c->prepare($sql_a);
            $query_a->bindParam(1, $servicio);
            $query_a->bindParam(2, $id);
            $query_a->execute();
            $data_a = $query_a->fetch(PDO::FETCH_ASSOC);

            if (empty($data_a)) {
                $sql_B = "UPDATE servicio SET servicio = ?, precio = ?, detalle = ? WHERE id_servicio = ?";
                $query_b = $c->prepare($sql_B);
                $query_b->bindParam(1, $servicio);
                $query_b->bindParam(2, $precio);
                $query_b->bindParam(3, $detalle);
                $query_b->bindParam(4, $id);
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

    function cambiar_foto_servicio($id, $ruta)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_B = "UPDATE servicio SET foto = ? WHERE id_servicio = ?";
            $query_b = $c->prepare($sql_B);
            $query_b->bindParam(1, $ruta); 
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

    /////////////////////////
    function registrar_cliente($nombre, $apellidos, $direccion, $telefonoo, $correo, $fecha, $sexo, $cedula)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();

            $sql_b = "SELECT * FROM cliente where nombres = ? AND apellidos = ?";
            $query_b = $c->prepare($sql_b);
            $query_b->bindParam(1, $nombre);
            $query_b->bindParam(2, $apellidos);
            $query_b->execute();
            $data_b = $query_b->fetch(PDO::FETCH_ASSOC);
            if (empty($data_b)) {

                $sql_d = "SELECT * FROM cliente where cedula = ?";
                $query_d = $c->prepare($sql_d);
                $query_d->bindParam(1, $cedula);
                $query_d->execute();
                $data_d = $query_d->fetch(PDO::FETCH_ASSOC);
                if (empty($data_d)) {

                    $sql_z = "SELECT * FROM cliente where correo = ? ";
                    $query_z = $c->prepare($sql_z);
                    $query_z->bindParam(1, $correo);
                    $query_z->execute();
                    $data_z = $query_z->fetch(PDO::FETCH_ASSOC);
                    if (empty($data_z)) {

                        $sql_c = "INSERT INTO cliente (nombres, apellidos, cedula, correo, direccion, fecha, sexo, telefono) VALUES (?,?,?,?,?,?,?,?)";
                        $query_c = $c->prepare($sql_c);
                        $query_c->bindParam(1, $nombre);
                        $query_c->bindParam(2, $apellidos);
                        $query_c->bindParam(3, $cedula);
                        $query_c->bindParam(4, $correo);
                        $query_c->bindParam(5, $direccion);
                        $query_c->bindParam(6, $fecha);
                        $query_c->bindParam(7, $sexo);
                        $query_c->bindParam(8, $telefonoo);
                        if ($query_c->execute()) {
                            $res = 1; // registro exitoso
                        } else {
                            $res = 0; // error en la inserccion
                        }
                    } else {
                        $res = 2; // correo ya existe
                    }
                } else {
                    $res = 3; // el numero de documento ya existe
                }
            } else {
                $res = 4; // los nombres y apellidos ya existen
            }

            return $res;
            //cerramos la conexion
            // modelo_conexion::cerrar_conexion();
        } catch (PDOException $e) {
            // modelo_conexion::cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function listar_clientes()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            *
            FROM
            cliente
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

    function estado_cliente($id, $dato)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_B = "UPDATE cliente SET estado = ? WHERE id_cliente = ?";
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

    function editar_clientee($id, $nombre, $apellidos, $direccion, $telefonoo, $correo, $fecha, $sexo, $cedula)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();

            $sql_b = "SELECT * FROM cliente where nombres = ? AND apellidos = ? AND id_cliente != ?";
            $query_b = $c->prepare($sql_b);
            $query_b->bindParam(1, $nombre);
            $query_b->bindParam(2, $apellidos);
            $query_b->bindParam(3, $id);
            $query_b->execute();
            $data_b = $query_b->fetch(PDO::FETCH_ASSOC);
            if (empty($data_b)) {

                $sql_d = "SELECT * FROM cliente where cedula = ? AND id_cliente != ?";
                $query_d = $c->prepare($sql_d);
                $query_d->bindParam(1, $cedula);
                $query_d->bindParam(2, $id);
                $query_d->execute();
                $data_d = $query_d->fetch(PDO::FETCH_ASSOC);
                if (empty($data_d)) {

                    $sql_z = "SELECT * FROM cliente where correo = ? AND id_cliente != ?";
                    $query_z = $c->prepare($sql_z);
                    $query_z->bindParam(1, $correo);
                    $query_z->bindParam(2, $id);
                    $query_z->execute();
                    $data_z = $query_z->fetch(PDO::FETCH_ASSOC);
                    if (empty($data_z)) {

                        $sql_c = "UPDATE cliente SET nombres = ?, apellidos = ?, cedula = ?, correo = ?, direccion = ?, fecha = ?, sexo = ?, telefono = ? WHERE id_cliente = ?";
                        $query_c = $c->prepare($sql_c);
                        $query_c->bindParam(1, $nombre);
                        $query_c->bindParam(2, $apellidos);
                        $query_c->bindParam(3, $cedula);
                        $query_c->bindParam(4, $correo);
                        $query_c->bindParam(5, $direccion);
                        $query_c->bindParam(6, $fecha);
                        $query_c->bindParam(7, $sexo);
                        $query_c->bindParam(8, $telefonoo);
                        $query_c->bindParam(9, $id);
                        if ($query_c->execute()) {
                            $res = 1; // registro exitoso
                        } else {
                            $res = 0; // error en la inserccion
                        }
                    } else {
                        $res = 2; // correo ya existe
                    }
                } else {
                    $res = 3; // el numero de documento ya existe
                }
            } else {
                $res = 4; // los nombres y apellidos ya existen
            }

            return $res;
            //cerramos la conexion
            // modelo_conexion::cerrar_conexion();
        } catch (PDOException $e) {
            // modelo_conexion::cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function listado_clientesss()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            cliente.id_cliente,
            CONCAT_WS( ' ', cliente.nombres, cliente.apellidos ) AS cliente,
            cliente.sexo,
            cliente.cedula,
            cliente.fecha 
        FROM
            cliente 
        WHERE
            cliente.estado = 1";
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

    function registrar_cita($fecha_inicio, $color, $color_etiqueta, $asunto, $nota, $id_cliente, $fecha, $hora)
    {
        try {
            $resp = "";
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * from cita WHERE cliente_id = ? AND DATE(start) = ? AND estado = 'En espera'";
            $query = $c->prepare($sql);
            $query->bindParam(1, $id_cliente);
            $query->bindParam(2, $fecha);
            $query->execute();
            $data = $query->fetch(PDO::FETCH_ASSOC);
            if (empty($data)) {

                $horr = "";
                $horr = $hora . ":00";

                $sql_c = "SELECT * from cita WHERE cliente_id != ? AND DATE(start) = ? AND TIME(start) = ? AND estado = 'En espera'";
                $query_c = $c->prepare($sql_c);
                $query_c->bindParam(1, $id_cliente);
                $query_c->bindParam(2, $fecha);
                $query_c->bindParam(3, $horr);
                $query_c->execute();
                $data_c = $query_c->fetch(PDO::FETCH_ASSOC);
                if (empty($data_c)) {

                    $sql_z = "SELECT * from cita WHERE cliente_id = ? AND estado = 'En espera'";
                    $query_z = $c->prepare($sql_z);
                    $query_z->bindParam(1, $id_cliente);
                    $query_z->execute();
                    $data_z = $query_z->fetch(PDO::FETCH_ASSOC);
                    if (empty($data_z)) {

                        $sql_a = "INSERT INTO cita(cliente_id,title,descripcion,start,color,textColor,estado) VALUES (?,?,?,?,?,?,'En espera')";
                        $query_a = $c->prepare($sql_a);
                        $query_a->bindParam(1, $id_cliente);
                        $query_a->bindParam(2, $asunto);
                        $query_a->bindParam(3, $nota);
                        $query_a->bindParam(4, $fecha_inicio);
                        $query_a->bindParam(5, $color);
                        $query_a->bindParam(6, $color_etiqueta);
                        if ($query_a->execute()) {
                            $resp = "N" . $c->lastInsertId(); // me devulev el ultim ID insertado 
                        } else {
                            $resp = 0; // error al registrar
                        }
                    } else {
                        $resp = 4; // el cliente haun tiene una cista pendiente no puede resgistra mas citas
                    }
                } else {
                    $resp = 3; // el cliente ya tiene una cita en la hora
                }
            } else {
                $resp = 2; // el cliente ya tiene una cita en la fecha
            }
            return $resp;
            //cerramos la conexion
            modelo_conexion::cerrar_conexion();
        } catch (Exception $e) {
            modelo_conexion::cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function listar_calendario()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            cita.id_cita,
            cita.cliente_id,
            cita.title AS titulo,
            CONCAT_WS( ' ', cita.title, ' - ', cliente.nombres, cliente.apellidos ) AS title,
            CONCAT_WS( ' ', cliente.nombres, cliente.apellidos ) AS cliente,
            cliente.cedula,
            cita.descripcion,
            cita.`start`,
            cita.estado,
            cita.color,
            cita.textColor,
            cita.id_reserva 
            FROM
            cita
            INNER JOIN cliente ON cita.cliente_id = cliente.id_cliente where cita.estado = 'En espera'";

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

    function editar_cita($id_cita, $fecha_inicio, $color, $color_etiqueta, $asunto, $nota, $id_cliente, $fecha, $hora)
    {
        try {
            $resp = "";
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * from cita WHERE cliente_id = ? AND DATE(start) = ? AND estado = 'En espera' AND id_cita != ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $id_cliente);
            $query->bindParam(2, $fecha);
            $query->bindParam(3, $id_cita);
            $query->execute();
            $data_a = $query->fetch(PDO::FETCH_ASSOC);
            if (empty($data_a)) {

                $horr = "";
                $horr = $hora . ":00";
                $sql_c = "SELECT * from cita WHERE cliente_id != ? AND DATE(start) = ? AND TIME(start) = ? AND estado = 'En espera' AND id_cita != ?";
                $query_c = $c->prepare($sql_c);
                $query_c->bindParam(1, $id_cliente);
                $query_c->bindParam(2, $fecha);
                $query_c->bindParam(3, $horr);
                $query_c->bindParam(4, $id_cita);
                $query_c->execute();
                $data_c = $query_c->fetch(PDO::FETCH_ASSOC);
                if (empty($data_c)) {

                    $sql_a = "UPDATE cita SET cliente_id = ?, title = ?, descripcion = ?, start = ?, color = ?, textColor = ? WHERE id_cita = ?";
                    $query_a = $c->prepare($sql_a);
                    $query_a->bindParam(1, $id_cliente);
                    $query_a->bindParam(2, $asunto);
                    $query_a->bindParam(3, $nota);
                    $query_a->bindParam(4, $fecha_inicio);
                    $query_a->bindParam(5, $color);
                    $query_a->bindParam(6, $color_etiqueta);
                    $query_a->bindParam(7, $id_cita);
                    if ($query_a->execute()) {
                        $resp = 1; // se edito con exito
                    } else {
                        $resp = 0; // error al editar
                    }
                } else {
                    $resp = 3; // el cliente ya tiene una cita en la hora
                }
            } else {
                $resp = 2; // el cliente ya tiene una cita en la fecha
            }

            return $resp;
            //cerramos la conexion
            // modelo_conexion::cerrar_conexion();
        } catch (Exception $e) {
            // modelo_conexion::cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function registrar_vehiculo($vehiculo)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_a = "SELECT * FROM vehiculo where vehiculo = ?";
            $query_a = $c->prepare($sql_a);
            $query_a->bindParam(1, $vehiculo);
            $query_a->execute();
            $data_a = $query_a->fetch(PDO::FETCH_ASSOC);

            if (empty($data_a)) {
                $sql_B = "INSERT INTO vehiculo (vehiculo) VALUES (?)";
                $query_b = $c->prepare($sql_B);
                $query_b->bindParam(1, $vehiculo);
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

    function listar_vehiculo()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            *
            FROM
            vehiculo
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

    function estado_vehiculo($id, $dato)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_B = "UPDATE vehiculo SET estado = ? WHERE id_vehiculo = ?";
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

    function editar_vehiculo($vehiculo, $id)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_a = "SELECT * FROM vehiculo where vehiculo = ? AND id_vehiculo != ?";
            $query_a = $c->prepare($sql_a);
            $query_a->bindParam(1, $vehiculo);
            $query_a->bindParam(2, $id);
            $query_a->execute();
            $data_a = $query_a->fetch(PDO::FETCH_ASSOC);

            if (empty($data_a)) {
                $sql_B = "UPDATE vehiculo SET vehiculo = ? WHERE id_vehiculo = ?";
                $query_b = $c->prepare($sql_B);
                $query_b->bindParam(1, $vehiculo);
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

    function listar_cliente_combo()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            cliente.id_cliente,
            CONCAT_WS( ' ', cliente.nombres, cliente.apellidos ) AS cliente,
            cliente.cedula,
            cliente.correo 
            FROM
            cliente
            WHERE
            cliente.estado = 1";

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

    function listar_tpi_vehculo_combo()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            *
            FROM
            vehiculo
            WHERE
            estado = 1";

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

    function listar_marca_combo()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            *
            FROM
            marca_vehiculo
            WHERE
            estado = 1";

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

    function registrar_marca($marca)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_a = "SELECT * FROM marca_vehiculo where marca = ?";
            $query_a = $c->prepare($sql_a);
            $query_a->bindParam(1, $marca);
            $query_a->execute();
            $data_a = $query_a->fetch(PDO::FETCH_ASSOC);

            if (empty($data_a)) {
                $sql_B = "INSERT INTO marca_vehiculo (marca) VALUES (?)";
                $query_b = $c->prepare($sql_B);
                $query_b->bindParam(1, $marca);
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

    function listar_marcha_vehiculo()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            *
            FROM
            marca_vehiculo
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

    function cambiar_estado_m_hiculo($id, $dato)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_B = "UPDATE marca_vehiculo SET estado = ? WHERE id_marca = ?";
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

    function editar_marca_vehocuo($marca, $id)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_a = "SELECT * FROM marca_vehiculo where marca = ? AND id_marca != ?";
            $query_a = $c->prepare($sql_a);
            $query_a->bindParam(1, $marca);
            $query_a->bindParam(2, $id);
            $query_a->execute();
            $data_a = $query_a->fetch(PDO::FETCH_ASSOC);

            if (empty($data_a)) {
                $sql_B = "UPDATE marca_vehiculo SET marca = ? WHERE id_marca = ?";
                $query_b = $c->prepare($sql_B);
                $query_b->bindParam(1, $marca);
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

    /////////////////////////
    function registra_vehoculo_cliente($cliente, $fecha, $tipo_vehoculo, $tipo_marca, $matrcula, $color, $detalle, $ruta)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();

            $sql_c = "INSERT INTO vehiculo_cliente (cliente, fecha, tipo_vehoculo, tipo_marca, matrcula, color, detalle, ruta) VALUES (?,?,?,?,?,?,?,?)";
            $query_c = $c->prepare($sql_c);
            $query_c->bindParam(1, $cliente);
            $query_c->bindParam(2, $fecha);
            $query_c->bindParam(3, $tipo_vehoculo);
            $query_c->bindParam(4, $tipo_marca);
            $query_c->bindParam(5, $matrcula);
            $query_c->bindParam(6, $color);
            $query_c->bindParam(7, $detalle);
            $query_c->bindParam(8, $ruta);
            if ($query_c->execute()) {
                $res = 1; // registro exitoso
            } else {
                $res = 0; // error en la inserccion
            }

            return $res;
            //cerramos la conexion
            modelo_conexion::cerrar_conexion();
        } catch (PDOException $e) {
            modelo_conexion::cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function listar_vehculos_clientess()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            vehiculo_cliente.id_clie_vehi,
            vehiculo_cliente.cliente as id_cliente,
            CONCAT_WS( ' ', cliente.nombres, cliente.apellidos ) AS cliente,
            vehiculo_cliente.fecha,
            vehiculo_cliente.tipo_vehoculo,
            vehiculo.vehiculo,
            vehiculo_cliente.tipo_marca,
            marca_vehiculo.marca,
            vehiculo_cliente.matrcula,
            vehiculo_cliente.color,
            vehiculo_cliente.detalle,
            vehiculo_cliente.ruta,
            vehiculo_cliente.estado 
            FROM
            vehiculo_cliente
            INNER JOIN vehiculo ON vehiculo_cliente.tipo_vehoculo = vehiculo.id_vehiculo
            INNER JOIN marca_vehiculo ON vehiculo_cliente.tipo_marca = marca_vehiculo.id_marca
            INNER JOIN cliente ON vehiculo_cliente.cliente = cliente.id_cliente";
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

    function cambiar_estado_vehiculo_registro_cli($id, $dato)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_B = "UPDATE vehiculo_cliente SET estado = ? WHERE id_clie_vehi = ?";
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

    /////////////////////////
    function editar_vehiculo_cliente($id, $cliente, $fecha, $tipo_vehoculo, $tipo_marca, $matrcula, $color, $detalle)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();

            $sql_c = "UPDATE vehiculo_cliente SET cliente = ?, fecha = ?, tipo_vehoculo = ?, tipo_marca = ?, matrcula = ?, color = ?, detalle = ? WHERE id_clie_vehi = ?";
            $query_c = $c->prepare($sql_c);
            $query_c->bindParam(1, $cliente);
            $query_c->bindParam(2, $fecha);
            $query_c->bindParam(3, $tipo_vehoculo);
            $query_c->bindParam(4, $tipo_marca);
            $query_c->bindParam(5, $matrcula);
            $query_c->bindParam(6, $color);
            $query_c->bindParam(7, $detalle);
            $query_c->bindParam(8, $id);
            if ($query_c->execute()) {
                $res = 1; // registro exitoso
            } else {
                $res = 0; // error en la inserccion
            }

            return $res;
            //cerramos la conexion
            modelo_conexion::cerrar_conexion();
        } catch (PDOException $e) {
            modelo_conexion::cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function cambiar_foto_vehoculo($id, $ruta)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_c = "UPDATE vehiculo_cliente SET ruta = ? WHERE id_clie_vehi = ?";
            $query_c = $c->prepare($sql_c);
            $query_c->bindParam(1, $ruta);
            $query_c->bindParam(2, $id);
            if ($query_c->execute()) {
                $res = 1; // registro exitoso
            } else {
                $res = 0; // error en la inserccion
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

    function listar_clientes_agg()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            cliente.id_cliente,
            CONCAT_WS( ' ', cliente.nombres, cliente.apellidos ) AS cliente,
            cliente.sexo,
            cliente.cedula,
            cliente.fecha,
            cliente.correo
            FROM
                cliente 
            WHERE
            cliente.estado = 1";
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

    function listado_prodcutos_venta_agg()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            producto.id_producto,
            producto.poducto_codigo,
            producto.producto_nombre,
            producto.tipo_producto_id,
            tipo_producto.tipo_producto,
            producto.marca_producto_id,
            marca.marca,
            producto.producto_detalle,
            producto.producto_precio_venta,
            producto.producto_foto,
            producto.estado,
            producto.producto_destacar,
            producto._eliminado,
            producto.stock
            FROM
            marca
            INNER JOIN producto ON marca.id_marca = producto.marca_producto_id
            INNER JOIN tipo_producto ON producto.tipo_producto_id = tipo_producto.id_tipo_producto
            WHERE producto._eliminado = 1 AND producto.stock IS NOT NULL";
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

    function traer_promocion_prod($id)
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            ofertas.id_ofertas,
            ofertas.producto_id,
            ofertas.fecha_inic,
            ofertas.fecha_fin,
            ofertas.nombre_oferta,
            ofertas.procentaje,
            ofertas.tipo_descue 
            FROM
                ofertas 
            WHERE
            ofertas.producto_id = ?";
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

    function registrar_venta($id_cliente, $impuesto, $tipo_comprobante, $num_compro, $fecha_venta, $count, $txt_totalneto, $txt_impuesto, $txt_a_pagar, $id)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_c = "INSERT INTO venta (cliente_id, impuesto, tipo_doc, numero_comprob, fecha, cantidad, subtotal, impuesto_sub, total, estado, tipo_pago) 
                            VALUES (?,?,?,?,?,?,?,?,?,'Vendido','Caja')";
            $query_c = $c->prepare($sql_c);
            $query_c->bindParam(1, $id_cliente);
            $query_c->bindParam(2, $impuesto);
            $query_c->bindParam(3, $tipo_comprobante);
            $query_c->bindParam(4, $num_compro);
            $query_c->bindParam(5, $fecha_venta);
            $query_c->bindParam(6, $count);
            $query_c->bindParam(7, $txt_totalneto);
            $query_c->bindParam(8, $txt_impuesto);
            $query_c->bindParam(9, $txt_a_pagar);
            if ($query_c->execute()) {
                $res = $c->lastInsertId(); // me devulev el ultim ID insertado 
            } else {
                $res = 0; // error en la inserccion
            }

            $ip = $_SERVER['REMOTE_ADDR'];
            $app = $_SERVER['HTTP_USER_AGENT'];

            date_default_timezone_set('America/Guayaquil');
            $fecha_hora = date("Y-m-d H:m:s");
            $opreacion = "Inserto venta";

            $sql_a = "INSERT INTO auditoria_venta (id_usuario, fecha_hora, app, ip, n_venta, cantidad, total, operacion) 
            VALUES (?,?,?,?,?,?,?,?)";
            $query_a = $c->prepare($sql_a);
            $query_a->bindParam(1, $id);
            $query_a->bindParam(2, $fecha_hora);
            $query_a->bindParam(3, $app);
            $query_a->bindParam(4, $ip);
            $query_a->bindParam(5, $num_compro);
            $query_a->bindParam(6, $count);
            $query_a->bindParam(7, $txt_a_pagar);
            $query_a->bindParam(8, $opreacion);
            $query_a->execute();

            return $res;
            //cerramos la conexion
            modelo_conexion::cerrar_conexion();
        } catch (Exception $e) {
            modelo_conexion::cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function registrar_detalle_venta($id, $arraglo_idproducto, $arraglo_cantidad, $arraglo_precio, $arraglo_des_promo, $arraglo_tipo_promo, $arraglo_descuento_moneda, $arraglo_subtotal)
    {
        try {
            $res = "";
            $stock = 0;
            $stock_e = 0;
            $c = modelo_conexion::conexionPDO();
            $sql_c = "INSERT INTO detalle_venta (id_venta, producto_id, cantidad, precio, descuento_oferta, tipo_promo,  descuento_moneda, subtotal) 
                            VALUES (?,?,?,?,?,?,?,?)";
            $query_c = $c->prepare($sql_c);
            $query_c->bindParam(1, $id);
            $query_c->bindParam(2, $arraglo_idproducto);
            $query_c->bindParam(3, $arraglo_cantidad);
            $query_c->bindParam(4, $arraglo_precio);
            $query_c->bindParam(5, $arraglo_des_promo);
            $query_c->bindParam(6, $arraglo_tipo_promo);
            $query_c->bindParam(7, $arraglo_descuento_moneda);
            $query_c->bindParam(8, $arraglo_subtotal);
            if ($query_c->execute()) {

                $sql_p = "SELECT stock FROM producto where id_producto = ?";
                $query_p = $c->prepare($sql_p);
                $query_p->bindParam(1, $arraglo_idproducto);
                $query_p->execute();
                $data = $query_p->fetch(PDO::FETCH_BOTH);
                $arreglo = array();
                foreach ($data as $respuesta) {
                    $arreglo[] = $respuesta;
                }

                $stock = $arreglo[0];
                if ($stock == "" || $stock == 0) {
                    $stock = 0;
                }
                $stock = $stock - $arraglo_cantidad;

                $sql_m = "UPDATE producto SET stock = ? where id_producto = ?";
                $query_m = $c->prepare($sql_m);
                $query_m->bindParam(1, $stock);
                $query_m->bindParam(2, $arraglo_idproducto);
                if ($query_m->execute()) {

                    $sql_e = "SELECT stock FROM producto where id_producto = ?";
                    $query_e = $c->prepare($sql_e);
                    $query_e->bindParam(1, $arraglo_idproducto);
                    $query_e->execute();
                    $data_e = $query_e->fetch(PDO::FETCH_BOTH);
                    $arreglo_e = array();
                    foreach ($data_e as $respuesta_e) {
                        $arreglo_e[] = $respuesta_e;
                    }

                    $stock_e = $arreglo_e[0];
                    if ($stock_e == 0) {
                        $sql_ee = "UPDATE producto SET estado = 'agotado' where id_producto = ?";
                        $query_ee = $c->prepare($sql_ee);
                        $query_ee->bindParam(1, $arraglo_idproducto);
                        if ($query_ee->execute()) {
                            $res = 1;
                        } else {
                            $res = 0;
                        }
                    }
                    $res = 1; // registro del detalle es exitoso
                } else {
                    $res = 2; // error de update
                }
            } else {
                $res = 0; // error en la inserccion detalle
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

    function listado_ventas()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            venta.id_venta,
            venta.cliente_id,
            CONCAT_WS( ' ', cliente.nombres, cliente.apellidos ) AS cliente,
            venta.impuesto,
            venta.tipo_doc,
            venta.numero_comprob,
            venta.fecha,
            venta.cantidad,
            venta.subtotal,
            venta.impuesto_sub,
            venta.total,
            venta.estado,
            venta.tipo_pago 
            FROM
            cliente
            INNER JOIN venta ON cliente.id_cliente = venta.cliente_id";
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

    function detalle_de_venta($id)
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql_c = "SELECT
            detalle_venta.id_detalle_venta,
            detalle_venta.id_venta,
            producto.producto_nombre,
            tipo_producto.tipo_producto,
            marca.marca,
            detalle_venta.cantidad,
            detalle_venta.precio,
            detalle_venta.descuento_oferta,
            detalle_venta.tipo_promo,
            detalle_venta.descuento_moneda,
            detalle_venta.subtotal 
            FROM
            detalle_venta
            INNER JOIN producto ON detalle_venta.producto_id = producto.id_producto
            INNER JOIN marca ON producto.marca_producto_id = marca.id_marca
            INNER JOIN tipo_producto ON producto.tipo_producto_id = tipo_producto.id_tipo_producto WHERE detalle_venta.id_venta = ?";
            $query = $c->prepare($sql_c);
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

    function anular_venta($id, $id_ussu)
    {
        try {
            $res = "";
            $stock = 0;
            $c = modelo_conexion::conexionPDO();
            $sql_c = "SELECT * FROM detalle_venta WHERE id_venta = ?";
            $query_c = $c->prepare($sql_c);
            $query_c->bindParam(1, $id);
            $query_c->execute();
            $data = $query_c->fetchAll(PDO::FETCH_BOTH);
            foreach ($data as $respuesta) {

                $sql_a = "SELECT * FROM producto WHERE id_producto = ?";
                $query_a = $c->prepare($sql_a);
                $query_a->bindParam(1, $respuesta[1]);
                $query_a->execute();
                $dato = $query_a->fetchAll(PDO::FETCH_BOTH);
                foreach ($dato as $respuesto) {

                    $stock =  $respuesto[11] + $respuesta[3];
                    // $stock =  $respuesto[7] - $respuesta[3];
                    $sql_p = "UPDATE producto SET stock = ? where id_producto = ?";
                    $query_p = $c->prepare($sql_p);
                    $query_p->bindParam(1, $stock);
                    $query_p->bindParam(2, $respuesta[1]);
                    if ($query_p->execute()) {

                        $sql_d = "UPDATE detalle_venta SET estado_detalle = 0 where id_venta = ?";
                        $query_d = $c->prepare($sql_d);
                        $query_d->bindParam(1, $id);
                        $query_d->execute();
                    }
                }
            }

            $sql_F = "UPDATE venta SET estado = 'Anulado' WHERE id_venta = ?";
            $query_F = $c->prepare($sql_F);
            $query_F->bindParam(1, $id);
            if ($query_F->execute()) {

                $sql_dd = "UPDATE producto SET estado = 'activo' WHERE id_producto = ?";
                $query_dd = $c->prepare($sql_dd);
                $query_dd->bindParam(1, $respuesta[1]);
                if ($query_dd->execute()) {
                    $res = 1;
                } else {
                    $res = 0;
                }
            } else {
                $res = 0;
            }

            $sql_au = "SELECT * FROM venta WHERE id_venta = ?";
            $query_au = $c->prepare($sql_au);
            $query_au->bindParam(1, $id);
            $query_au->execute();
            $data_au = $query_au->fetchAll(PDO::FETCH_BOTH);
            foreach ($data_au as $respuesta_au) {

                $ip = $_SERVER['REMOTE_ADDR'];
                $app = $_SERVER['HTTP_USER_AGENT'];

                date_default_timezone_set('America/Guayaquil');
                $fecha_hora = date("Y-m-d H:m:s");
                $opreacion = "Anulo venta";

                $sql_a = "INSERT INTO auditoria_venta (id_usuario, fecha_hora, app, ip, n_venta, cantidad, total, operacion) 
                VALUES (?,?,?,?,?,?,?,?)";
                $query_a = $c->prepare($sql_a);
                $query_a->bindParam(1, $id_ussu);
                $query_a->bindParam(2, $fecha_hora);
                $query_a->bindParam(3, $app);
                $query_a->bindParam(4, $ip);
                $query_a->bindParam(5, $respuesta_au[4]);
                $query_a->bindParam(6, $respuesta_au[6]);
                $query_a->bindParam(7, $respuesta_au[9]);
                $query_a->bindParam(8, $opreacion);
                $query_a->execute();
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

    function listar_clientes_vehoculos()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            vehiculo_cliente.cliente,
            cliente.nombres,
            cliente.apellidos,
            cliente.cedula,
            cliente.correo  
            FROM
                cliente
                INNER JOIN vehiculo_cliente ON cliente.id_cliente = vehiculo_cliente.cliente 
            WHERE
                cliente.estado = 1 
            GROUP BY
            vehiculo_cliente.cliente";
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

    function traer_datos_vehiculos_clientes($id)
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            vehiculo_cliente.id_clie_vehi,
            vehiculo.vehiculo,
            marca_vehiculo.marca,
            vehiculo_cliente.matrcula,
            vehiculo_cliente.color,
            vehiculo_cliente.estado, 
	        vehiculo_cliente.cliente
        FROM
            vehiculo_cliente
            INNER JOIN marca_vehiculo ON vehiculo_cliente.tipo_marca = marca_vehiculo.id_marca
            INNER JOIN vehiculo ON vehiculo_cliente.tipo_vehoculo = vehiculo.id_vehiculo 
        WHERE
            vehiculo_cliente.estado = 1 AND vehiculo_cliente.cliente = ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $id);
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

    function listar_servicios()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT 
            *
            FROM
            servicio
            WHERE estado = 1 ";
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

    function traer_precio_servicios($id)
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT 
            *
            FROM
            servicio
            WHERE id_servicio = ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $id);
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

    function registar_servicio_cliente($vehculos_id, $inpuesto, $tipo_comprobante, $num_compro, $fecha, $txt_total_servico, $txt_totalneto, $txt_impuesto, $txt_a_pagar, $id_ussu)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_c = "INSERT INTO servicio_cliente (id_vehiculo_cliente, inpuesto, tipo_comprobante, num_compro, fecha, total_servico, totalneto_pro, impuesto_pro, total_pago_pro, tipo_pago) 
                            VALUES (?,?,?,?,?,?,?,?,?,'Caja')";
            $query_c = $c->prepare($sql_c);
            $query_c->bindParam(1, $vehculos_id);
            $query_c->bindParam(2, $inpuesto);
            $query_c->bindParam(3, $tipo_comprobante);
            $query_c->bindParam(4, $num_compro);
            $query_c->bindParam(5, $fecha);
            $query_c->bindParam(6, $txt_total_servico);
            $query_c->bindParam(7, $txt_totalneto);
            $query_c->bindParam(8, $txt_impuesto);
            $query_c->bindParam(9, $txt_a_pagar);
            if ($query_c->execute()) {
                $res = $c->lastInsertId(); // me devulev el ultim ID insertado 
            } else {
                $res = 0; // error en la inserccion
            }

            $ip = $_SERVER['REMOTE_ADDR'];
            $app = $_SERVER['HTTP_USER_AGENT'];

            date_default_timezone_set('America/Guayaquil');
            $fecha_hora = date("Y-m-d H:m:s");
            $opreacion = "Inserto servicio";

            $sql_a = "INSERT INTO auditoria_servicios (id_usuario, fecha_hora, app, ip, n_venta, total, operacion) 
            VALUES (?,?,?,?,?,?,?)";
            $query_a = $c->prepare($sql_a);
            $query_a->bindParam(1, $id_ussu);
            $query_a->bindParam(2, $fecha_hora);
            $query_a->bindParam(3, $app);
            $query_a->bindParam(4, $ip);
            $query_a->bindParam(5, $num_compro);
            $query_a->bindParam(6, $txt_total_servico);
            $query_a->bindParam(7, $opreacion);
            $query_a->execute();

            return $res;
            //cerramos la conexion
            modelo_conexion::cerrar_conexion();
        } catch (Exception $e) {
            modelo_conexion::cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function registrar_detalle_servicioo($id, $arraglo_idservicio, $arraglo_precio, $arraglo_cantidad, $arraglo_descuento, $arraglo_subtotal)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_c = "INSERT INTO detalle_servicios_cliente (id_servicio_cliente, id_servicio, cantidad, precio, descuento, subtotal) 
                            VALUES (?,?,?,?,?,?)";
            $query_c = $c->prepare($sql_c);
            $query_c->bindParam(1, $id);
            $query_c->bindParam(2, $arraglo_idservicio);
            $query_c->bindParam(3, $arraglo_cantidad);
            $query_c->bindParam(4, $arraglo_precio);
            $query_c->bindParam(5, $arraglo_descuento);
            $query_c->bindParam(6, $arraglo_subtotal);
            if ($query_c->execute()) {
                $res = 1; // me devulev el ultim ID insertado 
            } else {
                $res = 0; // error en la inserccion
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

    function registrar_detalle_producto_servicio($id, $arraglo_idproducto, $arraglo_cantidad, $arraglo_precio, $arraglo_des_promo, $arraglo_tipo_promo, $arraglo_descuento_moneda, $arraglo_subtotal)
    {
        try {
            $res = "";
            $stock = 0;
            $stock_e = 0;
            $c = modelo_conexion::conexionPDO();
            $sql_c = "INSERT INTO detalle_servicio_producto (id_servicio_cliente, producto_id, cantidad, precio, descuento_oferta, tipo_promo,  descuento_moneda, subtotal) 
                            VALUES (?,?,?,?,?,?,?,?)";
            $query_c = $c->prepare($sql_c);
            $query_c->bindParam(1, $id);
            $query_c->bindParam(2, $arraglo_idproducto);
            $query_c->bindParam(3, $arraglo_cantidad);
            $query_c->bindParam(4, $arraglo_precio);
            $query_c->bindParam(5, $arraglo_des_promo);
            $query_c->bindParam(6, $arraglo_tipo_promo);
            $query_c->bindParam(7, $arraglo_descuento_moneda);
            $query_c->bindParam(8, $arraglo_subtotal);
            if ($query_c->execute()) {

                $sql_p = "SELECT stock FROM producto where id_producto = ?";
                $query_p = $c->prepare($sql_p);
                $query_p->bindParam(1, $arraglo_idproducto);
                $query_p->execute();
                $data = $query_p->fetch(PDO::FETCH_BOTH);
                $arreglo = array();
                foreach ($data as $respuesta) {
                    $arreglo[] = $respuesta;
                }

                $stock = $arreglo[0];
                if ($stock == "" || $stock == 0) {
                    $stock = 0;
                }
                $stock = $stock - $arraglo_cantidad;

                $sql_m = "UPDATE producto SET stock = ? where id_producto = ?";
                $query_m = $c->prepare($sql_m);
                $query_m->bindParam(1, $stock);
                $query_m->bindParam(2, $arraglo_idproducto);
                if ($query_m->execute()) {

                    $sql_e = "SELECT stock FROM producto where id_producto = ?";
                    $query_e = $c->prepare($sql_e);
                    $query_e->bindParam(1, $arraglo_idproducto);
                    $query_e->execute();
                    $data_e = $query_e->fetch(PDO::FETCH_BOTH);
                    $arreglo_e = array();
                    foreach ($data_e as $respuesta_e) {
                        $arreglo_e[] = $respuesta_e;
                    }

                    $stock_e = $arreglo_e[0];
                    if ($stock_e == 0) {
                        $sql_ee = "UPDATE producto SET estado = 'agotado' where id_producto = ?";
                        $query_ee = $c->prepare($sql_ee);
                        $query_ee->bindParam(1, $arraglo_idproducto);
                        if ($query_ee->execute()) {
                            $res = 1;
                        } else {
                            $res = 0;
                        }
                    }
                    $res = 1; // registro del detalle es exitoso
                } else {
                    $res = 2; // error de update
                }
            } else {
                $res = 0; // error en la inserccion detalle
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

    function lisra_servicios_clientes()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            servicio_cliente.id_servicio_cliente,
            CONCAT_WS( ' ', cliente.nombres, cliente.apellidos ) AS cliente,
            CONCAT_WS( ' ', 'Vehiculo: ', vehiculo.vehiculo, ' - Marca: ', marca_vehiculo.marca, ' - Matricula: ', vehiculo_cliente.matrcula, ' - Color: ', vehiculo_cliente.color ) AS vehiculo,
            servicio_cliente.inpuesto,
            servicio_cliente.tipo_comprobante,
            servicio_cliente.num_compro,
            servicio_cliente.fecha,
            servicio_cliente.total_servico,
            servicio_cliente.totalneto_pro,
            servicio_cliente.impuesto_pro,
            servicio_cliente.total_pago_pro,
            servicio_cliente.estado,
            servicio_cliente.tipo_pago 
            FROM
                servicio_cliente
                INNER JOIN vehiculo_cliente ON servicio_cliente.id_vehiculo_cliente = vehiculo_cliente.id_clie_vehi
                INNER JOIN cliente ON vehiculo_cliente.cliente = cliente.id_cliente
                INNER JOIN vehiculo ON vehiculo_cliente.tipo_vehoculo = vehiculo.id_vehiculo
                INNER JOIN marca_vehiculo ON vehiculo_cliente.tipo_marca = marca_vehiculo.id_marca 
            ORDER BY
            servicio_cliente.id_servicio_cliente DESC";

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

    function cargar_detalle_servciio($id)
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql_c = "SELECT
            detalle_servicios_cliente.id_detalle_sericios,
            detalle_servicios_cliente.id_servicio_cliente,
            servicio.servicio,
            detalle_servicios_cliente.precio,
            detalle_servicios_cliente.cantidad,
            detalle_servicios_cliente.descuento,
            detalle_servicios_cliente.subtotal 
            FROM
                detalle_servicios_cliente
                INNER JOIN servicio ON detalle_servicios_cliente.id_servicio = servicio.id_servicio 
            WHERE
            detalle_servicios_cliente.id_servicio_cliente = ?";
            $query = $c->prepare($sql_c);
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

    function cargar_detalle_venta_servicio($id)
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql_c = "SELECT
            detalle_servicio_producto.id_detalle_poducto_servcios,
            detalle_servicio_producto.id_servicio_cliente,
            producto.producto_nombre,
            tipo_producto.tipo_producto,
            marca.marca,
            detalle_servicio_producto.cantidad,
            detalle_servicio_producto.precio,
            detalle_servicio_producto.descuento_oferta,
            detalle_servicio_producto.tipo_promo,
            detalle_servicio_producto.descuento_moneda,
            detalle_servicio_producto.subtotal 
            FROM
                detalle_servicio_producto
                INNER JOIN producto ON detalle_servicio_producto.producto_id = producto.id_producto
                INNER JOIN tipo_producto ON producto.tipo_producto_id = tipo_producto.id_tipo_producto
                INNER JOIN marca ON producto.marca_producto_id = marca.id_marca 
            WHERE
            detalle_servicio_producto.id_servicio_cliente = ?";

            $query = $c->prepare($sql_c);
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

    function anula_servicio_compra($id, $id_ussu)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();

            $sql_F = "UPDATE servicio_cliente SET estado = 0 WHERE id_servicio_cliente = ?";
            $query_F = $c->prepare($sql_F);
            $query_F->bindParam(1, $id);
            if ($query_F->execute()) {
                $res = 1;
            } else {
                $res = 0;
            }

            $sql_au = "SELECT * FROM servicio_cliente WHERE id_servicio_cliente = ?";
            $query_au = $c->prepare($sql_au);
            $query_au->bindParam(1, $id);
            $query_au->execute();
            $data_au = $query_au->fetchAll(PDO::FETCH_BOTH);
            foreach ($data_au as $respuesta_au) {

                $ip = $_SERVER['REMOTE_ADDR'];
                $app = $_SERVER['HTTP_USER_AGENT'];

                date_default_timezone_set('America/Guayaquil');
                $fecha_hora = date("Y-m-d H:m:s");
                $opreacion = "Anulo servicio";

                $sql_a = "INSERT INTO auditoria_servicios (id_usuario, fecha_hora, app, ip, n_venta, total, operacion) 
                VALUES (?,?,?,?,?,?,?)";
                $query_a = $c->prepare($sql_a);
                $query_a->bindParam(1, $id_ussu);
                $query_a->bindParam(2, $fecha_hora);
                $query_a->bindParam(3, $app);
                $query_a->bindParam(4, $ip);
                $query_a->bindParam(5, $respuesta_au[4]);
                $query_a->bindParam(6, $respuesta_au[6]);
                $query_a->bindParam(7, $opreacion);
                $query_a->execute();
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

    function listar_reservass()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql_c = "SELECT
            cita.id_cita,
            CONCAT_WS( ' ', cliente.nombres, cliente.apellidos ) AS cliente,
            cita.title,
            cita.descripcion,
            cita.`start`,
            cita.estado,
            cita.color,
            cita.textColor,
            cita.id_reserva 
            FROM
            cita
            INNER JOIN cliente ON cita.cliente_id = cliente.id_cliente";
            $query = $c->prepare($sql_c);
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

    function atendiendo_servicio_reserva($id)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();

            $sql_F = "UPDATE cita SET estado = 'Atentido' WHERE id_cita = ?";
            $query_F = $c->prepare($sql_F);
            $query_F->bindParam(1, $id);
            if ($query_F->execute()) {
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

    function eliminar_reserva_cliente($id_cita, $id_reserva)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();

            $sql_F = "DELETE FROM cita  WHERE id_cita = ?";
            $query_F = $c->prepare($sql_F);
            $query_F->bindParam(1, $id_cita);
            if ($query_F->execute()) {
                $sql = "UPDATE servicio_cliente SET estado = 0  WHERE id_servicio_cliente = ?";
                $query = $c->prepare($sql);
                $query->bindParam(1, $id_reserva);
                if ($query->execute()) {
                    $res = 1;
                } else {
                    $res = 0;
                }
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
}
