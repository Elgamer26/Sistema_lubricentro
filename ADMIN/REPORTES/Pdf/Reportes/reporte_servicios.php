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
    <div style="text-align:center;"><h1><u>Reporte de servicios</u></h1></div><br>';

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
            <th>Servicio</th>
            <th>Cantidad</th>
            <th>Precio</th> 
            <th>Descuento</th> 
            <th>Total</th> 
            </tr>
        </thead>';

$consultacrias = 'SELECT
	detalle_servicios_cliente.id_detalle_sericios,
	detalle_servicios_cliente.id_servicio_cliente,
	servicio.servicio,
	detalle_servicios_cliente.cantidad,
	detalle_servicios_cliente.precio,
	detalle_servicios_cliente.descuento,
	detalle_servicios_cliente.subtotal,
	servicio_cliente.fecha,
	servicio_cliente.estado 
    FROM
        detalle_servicios_cliente
        INNER JOIN servicio ON detalle_servicios_cliente.id_servicio = servicio.id_servicio
        INNER JOIN servicio_cliente ON detalle_servicios_cliente.id_servicio_cliente = servicio_cliente.id_servicio_cliente 
    WHERE
	servicio_cliente.estado = 1 AND servicio_cliente.fecha BETWEEN ' . $f_i . ' AND ' . $f_f . ' ';

$contadromed = 0;
$sumar = 0;
//aqui estoy pidiendo la conexion y la consulta envio
$resultmedi = $mysqli->query($consultacrias);
while ($rowmedi = $resultmedi->fetch_assoc()) {

    $sumar += $rowmedi['subtotal'];
    $contadromed++;
    $html .= ' <tr>
               <td style="text-align:center;">' . $contadromed . '</td>
               <td style="text-align:center;">' . $rowmedi['fecha'] . '  </td> 
               <td style="text-align:center;">' . $rowmedi['servicio'] . '</td>
               <td style="text-align:center;">' . $rowmedi['cantidad'] . '</td>  
               <td style="text-align:center;">' . $rowmedi['precio'] . '</td>  
               <td style="text-align:center;">' . $rowmedi['descuento'] . '</td>
               <td style="text-align:center;">' . $rowmedi['subtotal'] . '</td>';
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
