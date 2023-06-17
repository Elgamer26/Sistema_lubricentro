<?php
//llamos al autoload.php del mpdf
require_once __DIR__ . '/../vendor/autoload.php';
//aqui llamo la nueva conexion
require_once "../../modelo/conection/conections.php";

$consulta = 'SELECT
            venta.id_venta,
            cliente.nombres,
            cliente.apellidos,
            cliente.cedula,
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
            venta.id_venta =  "' . $_GET["id"] . '" ';

$consulta_ha = 'SELECT * FROM empresa';
$result_ha = $mysqli->query($consulta_ha);
$foto_ha = mysqli_fetch_assoc($result_ha);

$result = $mysqli->query($consulta);
$fecha = date("Y-m-d");
while ($row = $result->fetch_assoc()) {


    $html = '<img src="../../' . $foto_ha['foto'] . '" style="width: 220px; float:left" height="90px" width="90px"> 
    <div style="text-align:center;"><h1><u>Factura de venta</u></h1></div><br>
   
    <div style="float:right; width:auto;">
    <span><b>Fecha venta:</b>  ' . $row['fecha'] . '   </span>
    </div>
       
    <div style="float:left; width:auto">
    <span><b>Cliente:</b> ' . $row['nombres'] . ' ' . $row['apellidos'] . '  </span>
    </div>

    <div style="float:left; width:auto">
    <span><b>Cedula:</b> ' . $row['cedula'] . '  </span>
    </div>
    
    <div style="float:left; width:auto;">
    <span><b>Tipo de documento:</b>  ' . $row['tipo_doc'] . ' </span>
    </div>

    <div style="float:left; width:auto;">
    <span><b>N° documento:</b> ' . $row['numero_comprob'] . ' </span>
    </div>
    
    <div style="float:left; width:auto;">
    <span><b>Tipo de pago:</b> ' . $row['tipo_pago'] . ' </span>
    </div>';

    if ($row['estado'] == 'Anulado') {

        $html .= ' <center>
        <h2>
            <div style="width:700px; text-align:center;">
                <span style="color:red;"></b> LA VENTA FUE ANULADA </span>
            </div>
        </h2>
    </center>';
    }

    $html .= '<div style="width:700px; text-align:center;">
        <h2><u>Detalle venta</u></h2>
        </div>

            <table style="width:100%; border-collapse:collapse;" border="1">
        <thead>
             <tr bgcolor="orange">
                <th>#</th>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Desc. oferta</th>
                <th>Tipo oferta</th>
                <th>Desc. moneda</th>
                <th>Total</th>
            </tr>
        </thead>';

    $consultacrias = 'SELECT
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
	INNER JOIN tipo_producto ON producto.tipo_producto_id = tipo_producto.id_tipo_producto
	INNER JOIN marca ON producto.marca_producto_id = marca.id_marca
    WHERE detalle_venta.id_venta = "' . $_GET["id"] . '" ';

    $contadromed = 0;
    //aqui estoy pidiendo la conexion y la consulta envio
    $resultmedi = $mysqli->query($consultacrias);

    while ($rowmedi = $resultmedi->fetch_assoc()) {

        $contadromed++;
        $html .= ' <tr>
               <td style="text-align:center;">  ' . $contadromed . '</td>
               <td style="text-align:center;">  ' . $rowmedi['producto_nombre'] . ' ' . $rowmedi['tipo_producto'] . ' ' . $rowmedi['marca'] . '</td>
               <td style="text-align:center;">  ' . $rowmedi['cantidad'] . '</td>
               <td style="text-align:center;">  ' . $rowmedi['precio'] . '</td>
               <td style="text-align:center;">  ' . $rowmedi['descuento_oferta'] . '</td>
               <td style="text-align:center;">  ' . $rowmedi['tipo_promo'] . '</td>
               <td style="text-align:center;">  ' . $rowmedi['descuento_moneda'] . '</td>
               <td style="text-align:center;"> $. ' . $rowmedi['subtotal'] . '</td>';
    }

    $html .= '</tr>
    <tbody>
    </tbody>
    </table><br>
    
    <div style="float:left; width:auto;">
    <span><b>Subtotal:</b> $. ' . $row['subtotal'] . ' </span>
    </div>
    
    <div style="float:left; width:auto;">
    <span><b>Impuesto ' . $row['impuesto'] . ' % :</b> $. ' . $row['impuesto_sub'] . ' </span>
    </div>
    
    <div style="float:left; width:auto;">
    <span><b>Total:</b> $. ' . $row['total'] . ' </span>
    </div>';
}

//esto es para cambiar el tamaño de la hoja
$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
$mpdf->WriteHTML($html);
$mpdf->Output();
