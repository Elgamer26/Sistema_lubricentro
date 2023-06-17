<?php
//llamos al autoload.php del mpdf
require_once __DIR__ . '/../../vendor/autoload.php';
//aqui llamo la nueva conexion
require_once "../../../modelo/conection/conections.php";


$consulta_ha = 'SELECT * FROM empresa';
$result_ha = $mysqli->query($consulta_ha);
$foto_ha = mysqli_fetch_assoc($result_ha);

     $html = '<img src="../../../' . $foto_ha['foto'] . '" style="width: 220px; float:left" height="90px" width="90px"> 
    <div style="text-align:center;"><h1><u>Reporte de proveedor</u></h1></div><br>';
   
    $html .= '<div style="width:700px; text-align:center;">
                   
            </div>
    <table style="width:100%; border-collapse:collapse;" border="1">
        <thead>
            <tr bgcolor="orange">
            <th>#</th>
            <th>Razon social</th>
            <th>Ruc</th>
            <th>Direccion</th>
            <th>Telefono</th> 
            <th>Correo</th> 
            </tr>
        </thead>';

    $consultacrias = 'SELECT
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
        proveedor 
    WHERE
        proveedor.estado = 1';

    $contadromed = 0; 

    //aqui estoy pidiendo la conexion y la consulta envio
    $resultmedi = $mysqli->query($consultacrias);
    while ($rowmedi = $resultmedi->fetch_assoc()) {

        $contadromed++;
        $html .= ' <tr>
               <td style="text-align:center;">' . $contadromed . '</td>
               <td style="text-align:center;">' . $rowmedi['razon_social'] . ' </td>
               <td style="text-align:center;">' . $rowmedi['ruc'] . '</td>
               <td style="text-align:center;">' . $rowmedi['proveedor_direccion'] . '</td>
               <td style="text-align:center;">' . $rowmedi['proveedor_telefono'] . '</td>  
               <td style="text-align:center;">' . $rowmedi['proveedor_correo'] . '</td>';
    }

    $html .= '</tr>
    <tbody>
    </tbody>
    </table>';
 
 
//esto es para cambiar el tamaño de la hoja
$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
$mpdf->WriteHTML($html);
$mpdf->Output();
