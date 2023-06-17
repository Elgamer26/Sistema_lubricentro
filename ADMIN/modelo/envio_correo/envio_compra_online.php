<?php
require 'envio_correo.php';
$ME_CO = new envio_correo();

$id = $_POST["id"];
$dato = $_POST["dato"];

require_once "../conect/conect_r.php";

$correo = "";
$sms = "";

if ($dato == "Depósito") {

  $sql = 'SELECT
  venta_tienda_online.compra_online_id, 
  venta_tienda_online.cliente_id, 
  venta_tienda_online.cedula, 
  venta_tienda_online.correo, 
  venta_tienda_online.domicilio, 
  venta_tienda_online.telefono, 
  venta_tienda_online.hora_fecha_compra, 
  venta_tienda_online.subtotal, 
  venta_tienda_online.impuesto_iva, 
  venta_tienda_online.total_pagar, 
  venta_tienda_online.tipo_pago, 
  venta_tienda_online.estado_pago, 
  venta_tienda_online.acepto, 
  venta_tienda_online.estado_venta, 
  venta_tienda_online.cantidad, 
  venta_tienda_online.porcentaje_iva, 
  CONCAT_WS(" ", cliente.cliente_nombre, cliente.cliente_app_pater, cliente.cliente_app_mat ) AS cliente, 
  cliente.cliente_sexo
  FROM
  venta_tienda_online
  INNER JOIN
  cliente
  ON 
      venta_tienda_online.cliente_id = cliente.cliente_id 
  WHERE
  venta_tienda_online.compra_online_id =  "' . $id . '" AND estado_venta = "Vendido"';

  $consulta_empresa = 'SELECT * FROM empresa';
  $resulta_empresa = $mysqli->query($consulta_empresa);
  $data_empresa = mysqli_fetch_assoc($resulta_empresa);

  date_default_timezone_set('America/Guayaquil');
  $fecha = date("d-m-Y");

  $result = $mysqli->query($sql);
  while ($row = $result->fetch_assoc()) {

    $correo = $row['correo'];

    $html = '<!DOCTYPE html>
        <html lang="en">
        <head>
          <meta charset="utf-8">
          <title>FACTURA DE VENTA</title>
          <link rel="stylesheet" href="../../REPORTES/css/style.css" media="all" />
        </head>
        <body>  
          <header class="clearfix">
        <table style="border-collapse;" border="1">
        <thead>
        <tr>
          <th width="20%" style="border-top:0px; border-left:0px; border-bottom:0px; border-right:0px;"></th>
          <th width="50%" style="border-top:0px; border-left:0px; border-bottom:0px; border-right:0px; text-align:left;">
          <b style="color: black;">Datos de le empresa:</b><br>
          <b style="color: black;">Direccion: </b> <span style="color: black;"> ' . $data_empresa['direccion'] . ' </span><br>
          <b style="color: black;">Telefono: </b> <span style="color: black;"> ' . $data_empresa['telefono'] . ' </span><br>
          <b style="color: black;">Correo: </b> <span style="color: black;"> ' . $data_empresa['email'] . '</span><br>
          </th>

          <th width="30%" style="text-align: center">
          <h3 style="color: black;"> Fecha emisio:  <span style="color: black;"> ' . $fecha . '  </span> </3><br>
          <h1  style="color: black;"> ' . $row['estado_pago'] . '</h1>
          <h3 style="color: black;">Estado: <span style="color: black;"></span>' . $row['estado_venta'] . '  </span> 
          </th>
        </tr>
      </thead>
        </table>
            <h1></h1>         
            <div id="project">
              <div><span style="color: black; font-size: 15px"><b> Cliente : </b>  ' . $row['cliente'] . ' </div>
              <div><span style="color: black; font-size: 15px"><b> Cedula : </b>  ' . $row['cedula'] . ' </div>
              <div><span style="color: black; font-size: 15px"><b> Direccion de domicilio : </b>  ' . $row['domicilio'] . ' </div>
              <div><span style="color: black; font-size: 15px"><b> Telefonon : </b>  ' . $row['telefono'] . ' </div>
              <div><span style="color: black; font-size: 15px"><b> Sexo : </b>  ' . $row['cliente_sexo'] . ' </div>
              <div><span style="color: black; font-size: 15px"><b> Correo : </b> ' . $row['correo'] . ' </div>
              <div><span style="color: black; font-size: 15px"><b> Fecha y hora compra: </b>  ' . $row['hora_fecha_compra'] . ' </div>
              <div><span style="color: black; font-size: 15px"><b> Cantidad productos: </b>  ' . $row['cantidad'] . ' </div>
              <div><span style="color: black; font-size: 15px"><b> Tipo de pago : </b> ' . $row['tipo_pago'] . ' </div>
              <div><span style="color: black; font-size: 15px"><b> Estado del pago: </b>  ' . $row['estado_pago'] . ' </div> 
            </div>
          </header>

          <main>
            <table>
              <thead>
                <tr>
                  <th style="color: black; " class="service"><b>ITEM</b></th>
                  <th style="color: black; " class="desc"><b>PRODUCTO</b></th>
                  <th style="color: black; "><b>CANTIDAD</b></th>
                  <th style="color: black; "><b>PRECIO</b></th>
                  <th style="color: black; "><b>DESC. % PROMO.</b></th>
                  <th style="color: black; "><b>TIPO PROMO.</b></th> 
                  <th style="color: black; "><b>TOTAL PRODUCTO</b></th> 
                </tr>
              </thead>
              <tbody>';

    $sqldetalle = 'SELECT
      detalle_compra_online.compra_online_id,
      detalle_compra_online.producto_id,
      producto.producto_nombre,
      tipo_producto.tipo_producto,
      marca.marca_producto,
      detalle_compra_online.precio_compra,
      detalle_compra_online.cantidad,
      detalle_compra_online.promocion,
      detalle_compra_online.tipo_promocion,
      detalle_compra_online.porcentaje_promocion,
      detalle_compra_online.descuento_promo,
      detalle_compra_online.estado_compra,
      detalle_compra_online.tipo_pago,
      detalle_compra_online.total_compra 
      FROM
      detalle_compra_online
      INNER JOIN producto ON detalle_compra_online.producto_id = producto.producto_id
      INNER JOIN tipo_producto ON producto.tipo_producto_id = tipo_producto.tipo_producto_id
      INNER JOIN marca ON producto.marca_producto_id = marca.marca_id 
      WHERE
      detalle_compra_online.compra_online_id = "' . $id . '"
      AND detalle_compra_online.estado_compra = "Vendido"';

    $contador = 0;
    // aqui estoy pidiendo la conexion y la consulta envio
    $resultmedi = $mysqli->query($sqldetalle);
    while ($rowmedi = $resultmedi->fetch_assoc()) {
      $contador++;
      $html .= '<tr>
                  <td class="service">' . $contador . '</td>
                  <td class="desc"> ' . $rowmedi['producto_nombre'] . ' - ' . $rowmedi['tipo_producto'] . ' - ' . $rowmedi['marca_producto'] . ' </td>
                  <td class="desc"> ' . $rowmedi['cantidad'] . ' </td>             
                  <td class="unit"> ' . $rowmedi['precio_compra'] . ' </td>
                  <td class="qty"> ' . $rowmedi['descuento_promo'] . ' </td>
                  <td class="total"> ' . $rowmedi['promocion'] . ' </td> 
                  <td class="total"> ' . $rowmedi['total_compra'] . ' </td>
                </tr>';
    }

    $html .= '<tr>
              <td colspan="2" rowspan="4" style="background: #ffffff;"> 
              <b>
            
              </b> 
              </td>
          </tr>     
              <tr>
              <td style="background: #ffffff;" colspan="4">SUBTOTAL:</td>
              <td style="background: #ffffff;" class="total">$ ' . $row['subtotal'] . '   </td>
          </tr>
          <tr>
              <td style="background: #ffffff;" colspan="4">Iva %  </td>
              <td style="background: #ffffff;" class="total">$ ' . $row['impuesto_iva'] . ' </td>
          </tr>
          <tr>
              <td style="background: #ffffff;" colspan="4" class="TOTAL">Gran total:</td>
              <td style="background: #ffffff;" class="grand total">$ ' . $row['total_pagar'] . ' </td>
          </tr>
          </tbody>';


    $html .= '</tbody>
            </table>   
          </main>        
        </body>
      </html>';
  }

  $sms = "Compra por deposito/Optica Kairos";

} else {

  $sql = 'SELECT
  venta_tienda_online.compra_online_id,
  venta_tienda_online.cliente_id,
  venta_tienda_online.cedula,
  venta_tienda_online.correo,
  venta_tienda_online.domicilio,
  venta_tienda_online.telefono,
  venta_tienda_online.hora_fecha_compra,
  venta_tienda_online.subtotal,
  venta_tienda_online.impuesto_iva,
  venta_tienda_online.total_pagar,
  venta_tienda_online.tipo_pago,
  venta_tienda_online.estado_pago,
  venta_tienda_online.acepto,
  venta_tienda_online.estado_venta,
  venta_tienda_online.cantidad,
  venta_tienda_online.porcentaje_iva,
  venta_tienda_online.estado_despacho,
  CONCAT_WS( " ", cliente.cliente_nombre, cliente.cliente_app_pater, cliente.cliente_app_mat ) AS cliente,
  cliente.cliente_correo,
  cliente.cliente_sexo,
  pasarela_pagos.pasarel_id,
  pasarela_pagos.id_transaccion,
  pasarela_pagos.id_payer,
  pasarela_pagos.nombre_usuario,
  pasarela_pagos.`status`,
  pasarela_pagos.fecha 
  FROM
      venta_tienda_online
      INNER JOIN cliente ON venta_tienda_online.cliente_id = cliente.cliente_id
      INNER JOIN pasarela_pagos ON venta_tienda_online.compra_online_id = pasarela_pagos.compra_online_id 
  WHERE
  estado_venta = "Vendido" and venta_tienda_online.tipo_pago = "Paypal" and venta_tienda_online.compra_online_id =  "' . $id . '"';

  $consulta_empresa = 'SELECT * FROM empresa';
  $resulta_empresa = $mysqli->query($consulta_empresa);
  $data_empresa = mysqli_fetch_assoc($resulta_empresa);

  date_default_timezone_set('America/Guayaquil');
  $fecha = date("d-m-Y");

  $result = $mysqli->query($sql);
  while ($row = $result->fetch_assoc()) {

    $correo = $row['cliente_correo'];

    $html = '<!DOCTYPE html>
      <html lang="en">
        <head>
          <meta charset="utf-8">
          <title>FACTURA DE VENTA</title>
          <link rel="stylesheet" href="../../REPORTES/css/style.css" media="all" />
        </head>
        <body>  
          <header class="clearfix">
        <table style="border-collapse;" border="1">
        <thead>
        <tr>
          <th width="20%" style="border-top:0px; border-left:0px; border-bottom:0px; border-right:0px;"></th>
          <th width="50%" style="border-top:0px; border-left:0px; border-bottom:0px; border-right:0px; text-align:left;">
          <b style="color: black;">Datos de le empresa:</b><br>
          <b style="color: black;">Direccion: </b> <span style="color: black;"> ' . $data_empresa['direccion'] . ' </span><br>
          <b style="color: black;">Telefono: </b> <span style="color: black;"> ' . $data_empresa['telefono'] . ' </span><br>
          <b style="color: black;">Correo: </b> <span style="color: black;"> ' . $data_empresa['email'] . '</span><br>
          </th>
  
          <th width="30%" style="text-align: center">
          <h3 style="color: black;"> Fecha emisio:  <span style="color: black;"> ' . $fecha . '  </span> </3><br>
          <h1  style="color: black;"> ' . $row['estado_pago'] . '</h1>
          <h3 style="color: black;">Estado: <span style="color: black;"></span>' . $row['estado_venta'] . '  </span> 
           </th>
        </tr>
      </thead>
        </table>
            <h1></h1>         
            <div id="project">
              <div><span style="color: black; font-size: 13px"><b> Cliente : </b>  ' . $row['cliente'] . ' - <span style="color: black; font-size: 13px"><b> Sexo : </b>  ' . $row['cliente_sexo'] . ' - <span style="color: black; font-size: 13px"><b> Cedula : </b>  ' . $row['cedula'] . ' </div>
              <div><span style="color: black; font-size: 13px"><b> Direccion de domicilio : </b>  ' . $row['domicilio'] . ' - <span style="color: black; font-size: 13px"><b> Telefonon : </b>  ' . $row['telefono'] . '</div>
              <div><span style="color: black; font-size: 13px"><b> Correo : </b> ' . $row['cliente_correo'] . ' </div>
              <div><span style="color: black; font-size: 13px"><b> Fecha y hora compra: </b>  ' . $row['hora_fecha_compra'] . ' - <span style="color: black; font-size: 13px"><b> Cantidad productos: </b>  ' . $row['cantidad'] . ' </div>
              <div><span style="color: black; font-size: 13px"><b> Iva% : </b>% ' . $row['porcentaje_iva'] . ' </div>
              <div><span style="color: black; font-size: 13px"><b> Tipo de pago : </b> ' . $row['tipo_pago'] . ' - <span style="color: black; font-size: 13px"><b> Estado del pago: </b>  ' . $row['estado_pago'] . ' </div>

            </div>
          </header>
  
          <main>
            <table>
              <thead>
                <tr>
                  <th style="color: black; " class="service"><b>ITEM</b></th>
                  <th style="color: black; " class="desc"><b>PRODUCTO</b></th>
                  <th style="color: black; "><b>CANTIDAD</b></th>
                  <th style="color: black; "><b>PRECIO</b></th>
                  <th style="color: black; "><b>DESC. % PROMO.</b></th>
                  <th style="color: black; "><b>TIPO PROMO.</b></th> 
                  <th style="color: black; "><b>TOTAL PRODUCTO</b></th> 
                </tr>
              </thead>
              <tbody>';

    $sqldetalle = 'SELECT
      detalle_compra_online.compra_online_id,
      detalle_compra_online.producto_id,
      producto.producto_nombre,
      tipo_producto.tipo_producto,
      marca.marca_producto,
      detalle_compra_online.precio_compra,
      detalle_compra_online.cantidad,
      detalle_compra_online.promocion,
      detalle_compra_online.tipo_promocion,
      detalle_compra_online.porcentaje_promocion,
      detalle_compra_online.descuento_promo,
      detalle_compra_online.estado_compra,
      detalle_compra_online.tipo_pago,
      detalle_compra_online.total_compra 
      FROM
      detalle_compra_online
      INNER JOIN producto ON detalle_compra_online.producto_id = producto.producto_id
      INNER JOIN tipo_producto ON producto.tipo_producto_id = tipo_producto.tipo_producto_id
      INNER JOIN marca ON producto.marca_producto_id = marca.marca_id 
      WHERE
      detalle_compra_online.compra_online_id = "' . $id . '"
      AND detalle_compra_online.estado_compra = "Vendido"';

    $contador = 0;
    // aqui estoy pidiendo la conexion y la consulta envio
    $resultmedi = $mysqli->query($sqldetalle);
    while ($rowmedi = $resultmedi->fetch_assoc()) {
      $contador++;
      $html .= '<tr>
                  <td class="service">' . $contador . '</td>
                  <td class="desc"> ' . $rowmedi['producto_nombre'] . ' - ' . $rowmedi['tipo_producto'] . ' - ' . $rowmedi['marca_producto'] . ' </td>
                  <td class="desc"> ' . $rowmedi['cantidad'] . ' </td>             
                  <td class="unit"> ' . $rowmedi['precio_compra'] . ' </td>
                  <td class="qty"> ' . $rowmedi['descuento_promo'] . ' </td>
                  <td class="total"> ' . $rowmedi['promocion'] . ' </td> 
                  <td class="total"> ' . $rowmedi['total_compra'] . ' </td>
                </tr>';
    }

    $html .= '<tr>
              <td colspan="2" rowspan="4" style="background: #ffffff;"> 
              <b>
             
              </b> 
              </td>

          </tr>     
              <tr>
              <td style="background: #ffffff;" colspan="4">SUBTOTAL:</td>
              <td style="background: #ffffff;" class="total">$ ' . $row['subtotal'] . '   </td>
          </tr>
          <tr>
              <td style="background: #ffffff;" colspan="4">Iva %  </td>
              <td style="background: #ffffff;" class="total">$ ' . $row['impuesto_iva'] . ' </td>
          </tr>
          <tr>
              <td style="background: #ffffff;" colspan="4" class="TOTAL">Gran total:</td>
              <td style="background: #ffffff;" class="grand total">$ ' . $row['total_pagar'] . ' </td>
          </tr>
          </tbody>';


    $html .= '</tbody>
            </table>   
          </main>        
        </body>
      </html>';
  }

  $sms = "Compra por Paypal/Optica Kairos";
}

if ($correo != "") {
  $resultado = $ME_CO->enviar_correo($correo, $html, $sms);
  echo $resultado;
  exit();
}
exit();
