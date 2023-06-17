<?php
require 'envio_correo.php';
$ME_CO = new envio_correo();

///////////////////
$correo = "";
$id = $_POST["id"];

//aqui llamo la nueva conexion
require_once "../conection/conections.php";

$consulta = 'SELECT
servicio_cliente.id_servicio_cliente,
CONCAT_WS( " ", cliente.nombres, cliente.apellidos ) AS cliente,
cliente.cedula,
cliente.correo,
CONCAT_WS( " ", vehiculo.vehiculo, marca_vehiculo.marca, vehiculo_cliente.matrcula, vehiculo_cliente.color ) AS vehiculo,
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
cliente
INNER JOIN vehiculo_cliente ON cliente.id_cliente = vehiculo_cliente.cliente
INNER JOIN servicio_cliente ON servicio_cliente.id_vehiculo_cliente = vehiculo_cliente.id_clie_vehi
INNER JOIN vehiculo ON vehiculo_cliente.tipo_vehoculo = vehiculo.id_vehiculo
INNER JOIN marca_vehiculo ON vehiculo_cliente.tipo_marca = marca_vehiculo.id_marca
WHERE
servicio_cliente.id_servicio_cliente = "' . $id . '" ';

$result = $mysqli->query($consulta);
$fecha = date("Y-m-d");
while ($row = $result->fetch_assoc()) {

  $correo = $row['correo'];

  $html = '
    <div style="text-align:center;"><h1><u>Factura de servicio</u></h1></div><br>
   
    <div style="float:right; width:auto;">
    <span><b>Fecha:</b>  ' . $fecha . '   </span>
    </div>    
    <div style="float:left; width:auto;">
    <span><b>Nombre y apellidos:</b>  ' . $row['cliente'] . ' </span>
    </div>
    <div style="float:left; width:auto">
    <span><b>Cedula:</b> ' . $row['cedula'] . '  </span>
    </div>
    <div style="float:left; width:auto">
    <span><b>Correo:</b> ' . $row['correo'] . '  </span>
    </div>

    <div style="float:left; width:auto">
    <span><b>Tipo pago:</b> ' . $row['tipo_pago'] . '  </span>
    </div>

    <div style="float:left; width:auto">
    <span><b>Iva :</b> ' . $row['inpuesto'] . ' %</span>
    </div>
    <div style="float:left; width:auto;">
    <span><b>Tipo Doc.:</b> ' . $row['tipo_comprobante'] . ' </span>
    </div>
    <div style="float:left; width:auto;">
    <span><b>N° doc.:</b> ' . $row['num_compro'] . ' </span>
    </div>';

  $html .= '<div style="width:700px; text-align:center;">
                    <h2><u>Detalle de servicio</u></h2>
            </div>

        <table style="width:100%; border-collapse:collapse;" border="1">
            <thead>
                <tr bgcolor="green">
                    <th>#</th>
                    <th>Servicio</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Descuento</th>
                    <th>Total</th>
                </tr>
            </thead>';

  $consult_ingreso = 'SELECT
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
            detalle_servicios_cliente.id_servicio_cliente = "' . $id . '" ';

  $cont_ingreso = 0;

  //aqui estoy pidiendo la conexion y la consulta envio
  $resul_ingreso = $mysqli->query($consult_ingreso);
  while ($row_i = $resul_ingreso->fetch_assoc()) {

    $cont_ingreso++;
    $html .= ' <tr>
               <td style="text-align:center;">' . $cont_ingreso . '</td>
               <td style="text-align:center;">' . $row_i['servicio'] . '</td>
               <td style="text-align:center;">' . $row_i['precio'] . '</td>
               <td style="text-align:center;">' . $row_i['cantidad'] . '</td>
               <td style="text-align:center;">' . $row_i['descuento'] . '</td>
               <td style="text-align:center;">' . $row_i['subtotal'] . '</td> ';
  }

  $html .= '</tr>
    <tbody>
    </tbody>
    </table><br>
    
    <div style="float:left; width:auto;">
    <span><b>Total:</b>$. ' .  $row['total_servico'] . ' </span>
    </div>';


  $html .= '<div style="width:700px; text-align:center;">
                    <h2><u>Detalle de productos</u></h2>
            </div>

        <table style="width:100%; border-collapse:collapse;" border="1">
            <thead>
                <tr bgcolor="green">
                    <th>#</th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Desc.% promocion</th>
                    <th>Tipo promo</th>
                    <th>Desc. moneda</th>
                    <th>Subtotal</th>
                </tr>
            </thead>';

  $consult_servico = 'SELECT
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
            detalle_servicio_producto.id_servicio_cliente = "' . $id . '" ';

  $cont_servicio = 0;

  //aqui estoy pidiendo la conexion y la consulta envio
  $resul_servicio = $mysqli->query($consult_servico);
  while ($row_s = $resul_servicio->fetch_assoc()) {

    $cont_servicio++;
    $html .= ' <tr>
               <td style="text-align:center;">' . $cont_servicio . '</td>
               <td style="text-align:center;">' . $row_s['producto_nombre'] . '</td>
               <td style="text-align:center;">' . $row_s['cantidad'] . '</td>
               <td style="text-align:center;">' . $row_s['precio'] . '</td>
               <td style="text-align:center;">' . $row_s['descuento_oferta'] . '</td>
               <td style="text-align:center;">' . $row_s['tipo_promo'] . '</td>
               <td style="text-align:center;">' . $row_s['descuento_moneda'] . '</td>
               <td style="text-align:center;">' . $row_s['subtotal'] . '</td> ';
  }

  $html .= '</tr>
    <tbody>
    </tbody>
    </table><br>
    
    <div style="float:left; width:auto;">
    <span><b>Subtotal:</b>$. ' .  $row['totalneto_pro'] . ' </span>
    </div>
    
    <div style="float:left; width:auto;">
    <span><b>Impuesto:</b>$. ' .  $row['impuesto_pro'] . ' </span>
    </div>
    
    <div style="float:left; width:auto;">
    <span><b>Total:</b>$. ' .  $row['total_pago_pro'] . ' </span>
    </div>';

}

$sms = "Factura de servicio";

$resultado = $ME_CO->enviar_correo($correo, $html, $sms);
echo $resultado;

exit();
