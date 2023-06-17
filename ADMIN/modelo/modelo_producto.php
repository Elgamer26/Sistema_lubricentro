<?php
require_once 'modelo_conexion.php';
class modelo_producto extends modelo_conexion
{

    function registrar_tipo($tipo_producto)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_a = "SELECT * FROM tipo_producto where tipo_producto = ?";
            $query_a = $c->prepare($sql_a);
            $query_a->bindParam(1, $tipo_producto);
            $query_a->execute();
            $data_a = $query_a->fetch(PDO::FETCH_ASSOC);

            if (empty($data_a)) {
                $sql_B = "INSERT INTO tipo_producto (tipo_producto) VALUES (?)";
                $query_b = $c->prepare($sql_B);
                $query_b->bindParam(1, $tipo_producto);
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

    function listar_tipo_()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            *
            FROM
            tipo_producto
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
            $sql_B = "UPDATE tipo_producto SET estado = ? WHERE id_tipo_producto = ?";
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

    function editar_tipo__($id, $tipo_producto)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_a = "SELECT * FROM tipo_producto where tipo_producto = ? AND id_tipo_producto != ?";
            $query_a = $c->prepare($sql_a);
            $query_a->bindParam(1, $tipo_producto);
            $query_a->bindParam(2, $id);
            $query_a->execute();
            $data_a = $query_a->fetch(PDO::FETCH_ASSOC);

            if (empty($data_a)) {
                $sql_B = "UPDATE tipo_producto SET tipo_producto = ? WHERE id_tipo_producto = ?";
                $query_b = $c->prepare($sql_B);
                $query_b->bindParam(1, $tipo_producto);
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

    function registrar_marca($marca_pro)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_a = "SELECT * FROM marca where marca = ?";
            $query_a = $c->prepare($sql_a);
            $query_a->bindParam(1, $marca_pro);
            $query_a->execute();
            $data_a = $query_a->fetch(PDO::FETCH_ASSOC);

            if (empty($data_a)) {
                $sql_B = "INSERT INTO marca (marca) VALUES (?)";
                $query_b = $c->prepare($sql_B);
                $query_b->bindParam(1, $marca_pro);
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

    function listar_marcas()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            *
            FROM
            marca
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

    function estado_marca($id, $dato)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_B = "UPDATE marca SET estado = ? WHERE id_marca = ?";
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

    function editar__marca($id, $marca_edit)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_a = "SELECT * FROM marca where marca = ? AND id_marca != ?";
            $query_a = $c->prepare($sql_a);
            $query_a->bindParam(1, $marca_edit);
            $query_a->bindParam(2, $id);
            $query_a->execute();
            $data_a = $query_a->fetch(PDO::FETCH_ASSOC);

            if (empty($data_a)) {
                $sql_B = "UPDATE marca SET marca = ? WHERE id_marca = ?";
                $query_b = $c->prepare($sql_B);
                $query_b->bindParam(1, $marca_edit);
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

    ///////////////////////
    function listar_tipo_producto()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * FROM tipo_producto WHERE estado = 1";
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

    function listar_marca_producto()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * FROM marca WHERE estado = 1";
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

    function registrar_producto($codigo, $nombre, $tipo, $marca, $detalle, $precio, $ruta, $equiva, $especifi)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_a = "SELECT * FROM producto where poducto_codigo = ?";
            $query_a = $c->prepare($sql_a);
            $query_a->bindParam(1, $codigo);
            $query_a->execute();
            $data_a = $query_a->fetch(PDO::FETCH_ASSOC);
            if (empty($data_a)) {
                $sql_x = "SELECT * FROM producto where producto_nombre = ?";
                $query_x = $c->prepare($sql_x);
                $query_x->bindParam(1, $nombre);
                $query_x->execute();
                $data_x = $query_x->fetch(PDO::FETCH_ASSOC);
                if (empty($data_x)) {
                    $sql_b = "SELECT * FROM producto where tipo_producto_id = ? AND marca_producto_id = ? AND producto_nombre = ?";
                    $query_b = $c->prepare($sql_b);
                    $query_b->bindParam(1, $tipo);
                    $query_b->bindParam(2, $marca);
                    $query_b->bindParam(3, $nombre);
                    $query_b->execute();
                    $data_b = $query_b->fetch(PDO::FETCH_ASSOC);
                    if (empty($data_b)) {
                        $sql_c = "INSERT INTO producto (poducto_codigo, producto_nombre, tipo_producto_id, marca_producto_id, producto_detalle, producto_precio_venta, producto_foto, especificacion, equivalente, estado) 
                        VALUES (?,?,?,?,?,?,?,?,?,'activo')";
                        $query_c = $c->prepare($sql_c);
                        $query_c->bindParam(1, $codigo);
                        $query_c->bindParam(2, $nombre);
                        $query_c->bindParam(3, $tipo);
                        $query_c->bindParam(4, $marca);
                        $query_c->bindParam(5, $detalle);
                        $query_c->bindParam(6, $precio);
                        $query_c->bindParam(7, $ruta);
                        $query_c->bindParam(8, $especifi);
                        $query_c->bindParam(9, $equiva);
                        if ($query_c->execute()) {
                            $res = 1; // registro exitoso
                        } else {
                            $res = 0; // error en la inserccion
                        }
                    } else {
                        $res = 3; // ya existe el producto con el tipo, marca y nombre registrado Y CATEORIA
                    }
                } else {
                    $res = 4; // el nombre de producto ya existe
                }
            } else {
                $res = 2; // ya existe el codigo del producto
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

    function listar_producto()
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
            producto.stock,
            producto.especificacion,
            producto.equivalente
            FROM
            marca
            INNER JOIN producto ON marca.id_marca = producto.marca_producto_id
            INNER JOIN tipo_producto ON producto.tipo_producto_id = tipo_producto.id_tipo_producto";
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

    function editar_foto_producto($id, $ruta)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_c = "UPDATE producto SET  producto_foto = ? WHERE id_producto = ?";
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

    function cambiar_estado_producto($id, $estado)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_c = "UPDATE producto SET  _eliminado = ? WHERE id_producto = ?";
            $query_c = $c->prepare($sql_c);
            $query_c->bindParam(1, $estado);
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

    function editar_producto($id, $codigo, $nombre, $tipo, $marca, $detalle, $precio, $especifi, $equiva)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_a = "SELECT * FROM producto where poducto_codigo = ? AND id_producto != ?";
            $query_a = $c->prepare($sql_a);
            $query_a->bindParam(1, $codigo);
            $query_a->bindParam(2, $id);
            $query_a->execute();
            $data_a = $query_a->fetch(PDO::FETCH_ASSOC);
            if (empty($data_a)) {
                $sql_x = "SELECT * FROM producto where producto_nombre = ? AND id_producto != ?";
                $query_x = $c->prepare($sql_x);
                $query_x->bindParam(1, $nombre);
                $query_x->bindParam(2, $id);
                $query_x->execute();
                $data_x = $query_x->fetch(PDO::FETCH_ASSOC);
                if (empty($data_x)) {
                    $sql_b = "SELECT * FROM producto where tipo_producto_id = ? AND marca_producto_id = ? AND producto_nombre = ? AND id_producto != ?";
                    $query_b = $c->prepare($sql_b);
                    $query_b->bindParam(1, $tipo);
                    $query_b->bindParam(2, $marca);
                    $query_b->bindParam(3, $nombre);
                    $query_b->bindParam(4, $id);
                    $query_b->execute();
                    $data_b = $query_b->fetch(PDO::FETCH_ASSOC);
                    if (empty($data_b)) {
                        $sql_c = "UPDATE producto SET poducto_codigo = ?, producto_nombre = ?, tipo_producto_id = ?, marca_producto_id = ?, producto_detalle = ?, producto_precio_venta = ?, especificacion = ?, equivalente = ? WHERE id_producto = ?";
                        $query_c = $c->prepare($sql_c);
                        $query_c->bindParam(1, $codigo);
                        $query_c->bindParam(2, $nombre);
                        $query_c->bindParam(3, $tipo);
                        $query_c->bindParam(4, $marca);
                        $query_c->bindParam(5, $detalle);
                        $query_c->bindParam(6, $precio);

                        $query_c->bindParam(7, $especifi);
                        $query_c->bindParam(8, $equiva);

                        $query_c->bindParam(9, $id);
                        if ($query_c->execute()) {
                            $res = 1; // registro exitoso
                        } else {
                            $res = 0; // error en la inserccion
                        }
                    } else {
                        $res = 3; // ya existe el producto con el tipo, marca y nombre registrado
                    }
                } else {
                    $res = 4; // el nombre de producto ya existe
                }
            } else {
                $res = 2; // ya existe el codigo del producto
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
    function crear_proveedor($razon, $numero, $direccion, $provincia, $ciudad, $numero_telefono, $correo, $actividad, $nombre_enca, $sexo, $telefono_encargado)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_a = "SELECT * FROM proveedor where ruc = ?";
            $query_a = $c->prepare($sql_a);
            $query_a->bindParam(1, $numero);
            $query_a->execute();
            $data_a = $query_a->fetch(PDO::FETCH_ASSOC);
            if (empty($data_a)) {
                $sql_r = "SELECT * FROM proveedor where razon_social = ?";
                $query_r = $c->prepare($sql_r);
                $query_r->bindParam(1, $razon);
                $query_r->execute();
                $data_r = $query_r->fetch(PDO::FETCH_ASSOC);
                if (empty($data_r)) {
                    $sql_b = "SELECT * FROM proveedor where proveedor_correo = ?";
                    $query_b = $c->prepare($sql_b);
                    $query_b->bindParam(1, $correo);
                    $query_b->execute();
                    $data_b = $query_b->fetch(PDO::FETCH_ASSOC);
                    if (empty($data_b)) {
                        $sql_c = "INSERT INTO proveedor (razon_social, ruc, proveedor_direccion, provincia_id, ciudad_id, proveedor_telefono, proveedor_correo, proveedor_actividad, encargado, encargado_sexo, encargado_telefono) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
                        $query_c = $c->prepare($sql_c);
                        $query_c->bindParam(1, $razon);
                        $query_c->bindParam(2, $numero);
                        $query_c->bindParam(3, $direccion);
                        $query_c->bindParam(4, $provincia);
                        $query_c->bindParam(5, $ciudad);
                        $query_c->bindParam(6, $numero_telefono);
                        $query_c->bindParam(7, $correo);
                        $query_c->bindParam(8, $actividad);
                        $query_c->bindParam(9, $nombre_enca);
                        $query_c->bindParam(10, $sexo);
                        $query_c->bindParam(11, $telefono_encargado);
                        if ($query_c->execute()) {
                            $res = 1;
                        } else {
                            $res = 0;
                        }
                    } else {
                        $res = 3; // el correo ya existe
                    }
                } else {
                    $res = 4; // razon social ya existe
                }
            } else {
                $res = 2; // el numero de documento ya existe
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

    function listar_proveedor()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            proveedor.proveedor_id,
            proveedor.razon_social,
            proveedor.ruc,
            proveedor.proveedor_direccion,
            proveedor.provincia_id,
            proveedor.ciudad_id,
            proveedor.proveedor_telefono,
            proveedor.proveedor_correo,
            proveedor.proveedor_actividad,
            proveedor.encargado,
            proveedor.encargado_sexo,
            proveedor.encargado_telefono,
            proveedor.estado 
            FROM
            proveedor";
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

    function cambiar_etado_proveedor($id, $dato)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_B = "UPDATE proveedor SET estado = ? WHERE proveedor_id = ?";
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

    function editar_datos_proveedor($id, $razon, $numero, $direccion, $provincia, $ciudad, $numero_telefono, $correo, $actividad, $nombre_enca, $sexo, $telefono_encargado)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_a = "SELECT * FROM proveedor where ruc = ? AND proveedor_id != ?";
            $query_a = $c->prepare($sql_a);
            $query_a->bindParam(1, $numero);
            $query_a->bindParam(2, $id);

            $query_a->execute();
            $data_a = $query_a->fetch(PDO::FETCH_ASSOC);
            if (empty($data_a)) {
                $sql_r = "SELECT * FROM proveedor where razon_social = ? AND proveedor_id != ?";
                $query_r = $c->prepare($sql_r);
                $query_r->bindParam(1, $razon);
                $query_r->bindParam(2, $id);

                $query_r->execute();
                $data_r = $query_r->fetch(PDO::FETCH_ASSOC);
                if (empty($data_r)) {
                    $sql_b = "SELECT * FROM proveedor where proveedor_correo = ? AND proveedor_id != ?";
                    $query_b = $c->prepare($sql_b);
                    $query_b->bindParam(1, $correo);
                    $query_b->bindParam(2, $id);

                    $query_b->execute();
                    $data_b = $query_b->fetch(PDO::FETCH_ASSOC);
                    if (empty($data_b)) {
                        $sql_c = "UPDATE proveedor SET razon_social = ?, ruc = ?, proveedor_direccion = ?, provincia_id = ?, ciudad_id = ?, proveedor_telefono = ?, proveedor_correo = ?, proveedor_actividad = ?, encargado = ?, encargado_sexo = ?, encargado_telefono = ? WHERE proveedor_id = ?";
                        $query_c = $c->prepare($sql_c);
                        $query_c->bindParam(1, $razon);
                        $query_c->bindParam(2, $numero);
                        $query_c->bindParam(3, $direccion);
                        $query_c->bindParam(4, $provincia);
                        $query_c->bindParam(5, $ciudad);
                        $query_c->bindParam(6, $numero_telefono);
                        $query_c->bindParam(7, $correo);
                        $query_c->bindParam(8, $actividad);
                        $query_c->bindParam(9, $nombre_enca);
                        $query_c->bindParam(10, $sexo);
                        $query_c->bindParam(11, $telefono_encargado);
                        $query_c->bindParam(12, $id);
                        if ($query_c->execute()) {
                            $res = 1;
                        } else {
                            $res = 0;
                        }
                    } else {
                        $res = 3; // el correo ya existe
                    }
                } else {
                    $res = 4; // razon social ya existe
                }
            } else {
                $res = 2; // el numero de documento ya existe
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

    function listar_proveedor_compra()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            proveedor.proveedor_id,
            proveedor.razon_social,
            proveedor.ruc,
            proveedor.proveedor_direccion,
            proveedor.provincia_id,
            proveedor.ciudad_id,
            proveedor.proveedor_telefono,
            proveedor.proveedor_correo,
            proveedor.proveedor_actividad,
            proveedor.encargado,
            proveedor.encargado_sexo,
            proveedor.encargado_telefono,
            proveedor.estado 
            FROM
            proveedor WHERE proveedor.estado = 1";
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

    function listado_productos_agg()
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
            INNER JOIN tipo_producto ON producto.tipo_producto_id = tipo_producto.id_tipo_producto WHERE producto._eliminado = 1";
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

    /////////////////COMPRAS
    function registrar_ingreso($id, $id_provee, $inpuesto, $tipo_compro, $serie_compro, $numero_compro, $txt_totalneto, $txt_impuesto, $txt_a_pagar, $count)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_c = "INSERT INTO ingreso (usuario_id, proveedor_id, ingreso_porcentaje, ingreso_ticomprobante, ingreso_seriecomprobante, ingreso_numcomrpobante,  ingreso_total, ingreso_impusto, ingreso_impuestototal, ingreso_cantidad, ingreso_estado, ingreso_fecha) 
            VALUES (?,?,?,?,?,?,?,?,?,?,'INGRESADO',CURDATE())";
            $query_c = $c->prepare($sql_c);
            $query_c->bindParam(1, $id);
            $query_c->bindParam(2, $id_provee);
            $query_c->bindParam(3, $inpuesto);
            $query_c->bindParam(4, $tipo_compro);
            $query_c->bindParam(5, $serie_compro);
            $query_c->bindParam(6, $numero_compro);
            $query_c->bindParam(7, $txt_totalneto);
            $query_c->bindParam(8, $txt_impuesto);
            $query_c->bindParam(9, $txt_a_pagar);
            $query_c->bindParam(10, $count);
            if ($query_c->execute()) {
                // $res = 1; // registro exitoso
                $res = $c->lastInsertId(); // me devulev el ultim ID insertado 
            } else {
                $res = 0; // error en la inserccion
            }

            $ip = $_SERVER['REMOTE_ADDR'];
            $app = $_SERVER['HTTP_USER_AGENT'];

            date_default_timezone_set('America/Guayaquil');
            $fecha_hora = date("Y-m-d H:m:s");
            $opreacion = "Inserto compra";

            $sql_a = "INSERT INTO auditoria_compra (id_usuario, fecha_hora, app, ip, n_venta, cantidad, total, operacion) 
            VALUES (?,?,?,?,?,?,?,?)";
            $query_a = $c->prepare($sql_a);
            $query_a->bindParam(1, $id);
            $query_a->bindParam(2, $fecha_hora);
            $query_a->bindParam(3, $app);
            $query_a->bindParam(4, $ip);
            $query_a->bindParam(5, $numero_compro);
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

    function registrar_detalle_ingreso($id, $arraglo_idproducto, $arraglo_cantidad, $arraglo_unidad, $arraglo_precio, $arraglo_descuento, $arraglo_subtotal)
    {
        try {
            $res = "";
            $stock = 0;
            $stock_st = 0;
            $c = modelo_conexion::conexionPDO();
            $sql_c = "INSERT INTO detalle_ingreso (ingreso_id, producto_id, cantidad, unidad, precio, descuento, subtotal,  detalle_estado) 
                        VALUES (?,?,?,?,?,?,?,'INGRESADO')";
            $query_c = $c->prepare($sql_c);
            $query_c->bindParam(1, $id);
            $query_c->bindParam(2, $arraglo_idproducto);
            $query_c->bindParam(3, $arraglo_cantidad);
            $query_c->bindParam(4, $arraglo_unidad);
            $query_c->bindParam(5, $arraglo_precio);
            $query_c->bindParam(6, $arraglo_descuento);
            $query_c->bindParam(7, $arraglo_subtotal);
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

                $stock = $stock + $arraglo_unidad;

                $sql_m = "UPDATE producto SET stock = ? where id_producto = ?";
                $query_m = $c->prepare($sql_m);
                $query_m->bindParam(1, $stock);
                $query_m->bindParam(2, $arraglo_idproducto);
                if ($query_m->execute()) {

                    $sql_st = "SELECT stock FROM producto where id_producto = ?";
                    $query_st = $c->prepare($sql_st);
                    $query_st->bindParam(1, $arraglo_idproducto);
                    $query_st->execute();
                    $data_st = $query_st->fetch(PDO::FETCH_BOTH);
                    $arreglo_st = array();
                    foreach ($data_st as $respuesta_st) {
                        $arreglo_st[] = $respuesta_st;
                    }

                    $stock_st = $arreglo_st[0];

                    if ($stock_st > 0) {

                        $sql_edit = "UPDATE producto SET estado = 'activo' where id_producto = ?";
                        $query_edit = $c->prepare($sql_edit);
                        $query_edit->bindParam(1, $arraglo_idproducto);
                        if ($query_edit->execute()) {
                            $res = 1; // registro del detalle es exitoso
                        } else {
                            $res = 0; // registro error
                        }
                    }
                } else {
                    $res = 2; // error de update
                }
            } else {
                $res = 0; // error en la inserccion detalle
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

    function listar_ingreso()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            ingreso.ingreso_id,
            CONCAT_WS( ' ', usuario.nombres, usuario.apellidos ) AS usuario,
            proveedor.razon_social,
            ingreso.ingreso_porcentaje,
            ingreso.ingreso_ticomprobante,
            ingreso.ingreso_seriecomprobante,
            ingreso.ingreso_numcomrpobante,
            ingreso.ingreso_total,
            ingreso.ingreso_impusto,
            ingreso.ingreso_impuestototal,
            ingreso.ingreso_cantidad,
            ingreso.ingreso_estado,
            ingreso.ingreso_fecha 
            FROM
            usuario
            INNER JOIN ingreso ON usuario.id_usuario = ingreso.usuario_id
            INNER JOIN proveedor ON ingreso.proveedor_id = proveedor.proveedor_id";
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

    function listar_detalle_ingreso($id)
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            detalle_ingreso.detalle_ingreso_id,
            detalle_ingreso.ingreso_id,
            detalle_ingreso.producto_id,
            producto.producto_nombre,
            tipo_producto.tipo_producto,
            marca.marca,
            detalle_ingreso.cantidad,
            detalle_ingreso.precio,
            detalle_ingreso.descuento,
            detalle_ingreso.subtotal,
            detalle_ingreso.detalle_estado,
            detalle_ingreso.unidad
            FROM
                detalle_ingreso
                INNER JOIN producto ON detalle_ingreso.producto_id = producto.id_producto
                INNER JOIN tipo_producto ON producto.tipo_producto_id = tipo_producto.id_tipo_producto
                INNER JOIN marca ON producto.marca_producto_id = marca.id_marca 
            WHERE
            detalle_ingreso.ingreso_id = ?";
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

    function anular_ingreso($id, $id_usu)
    {
        try {
            $res = "";
            $stock = 0;
            $c = modelo_conexion::conexionPDO();
            $sql_c = "SELECT * FROM detalle_ingreso WHERE ingreso_id = ?";
            $query_c = $c->prepare($sql_c);
            $query_c->bindParam(1, $id);
            $query_c->execute();
            $data = $query_c->fetchAll(PDO::FETCH_BOTH);
            foreach ($data as $respuesta) {

                $sql_a = "SELECT * FROM producto WHERE id_producto = ?";
                $query_a = $c->prepare($sql_a);
                $query_a->bindParam(1, $respuesta[2]);
                $query_a->execute();
                $dato = $query_a->fetchAll(PDO::FETCH_BOTH);
                foreach ($dato as $respuesto) {

                    $stock =  $respuesto[11] - $respuesta[3];
                    // $stock =  $respuesto[7] - $respuesta[3];
                    $sql_p = "UPDATE producto SET stock = ? where id_producto = ?";
                    $query_p = $c->prepare($sql_p);
                    $query_p->bindParam(1, $stock);
                    $query_p->bindParam(2, $respuesta[2]);

                    if ($query_p->execute()) {
                        $sql_d = "UPDATE detalle_ingreso SET detalle_estado = 'ANULADO' where ingreso_id = ?";
                        $query_d = $c->prepare($sql_d);
                        $query_d->bindParam(1, $id);
                        $query_d->execute();
                    }
                }
            }

            $sql_F = "UPDATE ingreso SET ingreso_estado = 'ANULADO' WHERE ingreso_id = ?";
            $query_F = $c->prepare($sql_F);
            $query_F->bindParam(1, $id);
            if ($query_F->execute()) {
                $res = 1;
            } else {
                $res = 0;
            }

            $sql_au = "SELECT * FROM ingreso WHERE ingreso_id = ?";
            $query_au = $c->prepare($sql_au);
            $query_au->bindParam(1, $id);
            $query_au->execute();
            $data_au = $query_au->fetchAll(PDO::FETCH_BOTH);
            foreach ($data_au as $respuesta_au) {

                $ip = $_SERVER['REMOTE_ADDR'];
                $app = $_SERVER['HTTP_USER_AGENT'];

                date_default_timezone_set('America/Guayaquil');
                $fecha_hora = date("Y-m-d H:m:s");
                $opreacion = "Anulo compra";

                $sql_a = "INSERT INTO auditoria_compra (id_usuario, fecha_hora, app, ip, n_venta, cantidad, total, operacion) 
                VALUES (?,?,?,?,?,?,?,?)";
                $query_a = $c->prepare($sql_a);
                $query_a->bindParam(1, $id_usu);
                $query_a->bindParam(2, $fecha_hora);
                $query_a->bindParam(3, $app);
                $query_a->bindParam(4, $ip);
                $query_a->bindParam(5, $respuesta_au[6]);
                $query_a->bindParam(6, $respuesta_au[10]);
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

    ///////////////////////
    function listar_productos_ofertas()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
                producto.id_producto,
                producto.poducto_codigo,
                producto.producto_nombre,
                marca.marca,
                tipo_producto.tipo_producto,
                producto._eliminado,
                producto.estado,
                producto.stock 
                FROM
                    marca
                    INNER JOIN producto ON marca.id_marca = producto.marca_producto_id
                    INNER JOIN tipo_producto ON producto.tipo_producto_id = tipo_producto.id_tipo_producto 
                WHERE
                    producto._eliminado = 1 
                    AND producto.producto_destacar = 0
                    AND producto.stock IS NOT NULL";
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

    function registrar_ofertass($producto_id, $fecha_inic, $fecha_fin, $nombre_oferta, $procentaje, $tipo_descue)
    {
        try {
            $res = "";
            $id = "";
            $c = modelo_conexion::conexionPDO();
            $sql_c = "INSERT INTO ofertas (producto_id, fecha_inic, fecha_fin, nombre_oferta, procentaje, tipo_descue) 
                VALUES (?,?,?,?,?,?)";
            $query_c = $c->prepare($sql_c);
            $query_c->bindParam(1, $producto_id);
            $query_c->bindParam(2, $fecha_inic);
            $query_c->bindParam(3, $fecha_fin);
            $query_c->bindParam(4, $nombre_oferta);
            $query_c->bindParam(5, $procentaje);
            $query_c->bindParam(6, $tipo_descue);
            if ($query_c->execute()) {
                $id = $c->lastInsertId();
                $sql_a = "UPDATE producto SET producto_destacar = 1 WHERE id_producto = ?";
                $query_a = $c->prepare($sql_a);
                $query_a->bindParam(1, $producto_id);
                if ($query_a->execute()) {
                    $res = $id;
                } else {
                    $res = 0; // error en la inserccion
                }
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

    function paguinar()
    {

        try {
            $paginaactual = htmlspecialchars($_POST["partida"], ENT_QUOTES, 'UTF-8');
            $c = modelo_conexion::conexionPDO();
            if (!empty($_POST['valor'])) {
                $datos = $_POST['valor'];

                $sql = "SELECT
                COUNT(*) 
                FROM
                    ofertas
                    INNER JOIN producto ON ofertas.producto_id = producto.id_producto
                    INNER JOIN tipo_producto ON producto.tipo_producto_id = tipo_producto.id_tipo_producto
                    INNER JOIN marca ON producto.marca_producto_id = marca.id_marca 
                WHERE
                producto._eliminado = 1 
                AND producto.poducto_codigo LIKE '%" . $datos . "%' 
                OR producto.producto_nombre LIKE '%" . $datos . "%'";
            } else {
                $sql = "SELECT
                COUNT(*) 
                FROM
                    ofertas
                    INNER JOIN producto ON ofertas.producto_id = producto.id_producto
                    INNER JOIN tipo_producto ON producto.tipo_producto_id = tipo_producto.id_tipo_producto
                    INNER JOIN marca ON producto.marca_producto_id = marca.id_marca 
                WHERE
                    producto._eliminado = 1";
            }
            $query = $c->prepare($sql);
            $query->execute();
            $data = $query->fetch(PDO::FETCH_BOTH);
            $arreglo = array();
            //
            foreach ($data as $respuesta) {
                $arreglo[] = $respuesta;
            }
            //
            $numlotes = 8;
            $nropaguinas = ceil($arreglo[0] / $numlotes);
            $lista = "";
            $tabla = "";
            //
            if ($paginaactual > 1) {
                $lista = $lista . '<li><a href="javascript:pagination(' . ($paginaactual - 1) . ');">Anterior</a></li>';
            }
            //
            for ($i = 1; $i <= $nropaguinas; $i++) {
                if ($i == $paginaactual) {
                    $lista = $lista . '<li class="active"><a href="javascript:pagination(' . ($i) . ');">' . $i . '</a></li>';
                } else {
                    $lista = $lista . '<li><a href="javascript:pagination(' . ($i) . ');">' . $i . '</a></li>';
                }
            }
            //
            if ($paginaactual < $nropaguinas) {
                $lista = $lista . '<li><a href="javascript:pagination(' . ($paginaactual + 1) . ');">Siguiente</a></li>';
            }
            //
            if ($paginaactual <= 1) {
                $limit = 0;
            } else {
                $limit = $numlotes * ($paginaactual - 1);
            }
            //
            if (!empty($_POST['valor'])) {
                $datos = $_POST['valor'];
                $sql_p = "SELECT
                ofertas.id_ofertas,
                producto.poducto_codigo,
                producto.producto_nombre,
                tipo_producto.tipo_producto,
                marca.marca,
                producto.producto_detalle,
                producto.producto_precio_venta,
                producto.producto_foto,
                producto.estado,
                producto.producto_destacar,
                producto._eliminado,
                producto.stock,
                ofertas.fecha_inic,
                ofertas.fecha_fin,
                ofertas.nombre_oferta,
                ofertas.procentaje,
                ofertas.tipo_descue 
            FROM
                ofertas
                INNER JOIN producto ON ofertas.producto_id = producto.id_producto
                INNER JOIN tipo_producto ON producto.tipo_producto_id = tipo_producto.id_tipo_producto
                INNER JOIN marca ON producto.marca_producto_id = marca.id_marca 
            WHERE
                producto._eliminado = 1 
                AND producto.poducto_codigo LIKE '%" . $datos . "%' 
                OR producto.producto_nombre LIKE '%" . $datos . "%' 
                LIMIT $limit,$numlotes";
            } else {
                $sql_p = "SELECT
                ofertas.id_ofertas,
                producto.poducto_codigo,
                producto.producto_nombre,
                tipo_producto.tipo_producto,
                marca.marca,
                producto.producto_detalle,
                producto.producto_precio_venta,
                producto.producto_foto,
                producto.estado,
                producto.producto_destacar,
                producto._eliminado,
                producto.stock,
                ofertas.fecha_inic,
                ofertas.fecha_fin,
                ofertas.nombre_oferta,
                ofertas.procentaje,
                ofertas.tipo_descue 
            FROM
                ofertas
                INNER JOIN producto ON ofertas.producto_id = producto.id_producto
                INNER JOIN tipo_producto ON producto.tipo_producto_id = tipo_producto.id_tipo_producto
                INNER JOIN marca ON producto.marca_producto_id = marca.id_marca 
            WHERE
                producto._eliminado = 1 LIMIT $limit,$numlotes";
            }
            //
            $query_p = $c->prepare($sql_p);
            $query_p->execute();
            $result = $query_p->fetchAll(PDO::FETCH_BOTH);
            $bgd = "";
            $count = 0;
            //
            foreach ($result as $respuesta) {

                if ($respuesta[8] == "activo") {
                    $bgd = "green";
                } else if ($respuesta[11] == "agotado") {
                    $bgd = "orange";
                } else {
                    $bgd = "red";
                }

                $count++;
                $tabla = $tabla . '<div class="moverabajo col-md-3 border text-center mt-3 p-4 bg-light">
                                     <div class="card m-2 shadow" style="width: 23rem; padding: 12px;
                                     background: #b9f5b8;
                                     border-radius: 12px;">
                                         <img loading="lazy" src=' . $respuesta[7] . ' class="img-circle" height="90px" width="90px" alt="">
                                         <div class="card-body">
                                             <h4 class="card-title text-center"><b>Codigo: </b> ' . $respuesta[1] . '</h4>
                                             <h5 class="card-title"><b> Nombre oferta: </b>' . $respuesta[14] . '</h5>
                                             <h5 class="card-title"><b> Nombre producto: </b>' . $respuesta[2] . '</h5>
                                             <h5 class="card-title"><b>Tipo Prod.: </b> ' . $respuesta[3] . '</kbd></h5>
                                             <h5 class="card-title"><b>Marca Prod.: </b>' . $respuesta[4] . '</kbd></h5>
                                             <h5 class="card-title"><b>Precio venta: </b>$/. ' . $respuesta[6] . '</h5>                                                                                        
                                             <h5 class="card-title"><b> Esatdo: </b><kbd class="bg-' . $bgd . '">' . $respuesta[8] . '</kbd> 
                                             - <b>Stock: </b> ' . $respuesta[11] . '</kbd> </h5>
                                            <h5 class="card-title"><b>Fecha fin oferta: </b><kbd class="bg-orange">' . $respuesta[13] . '</kbd></h5>
                                            <h5 class="card-title"><b>Descuento: </b>' . $respuesta[15] . '%</h5> ';

                $tabla = $tabla . '<a title="Enviar correos" onclick="enviar_correo(' . $respuesta[0] . ');" class="btn btn-success"><i class="fa fa-envelope"></i></a> - <a title="Editar ofertas" onclick="editar_oferta(' . $respuesta[0] . ');" class="btn btn-primary"><i class="fa fa-edit"></i></a> - <a onclick="elimnar(' . $respuesta[0] . ');" title="Eliminar oferta" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                             
                                         </div>
                                     </div>
                                 </div>';
            }
            //
            $array = array(0 => $tabla, 1 => $lista);
            return $array;
            //cerramos la conexion
            modelo_conexion::cerrar_conexion();
        } catch (Exception $e) {
            modelo_conexion::cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function eliminar_ofertas($id)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();

            $sql_c = "SELECT producto_id FROM ofertas WHERE id_ofertas = ?";
            $query_c = $c->prepare($sql_c);
            $query_c->bindParam(1, $id);
            $query_c->execute();
            $data = $query_c->fetch(PDO::FETCH_BOTH);
            foreach ($data as $respuesta) {

                $sql_a = "DELETE FROM ofertas WHERE id_ofertas = ?";
                $query_a = $c->prepare($sql_a);
                $query_a->bindParam(1, $id);
                if ($query_a->execute()) {

                    $sql_b = "UPDATE producto SET producto_destacar = 0 WHERE id_producto = ?";
                    $query_b = $c->prepare($sql_b);
                    $query_b->bindParam(1, $respuesta);
                    if ($query_b->execute()) {
                        $res = 1; // ok
                    } else {
                        $res = 0; // error en la inserccion
                    }
                } else {
                    $res = 0; // error en la inserccion
                }
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

    function traer_datos_editar($id)
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
            ofertas WHERE ofertas.id_ofertas = ?";
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

    function editar_ofertas($id, $fecha_inic, $fecha_fin, $nombre_oferta, $procentaje, $tipo_descue)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_c = "UPDATE ofertas SET fecha_inic = ?, fecha_fin = ?, nombre_oferta = ?, procentaje = ?, tipo_descue = ? WHERE id_ofertas = ?";
            $query_c = $c->prepare($sql_c);
            $query_c->bindParam(1, $fecha_inic);
            $query_c->bindParam(2, $fecha_fin);
            $query_c->bindParam(3, $nombre_oferta);
            $query_c->bindParam(4, $procentaje);
            $query_c->bindParam(5, $tipo_descue);
            $query_c->bindParam(6, $id);
            if ($query_c->execute()) {
                $res = 1; // ok
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
}
