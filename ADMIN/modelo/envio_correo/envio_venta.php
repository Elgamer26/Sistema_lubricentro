<?php
require 'envio_correo.php';
$ME_CO = new envio_correo();

///////////////////
$correo = "";
$id = $_POST["id"];

//aqui llamo la nueva conexion
require_once "../conection/conections.php";

$consulta = 'SELECT
venta.id_venta,
venta.cliente_id,
cliente.nombres,
cliente.apellidos,
cliente.cedula,
cliente.correo,
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
venta
INNER JOIN cliente ON venta.cliente_id = cliente.id_cliente 
WHERE
venta.id_venta = "' . $id . '" ';

$result = $mysqli->query($consulta);
$fecha = date("Y-m-d");
while ($row = $result->fetch_assoc()) {

  $correo = $row['correo'];

  $html = '
    <div style="text-align:center;"><h1><u>Factura de venta</u></h1></div><br>
   
    <div style="float:right; width:auto;">
    <span><b>Fecha:</b>  ' . $fecha . '   </span>
    </div>    
    <div style="float:left; width:auto;">
    <span><b>Nombre y apellidos:</b>  ' . $row['nombres'] . ' ' . $row['apellidos'] . ' </span>
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
    <span><b>Iva :</b> ' . $row['impuesto'] . ' %</span>
    </div>
    <div style="float:left; width:auto;">
    <span><b>Tipo Doc.:</b> ' . $row['tipo_doc'] . ' </span>
    </div>
    <div style="float:left; width:auto;">
    <span><b>N° doc.:</b> ' . $row['numero_comprob'] . ' </span>
    </div>';

  $html .= '<div style="width:700px; text-align:center;">
                    <h2><u>Detalle de venta</u></h2>
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

  $consult_ingreso = 'SELECT
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
                      INNER JOIN tipo_producto ON producto.tipo_producto_id = tipo_producto.id_tipo_producto 
                      WHERE detalle_venta.id_venta =  "' . $id . '" ';

  $cont_ingreso = 0;

  //aqui estoy pidiendo la conexion y la consulta envio
  $resul_ingreso = $mysqli->query($consult_ingreso);
  while ($row_i = $resul_ingreso->fetch_assoc()) {

    $cont_ingreso++;
    $html .= ' <tr>
               <td style="text-align:center;">' . $cont_ingreso . '</td>
               <td style="text-align:center;">' . $row_i['producto_nombre'] . '</td>
               <td style="text-align:center;">' . $row_i['cantidad'] . '</td>
               <td style="text-align:center;">' . $row_i['precio'] . '</td>
               <td style="text-align:center;">' . $row_i['descuento_oferta'] . '</td>
               <td style="text-align:center;">' . $row_i['tipo_promo'] . '</td>
               <td style="text-align:center;">' . $row_i['descuento_moneda'] . '</td>
               <td style="text-align:center;">' . $row_i['subtotal'] . '</td> ';
  }

  $html .= '</tr>
    <tbody>
    </tbody>
    </table><br>
    
    <div style="float:left; width:auto;">
    <span><b>Subtotal:</b>$. ' .  $row['subtotal'] . ' </span>
    </div>
    
    <div style="float:left; width:auto;">
    <span><b>mpuesto:</b>$. ' .  $row['impuesto_sub'] . ' </span>
    </div>
    
    <div style="float:left; width:auto;">
    <span><b>Total:</b>$. ' .  $row['total'] . ' </span>
    </div>';
}

$sms = "Factura de venta";

$resultado = $ME_CO->enviar_correo($correo, $html, $sms);
echo $resultado;

exit();
