<?php
//llamos al autoload.php del mpdf
require_once __DIR__ . '/../../vendor/autoload.php';
//aqui llamo la nueva conexion
require_once "../../../modelo/conection/conections.php";


$consulta_ha = 'SELECT * FROM empresa';
$result_ha = $mysqli->query($consulta_ha);
$foto_ha = mysqli_fetch_assoc($result_ha);

     $html = '<img src="../../../' . $foto_ha['foto'] . '" style="width: 220px; float:left" height="90px" width="90px"> 
    <div style="text-align:center;"><h1><u>Reporte de empleado</u></h1></div><br>';
   
    $html .= '<div style="width:700px; text-align:center;">
                   
            </div>
    <table style="width:100%; border-collapse:collapse;" border="1">
        <thead>
            <tr bgcolor="orange">
            <th>Nombres</th> 
            <th>Sexo</th> 
            <th>Cedula</th>
            <th>Direccion</th>
            <th>Telefono</th> 
            <th>Correo</th> 
            <th>Carga</th> 
            <th>Valor/hora</th> 
            </tr>
        </thead>';

    $consultacrias = 'SELECT
	empleado.nombres,
	empleado.apellidos,
	empleado.direccion,
	empleado.telefono,
	empleado.correo,
	empleado.sexo,
	empleado.cedula,
	empleado.fech_i,
	cargo.tipo_cargo,
	empleado.valor_hora,
	empleado.estado,
	empleado.estado_civil,
	empleado.fecha_n 
    FROM
        empleado
        INNER JOIN cargo ON empleado.id_cargo = cargo.id_cargo 
    WHERE
	empleado.estado = 1';

    $contadromed = 0; 

    //aqui estoy pidiendo la conexion y la consulta envio
    $resultmedi = $mysqli->query($consultacrias);
    while ($rowmedi = $resultmedi->fetch_assoc()) {

        $contadromed++;
        $html .= ' <tr>
               <td style="text-align:center;">' . $rowmedi['nombres'] . ' ' . $rowmedi['apellidos'] . ' </td> 
               <td style="text-align:center;">' . $rowmedi['sexo'] . ' </td> 
               <td style="text-align:center;">' . $rowmedi['cedula'] . '</td>
               <td style="text-align:center;">' . $rowmedi['direccion'] . '</td>  
               <td style="text-align:center;">' . $rowmedi['telefono'] . '</td>
               <td style="text-align:center;">' . $rowmedi['correo'] . '</td>
               <td style="text-align:center;">' . $rowmedi['tipo_cargo'] . '</td>
               <td style="text-align:center;">$.' . $rowmedi['valor_hora'] . '</td>';
    }

    $html .= '</tr>
    <tbody>
    </tbody>
    </table>';
 
 
//esto es para cambiar el tamaño de la hoja
$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
$mpdf->WriteHTML($html);
$mpdf->Output();
