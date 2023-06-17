<?php
//llamos al autoload.php del mpdf
require_once __DIR__ . '/../../vendor/autoload.php';
//aqui llamo la nueva conexion
require_once "../../../modelo/conection/conections.php";

$f_i = $_GET["f_i"];
$f_f = $_GET["f_f"];

$consulta_ha = 'SELECT * FROM empresa';
$result_ha = $mysqli->query($consulta_ha);
$foto_ha = mysqli_fetch_assoc($result_ha);

$html = '<img src="../../../' . $foto_ha['foto'] . '" style="width: 220px; float:left" height="90px" width="90px"> 
    <div style="text-align:center;"><h1><u>Reporte de compra</u></h1></div><br>';

$html .= '<div style="width:700px; text-align:center;">
                   
            </div>

            <div style="float:right; width:auto;">
            <span><b>Desde:</b>  ' . $f_i . ' - <b>Hata:</b> ' . $f_f . ' </span><br>
            </div>

    <table style="width:100%; border-collapse:collapse;" border="1">
        <thead>
            <tr bgcolor="orange">
            <th>#</th>
            <th>Fecha</th>
            <th>Proveedor</th>
            <th>Cantidad</th>
            <th>Tipo doc.</th> 
            <th>N° doc.</th> 
            <th>Total</th> 
            </tr>
        </thead>';

$consultacrias = 'SELECT
	ingreso.ingreso_id,
	ingreso.ingreso_fecha,
	proveedor.razon_social,
	ingreso.ingreso_impusto,
	ingreso.ingreso_cantidad,
	ingreso.ingreso_estado,
	ingreso.ingreso_porcentaje,
	ingreso.ingreso_ticomprobante,
	ingreso.ingreso_seriecomprobante,
	ingreso.ingreso_numcomrpobante,
	ingreso.ingreso_total,
	ingreso.ingreso_impuestototal 
    FROM
        ingreso
        INNER JOIN proveedor ON ingreso.proveedor_id = proveedor.proveedor_id 
    WHERE
	ingreso.ingreso_estado = "INGRESADO" 
	AND ingreso.ingreso_fecha BETWEEN ' . $f_i . ' AND ' . $f_f . '';

$contadromed = 0;
$sumar = 0;
//aqui estoy pidiendo la conexion y la consulta envio
$resultmedi = $mysqli->query($consultacrias);
while ($rowmedi = $resultmedi->fetch_assoc()) {

    $sumar += $rowmedi['ingreso_impuestototal'];
    $contadromed++;
    $html .= ' <tr>
                <td style="text-align:center;">' . $contadromed . '</td>
                <td style="text-align:center;">' . $rowmedi['ingreso_fecha'] . ' </td>
                <td style="text-align:center;">' . $rowmedi['razon_social'] . '</td>
                <td style="text-align:center;">' . $rowmedi['ingreso_cantidad'] . '</td>
                <td style="text-align:center;">' . $rowmedi['ingreso_ticomprobante'] . '</td>  
                <td style="text-align:center;">' . $rowmedi['ingreso_numcomrpobante'] . '</td>
                <td style="text-align:center;">$. ' . $rowmedi['ingreso_impuestototal'] . '</td>';
}

$html .= '</tr>
        <tbody>
        </tbody>
        </table><br>
        
        <div style="float:left; width:auto;">
        <span><b>Total:</b> $ ' .  number_format($sumar, 2) . ' </span>
        </div>';


//esto es para cambiar el tamaño de la hoja
$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
$mpdf->WriteHTML($html);
$mpdf->Output();
