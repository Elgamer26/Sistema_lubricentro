<?php
//llamos al autoload.php del mpdf
require_once __DIR__ . '/../vendor/autoload.php';
//aqui llamo la nueva conexion
require_once "../../modelo/conection/conections.php";

$consulta = 'SELECT
            ingreso.ingreso_id,
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
            ingreso
            INNER JOIN proveedor ON ingreso.proveedor_id = proveedor.proveedor_id 
            WHERE
            ingreso.ingreso_id =  "' . $_GET["id"] . '" ';

$consulta_ha = 'SELECT * FROM empresa';
$result_ha = $mysqli->query($consulta_ha);
$foto_ha = mysqli_fetch_assoc($result_ha);

$result = $mysqli->query($consulta);
$fecha = date("Y-m-d");
while ($row = $result->fetch_assoc()) {


    $html = '<img src="../../' . $foto_ha['foto'] . '" style="width: 220px; float:left" height="90px" width="90px"> 
    <div style="text-align:center;"><h1><u>Comprobante de compra</u></h1></div><br>
   
    <div style="float:right; width:auto;">
    <span><b>Fecha compra:</b>  ' . $row['ingreso_fecha'] . '   </span>
    </div>
       
    <div style="float:left; width:auto">
    <span><b>Proveedor:</b> ' . $row['razon_social'] . '  </span>
    </div>

    <div style="float:left; width:auto">
    <span><b>Tipo de documento:</b> ' . $row['ingreso_ticomprobante'] . '  </span>
    </div>
    
    <div style="float:left; width:auto;">
    <span><b>N° de comprobante:</b>  ' . $row['ingreso_numcomrpobante'] . ' </span>
    </div>

    <div style="float:left; width:auto;">
    <span><b>Impuesto:</b> ' . $row['ingreso_porcentaje'] . ' %</span>
    </div>';

    if ($row['ingreso_estado'] == 'ANULADO') {

        $html .= ' <center>
        <h2>
            <div style="width:700px; text-align:center;">
                <span style="color:red;"></b> LA COMPRA FUE ANULADA </span>
            </div>
        </h2>
    </center>';
    }

    $html .= '<div style="width:700px; text-align:center;">
        <h2><u>Detalle compra</u></h2>
        </div>

            <table style="width:100%; border-collapse:collapse;" border="1">
        <thead>
             <tr bgcolor="orange">
                <th>#</th>
                <th>Producto</th>
                <th>Cajas</th>
                <th>Unidad</th>
                <th>Precio</th>
                <th>Descuento</th>
                <th>Total</th>
            </tr>
        </thead>';

    $consultacrias = 'SELECT
	detalle_ingreso.ingreso_id,
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
    WHERE detalle_ingreso.ingreso_id = "' . $_GET["id"] . '" ';

    $contadromed = 0;
    //aqui estoy pidiendo la conexion y la consulta envio
    $resultmedi = $mysqli->query($consultacrias);

    while ($rowmedi = $resultmedi->fetch_assoc()) {

        $contadromed++;
        $html .= ' <tr>
               <td style="text-align:center;">  ' . $contadromed . '</td>
               <td style="text-align:center;">  ' . $rowmedi['producto_nombre'] . ' ' . $rowmedi['tipo_producto'] . ' ' . $rowmedi['marca'] . '</td>
               <td style="text-align:center;">  ' . $rowmedi['cantidad'] . '</td>
               <td style="text-align:center;">  ' . $rowmedi['unidad'] . '</td>
               <td style="text-align:center;">  ' . $rowmedi['precio'] . '</td>
               <td style="text-align:center;">  ' . $rowmedi['descuento'] . '</td>
               <td style="text-align:center;"> $. ' . $rowmedi['subtotal'] . '</td>';
    }

    $html .= '</tr>
    <tbody>
    </tbody>
    </table><br>
    
    <div style="float:left; width:auto;">
    <span><b>Subtotal:</b> $. ' . $row['ingreso_total'] . ' </span>
    </div>
    
    <div style="float:left; width:auto;">
    <span><b>Impuesto ' . $row['ingreso_porcentaje'] . ' % :</b> $. ' . $row['ingreso_impusto'] . ' </span>
    </div>
    
    <div style="float:left; width:auto;">
    <span><b>Total:</b> $. ' . $row['ingreso_impuestototal'] . ' </span>
    </div>';
}

//esto es para cambiar el tamaño de la hoja
$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
$mpdf->WriteHTML($html);
$mpdf->Output();
