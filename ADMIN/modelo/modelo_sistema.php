<?php
require_once 'modelo_conexion.php';
class modelo_sistema extends modelo_conexion
{
    function eliminar_ofertas_pasadas()
    {
        date_default_timezone_set('America/Guayaquil');
        $fecha = date("Y-m-d");

        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * FROM ofertas where DATE(fecha_fin) < ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $fecha);
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_BOTH);
            if (!empty($result)) {

                foreach ($result as $respuesta) {
                    $sql_a = "DELETE FROM ofertas where id_ofertas = ?";
                    $query_a = $c->prepare($sql_a);
                    $query_a->bindParam(1, $respuesta[0]);
                    if ($query_a->execute()) {

                        $sql_b = "UPDATE producto SET producto_destacar = 0 WHERE id_producto = ?";
                        $query_b = $c->prepare($sql_b);
                        $query_b->bindParam(1, $respuesta[1]);
                        if ($query_b->execute()) {
                            $res = 1; // ok
                        } else {
                            $res = 0; // error en la inserccion
                        }
                    } else {
                        $res = 0;
                    }
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

    function total_cliente()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            COUNT(*) 
            FROM
            cliente 
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

    function total_empleaodos()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            COUNT(*) 
            FROM
            empleado 
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

    function total_productos()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            COUNT(*) 
            FROM
            producto 
            WHERE
            _eliminado = 1";
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

    function stock_servicios()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            COUNT(*) 
            FROM
            servicio 
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

    ////
    function productos_mas_comprados()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
                COUNT( detalle_venta.producto_id ) AS numero,
                CONCAT_WS(' ', producto.producto_nombre, tipo_producto.tipo_producto, marca.marca ) AS producto 
                FROM
                    detalle_venta
                    INNER JOIN producto ON detalle_venta.producto_id = producto.id_producto
                    INNER JOIN tipo_producto ON producto.tipo_producto_id = tipo_producto.id_tipo_producto
                    INNER JOIN marca ON producto.marca_producto_id = marca.id_marca 
                GROUP BY
                    detalle_venta.producto_id 
                ORDER BY
                detalle_venta.producto_id DESC
                LIMIT 10";
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

    ////
    function servicios_mas_comprados()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            COUNT( detalle_servicios_cliente.id_servicio ) AS numero,
            servicio.servicio 
            FROM
                detalle_servicios_cliente
                INNER JOIN servicio ON detalle_servicios_cliente.id_servicio = servicio.id_servicio 
            GROUP BY
                detalle_servicios_cliente.id_servicio 
            ORDER BY
            detalle_servicios_cliente.id_servicio DESC
            LIMIT 10";
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


    //////////////////////////
    function realizar_respaldo($id, $pass, $fecha_archivo)
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * FROM usuario where id_usuario = ? AND pass = ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $id);
            $query->bindParam(2, $pass);
            $query->execute();
            $data = $query->fetch(PDO::FETCH_ASSOC);

            if (empty($data)) {
                return 10;
                exit();
            } else {
                date_default_timezone_set('America/Guayaquil');
                $fecha_hora_db = date("Y:m:d H:i:s");

                $dato = "{$fecha_archivo}_{$this->getdb()}";
                $ruta = "img/backup/" . $dato . ".zip";

                $sql_a = "INSERT INTO respaldo (id_usuario, fecha_hora, ruta) VALUES (?,?,?)";
                $querya = $c->prepare($sql_a);
                $querya->bindParam(1, $id);
                $querya->bindParam(2, $fecha_hora_db);
                $querya->bindParam(3, $ruta);

                if ($querya->execute()) {
                    /// eto me devleve los datos de la base de datos
                    $db_pass = $this->getContrasena();
                    $db_host = $this->gethost();
                    $db_name = $this->getdb();
                    $db_user = $this->getUsuario();

                    return array("pass" => $db_pass, "host" => $db_host, "name" => $db_name, "user" => $db_user);
                    exit();
                } else {
                    return 20;
                    exit();
                }
            }
            //cerramos la conexion
            // modelo_conexion::cerrar_conexion();
        } catch (Exception $e) {
            // modelo_conexion::cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function listar_respaldo()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            respaldo.id_respaldo,
            CONCAT_WS( ' ',  usuario.nombres,
            usuario.apellidos) as usuario,          
            respaldo.fecha_hora,
            respaldo.ruta 
            FROM
            usuario
            INNER JOIN respaldo ON usuario.id_usuario = respaldo.id_usuario";
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

    function listar_auditoria_ventas()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            auditoria_venta.id_audi_venta,
            CONCAT_WS( ' ', usuario.nombres, usuario.apellidos ) AS usuario,
            auditoria_venta.operacion,
            auditoria_venta.fecha_hora,
            auditoria_venta.app,
            auditoria_venta.ip,
            auditoria_venta.n_venta,
            auditoria_venta.cantidad,
            auditoria_venta.total 
            FROM
            auditoria_venta
            INNER JOIN usuario ON auditoria_venta.id_usuario = usuario.id_usuario";
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

    function listar_auditoria_compras()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            auditoria_compra.id_aud_compra,
            CONCAT_WS( ' ', usuario.nombres, usuario.apellidos ) AS usuario,
            auditoria_compra.operacion,
            auditoria_compra.fecha_hora,
            auditoria_compra.app,
            auditoria_compra.ip,
            auditoria_compra.n_venta,
            auditoria_compra.cantidad,
            auditoria_compra.total 
            FROM
            auditoria_compra
            INNER JOIN usuario ON auditoria_compra.id_usuario = usuario.id_usuario";
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

    function listar_auditoria_servicios()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            auditoria_servicios.id_audi_servicio,
            CONCAT_WS( ' ', usuario.nombres, usuario.apellidos ) AS usuario,
            auditoria_servicios.app,
            auditoria_servicios.ip,
            auditoria_servicios.n_venta,
            auditoria_servicios.total,
            auditoria_servicios.operacion,
            auditoria_servicios.fecha_hora 
        FROM
            auditoria_servicios
            INNER JOIN usuario ON auditoria_servicios.id_usuario = usuario.id_usuario";
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



