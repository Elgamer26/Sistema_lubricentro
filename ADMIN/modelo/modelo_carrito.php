<?php
require_once 'modelo_conexion.php';
class modelo_carrito extends modelo_conexion
{

    function verifcar_usuario($email, $cedula)
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            cliente.id_cliente, 
            cliente.nombres, 
            cliente.apellidos, 
            cliente.cedula, 
            cliente.correo, 
            cliente.estado
            FROM
            cliente WHERE cliente.correo = ? AND cliente.cedula = ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $email);
            $query->bindParam(2, $cedula);
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

    function agg_carrito($id, $id_usua)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_a = "SELECT * FROM agg_carrito where cliente_id = ? AND producto_id = ?";
            $query_a = $c->prepare($sql_a);
            $query_a->bindParam(1, $id_usua);
            $query_a->bindParam(2, $id);
            $query_a->execute();
            $data_a = $query_a->fetch(PDO::FETCH_BOTH);
            if (empty($data_a)) {

                $sql_c = "INSERT INTO agg_carrito (cliente_id, producto_id, cantidad, promocion, tipo_promo, porcentaje, descuento_promo) VALUES (?,?,1,'No destacado','0','0','0')";
                $query_c = $c->prepare($sql_c);
                $query_c->bindParam(1, $id_usua);
                $query_c->bindParam(2, $id);
                if ($query_c->execute()) {
                    $res = 1; // registro exitoso
                } else {
                    $res = 0; // error en la inserccion
                }
            } else {

                $cant = "";
                $cant = $data_a[2] + 1;

                $stock = 0;
                $sql_p = "SELECT stock FROM producto WHERE id_producto = ?";
                $query_p = $c->prepare($sql_p);
                $query_p->bindParam(1, $id);
                $query_p->execute();
                $dato_p = $query_p->fetch(PDO::FETCH_BOTH);
                foreach ($dato_p as $respuesto_p) {
                    $stock = $respuesto_p;
                }

                if ($cant > $stock) {
                    $res = "Stock" . $stock;
                } else {
                    $sql_d = "UPDATE agg_carrito SET cantidad = ? WHERE producto_id = ? AND cliente_id = ?";
                    $query_d = $c->prepare($sql_d);
                    $query_d->bindParam(1, $cant);
                    $query_d->bindParam(2, $id);
                    $query_d->bindParam(3, $id_usua);
                    if ($query_d->execute()) {
                        $res = 2; // exito atualizacion
                    } else {
                        $res = 3; // error en la actualizacion
                    }
                }
                $res = $res; // el prodcuto ya fue agregado
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

    //////////////////////
    function agregar_carrito_oferta($id, $id_cli)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_a = "SELECT * FROM agg_carrito where cliente_id = ? AND producto_id = ?";
            $query_a = $c->prepare($sql_a);
            $query_a->bindParam(1, $id_cli);
            $query_a->bindParam(2, $id);
            $query_a->execute();
            $data_a = $query_a->fetch(PDO::FETCH_BOTH);
            if (empty($data_a)) {

                $tipo_promocion = "";
                $valor = 0;
                $porcentaje = 0;
                $descuento = 0;
                $sql_p = "SELECT ofertas.tipo_descue, ofertas.procentaje, producto.producto_precio_venta FROM ofertas INNER JOIN producto ON ofertas.producto_id = producto.id_producto WHERE ofertas.producto_id = ?";
                $query_p = $c->prepare($sql_p);
                $query_p->bindParam(1, $id);
                $query_p->execute();
                $dato_p = $query_p->fetchAll(PDO::FETCH_BOTH);
                foreach ($dato_p as $respuesta) {
                    $valor = $respuesta[2];
                    $porcentaje = $respuesta[1];
                    $tipo_promocion = $respuesta[0];
                }
                $descuento = $valor * $porcentaje / 100;

                // $desc = number_format($descuento, 2);

                $sql_c = "INSERT INTO agg_carrito (cliente_id, producto_id, tipo_promo, porcentaje, descuento_promo, cantidad, promocion) VALUES (?,?,?,?,?,1,'Si destacado')";
                $query_c = $c->prepare($sql_c);
                $query_c->bindParam(1, $id_cli);
                $query_c->bindParam(2, $id);
                $query_c->bindParam(3, $tipo_promocion);
                $query_c->bindParam(4, $porcentaje);
                $query_c->bindParam(5, $descuento);

                if ($query_c->execute()) {
                    $res = 1; // registro exitoso
                } else {
                    $res = 0; // error en la inserccion
                }
            } else {

                $cant = "";
                $cant = $data_a[2] + 1;

                $stock = 0;
                $sql_p = "SELECT stock FROM producto WHERE id_producto = ?";
                $query_p = $c->prepare($sql_p);
                $query_p->bindParam(1, $id);
                $query_p->execute();
                $dato_p = $query_p->fetch(PDO::FETCH_BOTH);
                foreach ($dato_p as $respuesto_p) {
                    $stock = $respuesto_p;
                }

                if ($cant > $stock) {
                    $res = "Stock " . $stock;
                } else {
                    $sql_d = "UPDATE agg_carrito SET cantidad = ? WHERE producto_id = ? AND cliente_id = ?";
                    $query_d = $c->prepare($sql_d);
                    $query_d->bindParam(1, $cant);
                    $query_d->bindParam(2, $id);
                    $query_d->bindParam(3, $id_cli);
                    if ($query_d->execute()) {
                        $res = 2; // exito atualizacion
                    } else {
                        $res = 3; // error en la actualizacion
                    }
                }

                // $res = $res; // el prodcuto ya fue agregado
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

    ////////////
    function agg_carrito_servicios($id, $id_usua)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_a = "SELECT * FROM agg_servicio where id_cliente = ? AND id_servicio = ?";
            $query_a = $c->prepare($sql_a);
            $query_a->bindParam(1, $id_usua);
            $query_a->bindParam(2, $id);
            $query_a->execute();
            $data_a = $query_a->fetch(PDO::FETCH_BOTH);
            if (empty($data_a)) {

                $sql_c = "INSERT INTO agg_servicio (id_cliente, id_servicio) VALUES (?,?)";
                $query_c = $c->prepare($sql_c);
                $query_c->bindParam(1, $id_usua);
                $query_c->bindParam(2, $id);
                if ($query_c->execute()) {
                    $res = 1; // registro exitoso
                } else {
                    $res = 0; // error en la inserccion
                }
            } else {

                $res = 2;
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


    function mostrar_tu_carrito($id_cli)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_a = "SELECT
            COUNT(agg_carrito.producto_id) as cantidad   
            FROM
            agg_carrito WHERE agg_carrito.cliente_id = ?";
            $query_a = $c->prepare($sql_a);
            $query_a->bindParam(1, $id_cli);
            $query_a->execute();
            $data_a = $query_a->fetchAll(PDO::FETCH_BOTH);

            return $data_a;
            //cerramos la conexion
            modelo_conexion::cerrar_conexion();
        } catch (PDOException $e) {
            modelo_conexion::cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function vaciar_carrito($id_cli)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();

            $sql_c = "DELETE FROM agg_carrito WHERE cliente_id = ?";
            $query_c = $c->prepare($sql_c);
            $query_c->bindParam(1, $id_cli);
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

    function paguinar_prod_car()
    {

        try {
            $paginaactual = htmlspecialchars($_POST["partida"], ENT_QUOTES, 'UTF-8');
            $c = modelo_conexion::conexionPDO();
            if (!empty($_POST['valor'])) {
                $datos = $_POST['valor'];

                $sql = "SELECT
                COUNT(*) 
                FROM
                    marca
                    INNER JOIN producto ON marca.id_marca = producto.marca_producto_id
                    INNER JOIN tipo_producto ON producto.tipo_producto_id = tipo_producto.id_tipo_producto 
                WHERE
                producto.stock IS NOT NULL 
                AND producto._eliminado = 1 AND producto.producto_destacar = 0
                AND producto.poducto_codigo LIKE '%" . $datos . "%' 
                OR producto.producto_nombre LIKE '%" . $datos . "%'";
            } else {
                $sql = "SELECT
                COUNT(*) 
                FROM
                    marca
                    INNER JOIN producto ON marca.id_marca = producto.marca_producto_id
                    INNER JOIN tipo_producto ON producto.tipo_producto_id = tipo_producto.id_tipo_producto 
                WHERE
                producto.stock IS NOT NULL AND producto.producto_destacar = 0
                AND producto._eliminado = 1";
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
            $numlotes = 16;
            $nropaguinas = ceil($arreglo[0] / $numlotes);
            $lista = "";
            $tabla = "";
            //
            if ($paginaactual > 1) {
                $lista = $lista . '<li><a href="javascript:pagination(' . ($paginaactual - 1) . ');><span aria-hidden="true">«</span></a></li>';
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
                $lista = $lista . '<li><a href="javascript:pagination(' . ($paginaactual + 1) . '); aria-label="Next"><span aria-hidden="true">»</span></a></li>';
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
                WHERE
                producto.stock IS NOT NULL 
                AND producto._eliminado = 1 AND producto.producto_destacar = 0
                AND producto.poducto_codigo LIKE '%" . $datos . "%' 
                OR producto.producto_nombre LIKE '%" . $datos . "%' 
                LIMIT $limit,$numlotes";
            } else {
                $sql_p = "SELECT
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
                WHERE
                producto.stock IS NOT NULL AND producto.producto_destacar = 0
                AND producto._eliminado = 1 
                LIMIT $limit,$numlotes";
            }
            //
            $query_p = $c->prepare($sql_p);
            $query_p->execute();
            $result = $query_p->fetchAll(PDO::FETCH_BOTH);
            //
            foreach ($result as $respuesta) {

                $tabla = $tabla . '<div class="col-md-3 product-men" style="padding: 12px;">
                <div class="men-pro-item simpleCart_shelfItem">
                    <div class="men-thumb-item">
                        <img height="250px" width="250px"  src="../ADMIN/' . $respuesta[9] . '" alt="" class="pro-image-front">
                        <img height="250px" width="250px"  src="../ADMIN/' . $respuesta[9] . '" alt="" class="pro-image-back">
                        <div class="men-cart-pro">
                            <div class="inner-men-cart-pro">
                                <a href="single.php?id=' . $respuesta[0] . '" class="link-product-add-cart">VISTA RAPIDA</a>
                            </div>
                        </div>
                        
                        <span class="product-new-top"></span>

                    </div>
                    <div class="item-info-product ">
                        <h4><a href="javascript:;">' . $respuesta[2] . '</a></h4>
                        <div class="info-product-price">
                            <span class="item_price">$ ' . $respuesta[8] . '</span> 
                        </div>
                        <a onclick="agg_carrito(' . $respuesta[0] . ');" class="item_add single-item hvr-outline-out button2">Agregar al carrito</a>
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

    /////////////////
    function pagination_servicios()
    {

        try {
            $paginaactual = htmlspecialchars($_POST["partida"], ENT_QUOTES, 'UTF-8');
            $c = modelo_conexion::conexionPDO();
            if (!empty($_POST['valor'])) {
                $datos = $_POST['valor'];

                $sql = "SELECT
                COUNT(*)
                FROM
                    servicio 
                WHERE
                servicio.estado = 1 AND servicio.servicio LIKE '%" . $datos . "%'";
            } else {
                $sql = "SELECT
                COUNT(*)
                FROM
                    servicio 
                WHERE
                servicio.estado = 1";
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
            $numlotes = 16;
            $nropaguinas = ceil($arreglo[0] / $numlotes);
            $lista = "";
            $tabla = "";
            //
            if ($paginaactual > 1) {
                $lista = $lista . '<li><a href="javascript:pagination_servicios(' . ($paginaactual - 1) . ');><span aria-hidden="true">«</span></a></li>';
            }
            //
            for ($i = 1; $i <= $nropaguinas; $i++) {
                if ($i == $paginaactual) {
                    $lista = $lista . '<li class="active"><a href="javascript:pagination_servicios(' . ($i) . ');">' . $i . '</a></li>';
                } else {
                    $lista = $lista . '<li><a href="javascript:pagination_servicios(' . ($i) . ');">' . $i . '</a></li>';
                }
            }
            //
            if ($paginaactual < $nropaguinas) {
                $lista = $lista . '<li><a href="javascript:pagination_servicios(' . ($paginaactual + 1) . '); aria-label="Next"><span aria-hidden="true">»</span></a></li>';
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
                servicio.id_servicio,
                servicio.servicio,
                servicio.precio,
                servicio.estado,
                servicio.detalle,
                servicio.foto
                FROM
                    servicio 
                WHERE
                servicio.estado = 1 AND servicio.servicio LIKE '%" . $datos . "%' 
                LIMIT $limit,$numlotes";
            } else {
                $sql_p = "SELECT
                servicio.id_servicio,
                servicio.servicio,
                servicio.precio,
                servicio.estado,
                servicio.detalle,
                servicio.foto
                FROM
                    servicio 
                WHERE
                servicio.estado = 1 
                LIMIT $limit,$numlotes";
            }
            //
            $query_p = $c->prepare($sql_p);
            $query_p->execute();
            $result = $query_p->fetchAll(PDO::FETCH_BOTH);
            //
            foreach ($result as $respuesta) {

                $tabla = $tabla . '<div class="col-md-3 product-men" style="padding: 12px;">
                <div class="men-pro-item simpleCart_shelfItem">                
                    <br>
                    <div class="item-info-product ">
                        <h4><a href="javascript:;">' . $respuesta[1] . '</a></h4> <br>
                        <img style="width: 100%; height: 150px;" class="img-responsive" src="../ADMIN/' . $respuesta[5] . '" alt="Dummy Image">
                        <div class="info-product-price">
                            <span style="font-size: 15px;"><b> Detalle: ' . $respuesta[4] . ' </b></span> <br>
                            <span class="item_price">$ ' . $respuesta[2] . '</span>  
                        </div> 
                        <a onclick="agg_carrito_servicios(' . $respuesta[0] . ');" class="item_add single-item hvr-outline-out button2">Agregar servicio</a>
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

    function pagination_ofertas()
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
                OR ofertas.nombre_oferta LIKE '%" . $datos . "%'";
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
            $numlotes = 16;
            $nropaguinas = ceil($arreglo[0] / $numlotes);
            $lista = "";
            $tabla = "";
            //
            if ($paginaactual > 1) {
                $lista = $lista . '<li><a href="javascript:pagination_ofertas(' . ($paginaactual - 1) . ');><span aria-hidden="true">«</span></a></li>';
            }
            //
            for ($i = 1; $i <= $nropaguinas; $i++) {
                if ($i == $paginaactual) {
                    $lista = $lista . '<li class="active"><a href="javascript:pagination_ofertas(' . ($i) . ');">' . $i . '</a></li>';
                } else {
                    $lista = $lista . '<li><a href="javascript:pagination_ofertas(' . ($i) . ');">' . $i . '</a></li>';
                }
            }
            //
            if ($paginaactual < $nropaguinas) {
                $lista = $lista . '<li><a href="javascript:pagination_ofertas(' . ($paginaactual + 1) . '); aria-label="Next"><span aria-hidden="true">»</span></a></li>';
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
                ofertas.tipo_descue,
                producto.id_producto
                FROM
                    ofertas
                    INNER JOIN producto ON ofertas.producto_id = producto.id_producto
                    INNER JOIN tipo_producto ON producto.tipo_producto_id = tipo_producto.id_tipo_producto
                    INNER JOIN marca ON producto.marca_producto_id = marca.id_marca 
                WHERE
                producto._eliminado = 1 
                AND producto.poducto_codigo LIKE '%" . $datos . "%' 
                OR ofertas.nombre_oferta LIKE '%" . $datos . "%' 
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
                ofertas.tipo_descue,
                producto.id_producto
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
            $descuento = 0;
            $toral = 0;
            //
            foreach ($result as $respuesta) {

                $descuento = number_format($respuesta[6] * $respuesta[15] / 100, 2);
                $toral  = number_format($respuesta[6] - $descuento, 2);

                $tabla = $tabla . '<div class="col-md-3 product-men" style="padding: 12px;">
                <div class="men-pro-item simpleCart_shelfItem">
                    <div class="men-thumb-item">
                        <img height="250px" width="250px"  src="../ADMIN/' . $respuesta[7] . '" alt="" class="pro-image-front">
                        <img height="250px" width="250px"  src="../ADMIN/' . $respuesta[7] . '" alt="" class="pro-image-back">
                        <div class="men-cart-pro">
                            <div class="inner-men-cart-pro">
                                <a href="single_oferta.php?id=' . $respuesta[17] . '" class="link-product-add-cart">VISTA RAPIDA</a>
                            </div>
                        </div>
                        
                        <span class="product-new-top">Oferta</span>

                    </div>
                    <div class="item-info-product ">
                        <h4><a href="javascript:;">' . $respuesta[14] . '</a></h4> 

                        <span>Fecha fin oferta: <b>' . $respuesta[13] . '</b></span>
                        <span>Descuento: <b>' . $respuesta[15] . '%</b></span>                       

                        <div class="info-product-price">
                            <span class="item_price">$ ' . $toral . '</span> 
                            <del>$ ' . $respuesta[6] . '</del>
                        </div>
                        <a onclick="agg_carrito_oferta(' . $respuesta[17] . ');" class="item_add single-item hvr-outline-out button2">Agregar al carrito</a>
                    </div>
                </div>
            </div>';
            }
            //
            $array = array(0 => $tabla, 1 => $lista);
            return $array;
            //cerramos la conexion
            // modelo_conexion::cerrar_conexion();
        } catch (Exception $e) {
            // modelo_conexion::cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function mostrar_carrito_compra_detalle($id_cli)
    {
        try {
            $tota = 0;
            $gran_to = 0;
            $finl = 0;

            $sub = 0;
            $iva = 0;
            $pago_t = 0;
            $tabla = "";

            $c = modelo_conexion::conexionPDO();
            $sql_p = "SELECT
            agg_carrito.cliente_id,
            agg_carrito.producto_id,
            agg_carrito.cantidad,
            producto.producto_nombre,
            producto.producto_precio_venta,
            producto.producto_foto,
            agg_carrito.tipo_promo,
            agg_carrito.porcentaje,
            agg_carrito.descuento_promo 
            FROM
                agg_carrito
                INNER JOIN producto ON agg_carrito.producto_id = producto.id_producto 
            WHERE
            agg_carrito.cliente_id = ?";

            $query_p = $c->prepare($sql_p);
            $query_p->bindParam(1, $id_cli);
            $query_p->execute();
            $result = $query_p->fetchAll(PDO::FETCH_BOTH);
            foreach ($result as $respuesta) {

                // $tota = floatval($respuesta[2] * $respuesta[4]);
                // $gran_to = floatval($tota * $respuesta[7] / 100);
                // $finl = floatval($tota - $gran_to);

                $tota = sprintf('%.2f', $respuesta[2] * $respuesta[4]);
                $gran_to = sprintf('%.2f', $tota * $respuesta[7] / 100);
                $finl = sprintf('%.2f', $tota - $gran_to);

                $sub = $sub + $finl;
                $iva = sprintf('%.2f', $sub * 12 / 100);
                $pago_t = $sub + $iva;

                $tabla = $tabla . '	<tr class="rem1">
                <td class="invert-closeb">
                    <div class="rem">
                        <div class="close1"><a class="btn btn-danger" onclick="quitar_producto_detalle(' . $respuesta[0] . ',' . $respuesta[1] . ');">X</a></div>
                    </div>
 
                </td>

                <td style="text-align: -webkit-center;"><img height="100px" width="100px" src="../ADMIN/' . $respuesta[5] . '" alt="Imagen producto" class="img-responsive" /></td>
              
                <td class="invert">
                    <div class="quantity">
                        <div class="quantity-select">';

                if ($respuesta[2] > 1) {
                    $tabla = $tabla . '<div class="entry value-minus" onclick="dismi_cantidad_prod(' . $respuesta[0] . ',' . $respuesta[1] . ',' . $respuesta[2] . ');">&nbsp;</div>';
                } else {
                    $tabla = $tabla . '<div class="entry value-minus">&nbsp;</div>';
                }

                $tabla = $tabla . '<div class="entry value"><span>' . $respuesta[2] . '</span></div>
                            <div class="entry value-plus active" onclick="aumen_cantidad_prod(' . $respuesta[0] . ',' . $respuesta[1] . ',' . $respuesta[2] . ');">&nbsp;</div>
                        </div>
                    </div>
                </td>
                <td class="invert">' . $respuesta[3] . '</td>
                <td class="invert">' . $respuesta[4] . '</td>
                <td class="invert">' . $gran_to . '</td>
                <td class="invert">' . $finl . '</td>
            </tr>';
            }
            //    
            $array = array(0 => $tabla, 1 => $sub, 2 => $iva, 3 => $pago_t);
            return $array;
            //cerramos la conexion
            modelo_conexion::cerrar_conexion();
        } catch (Exception $e) {
            modelo_conexion::cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function mostrar_carrito_servicios($id_cli)
    {
        try {

            $sub = 0;
            $tabla = "";

            $c = modelo_conexion::conexionPDO();
            $sql_p = "SELECT
            agg_servicio.id_cliente,
            servicio.servicio,
            servicio.precio,
            agg_servicio.id_servicio
            FROM
            agg_servicio
            INNER JOIN servicio ON agg_servicio.id_servicio = servicio.id_servicio
            WHERE
            agg_servicio.id_cliente = ?";

            $query_p = $c->prepare($sql_p);
            $query_p->bindParam(1, $id_cli);
            $query_p->execute();
            $result = $query_p->fetchAll(PDO::FETCH_BOTH);
            foreach ($result as $respuesta) {

                $sub = $sub + $respuesta[2];

                $tabla = $tabla . '	<tr style="text-align: center;">
                <td class="invert-closeb">
                    <div class="rem">
                        <div class="close1"><a class="btn btn-danger" onclick="quitar_servicio_detalle(' . $respuesta[0] . ',' . $respuesta[3] . ');">X</a></div>
                    </div> 
                </td>     
                <td>' .  $respuesta[1] . '</td>
                <td>' .  $respuesta[2] . '</td>
            </tr>';
            }
            //    
            $array = array(0 => $tabla, 1 => $sub);
            return $array;
            //cerramos la conexion
            modelo_conexion::cerrar_conexion();
        } catch (Exception $e) {
            modelo_conexion::cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    // esto me permite aumentar o dismiuir la cantidad del producto del carrito
    function cantidad_producto_carrito($idcli, $idpro, $cant)
    {
        try {
            $resp = "";
            $stock = 0;
            $c = modelo_conexion::conexionPDO();
            $sql_p = "SELECT stock FROM producto WHERE id_producto = ?";
            $query_p = $c->prepare($sql_p);
            $query_p->bindParam(1, $idpro);
            $query_p->execute();
            $result = $query_p->fetch(PDO::FETCH_BOTH);
            foreach ($result as $respuesta) {
                $stock = $respuesta;

                if ($cant > $stock) {
                    $resp = "Stock " . $stock;
                } else {

                    $c = modelo_conexion::conexionPDO();
                    $sql_p = "UPDATE agg_carrito SET cantidad = ? WHERE cliente_id = ? AND producto_id = ?";
                    $query_p = $c->prepare($sql_p);
                    $query_p->bindParam(1, $cant);
                    $query_p->bindParam(2, $idcli);
                    $query_p->bindParam(3, $idpro);
                    if ($query_p->execute()) {
                        $resp = 1; // se aumento con exito
                    } else {
                        $resp = 0; // error al aumentar
                    }
                }
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

    function quitar_producto_detalle($id_cli, $id_pro)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_c = "DELETE FROM agg_carrito WHERE cliente_id = ? AND producto_id = ?";
            $query_c = $c->prepare($sql_c);
            $query_c->bindParam(1, $id_cli);
            $query_c->bindParam(2, $id_pro);
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

    function quitar_servicio_detalle($id_cli, $id_serv)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_c = "DELETE FROM agg_servicio WHERE id_cliente = ? AND id_servicio = ?";
            $query_c = $c->prepare($sql_c);
            $query_c->bindParam(1, $id_cli);
            $query_c->bindParam(2, $id_serv);
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

    ///////////////////////
    function listar_vehoculo_cliente($id_cli)
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
                vehiculo_cliente.id_clie_vehi,
                vehiculo_cliente.cliente AS id_cliente,
                vehiculo_cliente.matrcula,
                vehiculo.vehiculo,
                marca_vehiculo.marca,
                vehiculo_cliente.color,
                vehiculo_cliente.detalle 
                FROM
                    vehiculo_cliente
                    INNER JOIN vehiculo ON vehiculo_cliente.tipo_vehoculo = vehiculo.id_vehiculo
                    INNER JOIN marca_vehiculo ON vehiculo_cliente.tipo_marca = marca_vehiculo.id_marca
                    INNER JOIN cliente ON vehiculo_cliente.cliente = cliente.id_cliente 
                WHERE
                vehiculo_cliente.estado = 1 AND vehiculo_cliente.cliente = ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $id_cli);
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


    function ingreso_de_compra_paypal($id_cli, $sub, $iva, $total, $count, $impuesto, $tipo_doc, $numero_doc, $fecha_venta)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_c = "INSERT INTO venta (cliente_id, impuesto, tipo_doc, numero_comprob, fecha, cantidad, subtotal, impuesto_sub, total, estado, tipo_pago) 
                            VALUES (?,?,?,?,?,?,?,?,?,'Vendido','PayPal')";
            $query_c = $c->prepare($sql_c);
            $query_c->bindParam(1, $id_cli);
            $query_c->bindParam(2, $impuesto);
            $query_c->bindParam(3, $tipo_doc);
            $query_c->bindParam(4, $numero_doc);
            $query_c->bindParam(5, $fecha_venta);
            $query_c->bindParam(6, $count);
            $query_c->bindParam(7, $sub);
            $query_c->bindParam(8, $iva);
            $query_c->bindParam(9, $total);
            if ($query_c->execute()) {
                $res = $c->lastInsertId(); // me devulev el ultim ID insertado 
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

    function registrar_detalle_compra($id_cli, $id)
    {
        try {
            $tipo_oferta = "";
            $finl = 0;

            $res = "";
            $stock = 0;
            $stock_e = 0;

            $c = modelo_conexion::conexionPDO();
            $sql_p = "SELECT
            agg_carrito.cliente_id,
            agg_carrito.producto_id,
            agg_carrito.cantidad,
            producto.producto_precio_venta,
            agg_carrito.tipo_promo,
            agg_carrito.porcentaje,
            agg_carrito.descuento_promo 
            FROM
                agg_carrito
                INNER JOIN producto ON agg_carrito.producto_id = producto.id_producto 
            WHERE
            agg_carrito.cliente_id = ?";
            $query_p = $c->prepare($sql_p);
            $query_p->bindParam(1, $id_cli);
            $query_p->execute();
            $data = $query_p->fetchAll(PDO::FETCH_BOTH);
            $arreglo = array();
            foreach ($data as $respuesta) {

                if ($respuesta[4] == "Descuento") {
                    $tipo_oferta = "Descuento";
                } else {
                    $tipo_oferta = "No tiene";
                }

                $tota = sprintf('%.2f', $respuesta[2] * $respuesta[3]);
                $gran_to = sprintf('%.2f', $tota * $respuesta[5] / 100);
                $finl = sprintf('%.2f', $tota - $gran_to);
                $desc_moneda = 0;

                $sql_c = "INSERT INTO detalle_venta (id_venta, producto_id, cantidad, precio, descuento_oferta, tipo_promo,  descuento_moneda, subtotal) 
                            VALUES (?,?,?,?,?,?,?,?)";
                $query_c = $c->prepare($sql_c);
                $query_c->bindParam(1, $id);
                $query_c->bindParam(2, $respuesta[1]);
                $query_c->bindParam(3, $respuesta[2]);
                $query_c->bindParam(4, $respuesta[3]);
                $query_c->bindParam(5, $respuesta[6]);
                $query_c->bindParam(6, $tipo_oferta);
                $query_c->bindParam(7, $desc_moneda);
                $query_c->bindParam(8, $finl);
                if ($query_c->execute()) {

                    $sql_p = "SELECT stock FROM producto where id_producto = ?";
                    $query_p = $c->prepare($sql_p);
                    $query_p->bindParam(1, $respuesta[1]);
                    $query_p->execute();
                    $data = $query_p->fetch(PDO::FETCH_BOTH);
                    $arreglo = array();
                    foreach ($data as $respuesta_s) {
                        $arreglo[] = $respuesta_s;
                    }

                    $stock = $arreglo[0];
                    if ($stock == "" || $stock == 0) {
                        $stock = 0;
                    }
                    $stock = $stock - $respuesta[2];

                    $sql_m = "UPDATE producto SET stock = ? where id_producto = ?";
                    $query_m = $c->prepare($sql_m);
                    $query_m->bindParam(1, $stock);
                    $query_m->bindParam(2, $respuesta[1]);
                    if ($query_m->execute()) {

                        $sql_e = "SELECT stock FROM producto where id_producto = ?";
                        $query_e = $c->prepare($sql_e);
                        $query_e->bindParam(1, $respuesta[1]);
                        $query_e->execute();
                        $data_e = $query_e->fetch(PDO::FETCH_BOTH);
                        $arreglo_e = array();
                        foreach ($data_e as $respuesta_e) {
                            $arreglo_e[] = $respuesta_e;
                        }

                        $stock_e = $arreglo_e[0];
                        if ($stock_e == 0 || $stock_e < 0) {
                            $sql_ee = "UPDATE producto SET estado = 'agotado', stock = 0 where id_producto = ?";
                            $query_ee = $c->prepare($sql_ee);
                            $query_ee->bindParam(1, $respuesta[1]);
                            if ($query_ee->execute()) {
                                $res = 1;
                            } else {
                                $res = 0;
                            }
                        }

                        $sql_del = "DELETE FROM agg_carrito where cliente_id = ?";
                        $query_del = $c->prepare($sql_del);
                        $query_del->bindParam(1, $id_cli);
                        if ($query_del->execute()) {
                            $res = 1;
                        } else {
                            $res = 0;
                        }
                    } else {
                        $res = 2; // error de update
                    }
                } else {
                    $res = 0;
                }
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

    function registrar_cita_reserva($fecha_inicio, $asunto, $nota, $id_cliente, $fecha, $hora)
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

                        // $sql_a = "INSERT INTO cita(cliente_id,title,descripcion,start,color,textColor,estado) VALUES (?,?,?,?,?,?,'En espera')";
                        // $query_a = $c->prepare($sql_a);
                        // $query_a->bindParam(1, $id_cliente);
                        // $query_a->bindParam(2, $asunto);
                        // $query_a->bindParam(3, $nota);
                        // $query_a->bindParam(4, $fecha_inicio);
                        // $query_a->bindParam(5, $color);
                        // $query_a->bindParam(6, $color_etiqueta);
                        // if ($query_a->execute()) {
                        //     $resp = "N" . $c->lastInsertId(); // me devulev el ultim ID insertado 
                        // } else {
                        //     $resp = 0; // error al registrar
                        // }

                        $resp = 1;
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

    /////////////////////////////////
    //////////////////77
    function registrapago_paypal_servicio($color, $color_etiqueta, $fecha_inicio, $asunto, $nota, $id_cli, $vehiculo, $total_ser, $sub, $iva, $total, $impuesto, $tipo_doc, $numero_doc, $fecha_venta)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_c = "INSERT INTO servicio_cliente (id_vehiculo_cliente, inpuesto, tipo_comprobante, num_compro, fecha, total_servico, totalneto_pro, impuesto_pro, total_pago_pro, tipo_pago) 
                            VALUES (?,?,?,?,?,?,?,?,?,'PayPal')";

            $query_c = $c->prepare($sql_c);
            $query_c->bindParam(1, $vehiculo);
            $query_c->bindParam(2, $impuesto);
            $query_c->bindParam(3, $tipo_doc);
            $query_c->bindParam(4, $numero_doc);
            $query_c->bindParam(5, $fecha_venta);
            $query_c->bindParam(6, $total_ser);
            $query_c->bindParam(7, $sub);
            $query_c->bindParam(8, $iva);
            $query_c->bindParam(9, $total);

            if ($query_c->execute()) {

                $res = $c->lastInsertId(); // me devulev el ultim ID insertado 

                $sql_a = "INSERT INTO cita(cliente_id,title,descripcion,start,color,textColor,id_reserva,estado) VALUES (?,?,?,?,?,?,?,'En espera')";
                $query_a = $c->prepare($sql_a);
                $query_a->bindParam(1, $id_cli);
                $query_a->bindParam(2, $asunto);
                $query_a->bindParam(3, $nota);
                $query_a->bindParam(4, $fecha_inicio);
                $query_a->bindParam(5, $color);
                $query_a->bindParam(6, $color_etiqueta);
                $query_a->bindParam(7, $res);
                if ($query_a->execute()) {
                    $res = $res;
                } else {
                    $res = 0; // error al registrar
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

    function registrar_detalle_sericio_paypal($id_cli, $id)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_p = "SELECT
            agg_servicio.id_cliente, 
            agg_servicio.id_servicio, 
            servicio.precio
            FROM
            agg_servicio
            INNER JOIN
            servicio
            ON 
                agg_servicio.id_servicio = servicio.id_servicio
            WHERE
            agg_servicio.id_cliente = ?";
            $query_p = $c->prepare($sql_p);
            $query_p->bindParam(1, $id_cli);
            $query_p->execute();
            $data = $query_p->fetchAll(PDO::FETCH_BOTH);
            foreach ($data as $respuesta) {
                $cant = 1;
                $des = 0;
                $sql_c = "INSERT INTO detalle_servicios_cliente (id_servicio_cliente, id_servicio, cantidad, precio, descuento, subtotal) 
                VALUES (?,?,?,?,?,?)";
                $query_c = $c->prepare($sql_c);
                $query_c->bindParam(1, $id);
                $query_c->bindParam(2, $respuesta[1]);
                $query_c->bindParam(3, $cant);
                $query_c->bindParam(4, $respuesta[2]);
                $query_c->bindParam(5, $des);
                $query_c->bindParam(6, $respuesta[2]);
                if ($query_c->execute()) {
                    $sql_del = "DELETE FROM agg_servicio where id_cliente = ?";
                    $query_del = $c->prepare($sql_del);
                    $query_del->bindParam(1, $id_cli);
                    if ($query_del->execute()) {
                        $res = 1;
                    } else {
                        $res = 0;
                    }
                } else {
                    $res = 0; // error de update
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

    function registrar_detalle_producto_servicio_paypal($id_cli, $id)
    {
        try {
            $tipo_oferta = "";
            $finl = 0;

            $res = "";
            $stock = 0;
            $stock_e = 0;

            $c = modelo_conexion::conexionPDO();
            $sql_p = "SELECT
            agg_carrito.cliente_id,
            agg_carrito.producto_id,
            agg_carrito.cantidad,
            producto.producto_precio_venta,
            agg_carrito.tipo_promo,
            agg_carrito.porcentaje,
            agg_carrito.descuento_promo 
            FROM
                agg_carrito
                INNER JOIN producto ON agg_carrito.producto_id = producto.id_producto 
            WHERE
            agg_carrito.cliente_id = ?";
            $query_p = $c->prepare($sql_p);
            $query_p->bindParam(1, $id_cli);
            $query_p->execute();
            $data = $query_p->fetchAll(PDO::FETCH_BOTH);
            $arreglo = array();
            foreach ($data as $respuesta) {

                if ($respuesta[4] == "Descuento") {
                    $tipo_oferta = "Descuento";
                } else {
                    $tipo_oferta = "No tiene";
                }

                $tota = sprintf('%.2f', $respuesta[2] * $respuesta[3]);
                $gran_to = sprintf('%.2f', $tota * $respuesta[5] / 100);
                $finl = sprintf('%.2f', $tota - $gran_to);
                $desc_moneda = 0;

                $sql_c = "INSERT INTO detalle_servicio_producto (id_servicio_cliente, producto_id, cantidad, precio, descuento_oferta, tipo_promo, descuento_moneda, subtotal) 
                            VALUES (?,?,?,?,?,?,?,?)";
                $query_c = $c->prepare($sql_c);
                $query_c->bindParam(1, $id);
                $query_c->bindParam(2, $respuesta[1]);
                $query_c->bindParam(3, $respuesta[2]);
                $query_c->bindParam(4, $respuesta[3]);
                $query_c->bindParam(5, $respuesta[6]);
                $query_c->bindParam(6, $tipo_oferta);
                $query_c->bindParam(7, $desc_moneda);
                $query_c->bindParam(8, $finl);
                if ($query_c->execute()) {

                    $sql_p = "SELECT stock FROM producto where id_producto = ?";
                    $query_p = $c->prepare($sql_p);
                    $query_p->bindParam(1, $respuesta[1]);
                    $query_p->execute();
                    $data = $query_p->fetch(PDO::FETCH_BOTH);
                    $arreglo = array();
                    foreach ($data as $respuesta_s) {
                        $arreglo[] = $respuesta_s;
                    }

                    $stock = $arreglo[0];
                    if ($stock == "" || $stock == 0) {
                        $stock = 0;
                    }

                    $stock = $stock - $respuesta[2];

                    $sql_m = "UPDATE producto SET stock = ? where id_producto = ?";
                    $query_m = $c->prepare($sql_m);
                    $query_m->bindParam(1, $stock);
                    $query_m->bindParam(2, $respuesta[1]);
                    if ($query_m->execute()) {

                        $sql_e = "SELECT stock FROM producto where id_producto = ?";
                        $query_e = $c->prepare($sql_e);
                        $query_e->bindParam(1, $respuesta[1]);
                        $query_e->execute();
                        $data_e = $query_e->fetch(PDO::FETCH_BOTH);
                        $arreglo_e = array();
                        foreach ($data_e as $respuesta_e) {
                            $arreglo_e[] = $respuesta_e;
                        }

                        $stock_e = $arreglo_e[0];
                        if ($stock_e == 0 || $stock_e < 0) {
                            $sql_ee = "UPDATE producto SET estado = 'agotado', stock = 0 where id_producto = ?";
                            $query_ee = $c->prepare($sql_ee);
                            $query_ee->bindParam(1, $respuesta[1]);
                            if ($query_ee->execute()) {
                                $res = 1;
                            } else {
                                $res = 0;
                            }
                        }

                        $sql_del = "DELETE FROM agg_carrito where cliente_id = ?";
                        $query_del = $c->prepare($sql_del);
                        $query_del->bindParam(1, $id_cli);
                        if ($query_del->execute()) {
                            $res = 1;
                        } else {
                            $res = 0;
                        }
                    } else {
                        $res = 2; // error de update
                    }
                } else {
                    $res = 0;
                }
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

    ///////////// ciente usuario
    function traer_datos_cliente($id)
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            cliente.id_cliente, 
            cliente.nombres, 
            cliente.apellidos, 
            cliente.cedula, 
            cliente.correo, 
            cliente.direccion, 
            cliente.fecha, 
            cliente.sexo, 
            cliente.telefono, 
            cliente.estado
        FROM
            cliente WHERE cliente.id_cliente = ?";
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

    function registrar_cliente_usuario($id, $nombre, $apellidos, $direccion, $telefonoo, $correo, $fecha, $sexo, $cedula)
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
            modelo_conexion::cerrar_conexion();
        } catch (PDOException $e) {
            modelo_conexion::cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function listado_ventas_cliente($id)
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
            INNER JOIN venta ON cliente.id_cliente = venta.cliente_id WHERE venta.cliente_id = ?";
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

    function lisra_servicios_clientes_usuario($id)
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
                WHERE vehiculo_cliente.cliente = ?
            ORDER BY
            servicio_cliente.id_servicio_cliente DESC";

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

    function listar_reservass_clientes_usuario($id)
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
            INNER JOIN cliente ON cita.cliente_id = cliente.id_cliente WHERE cita.cliente_id = ?";
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

    function listar_vehculos_clientess_usuario($id)
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
            INNER JOIN cliente ON vehiculo_cliente.cliente = cliente.id_cliente WHERE vehiculo_cliente.cliente = ?";
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
}
