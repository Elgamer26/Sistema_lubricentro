<?php
//llamos al autoload.php del mpdf
require_once __DIR__ . '/../../vendor/autoload.php';
//aqui llamo la nueva conexion
require_once "../../../modelo/conection/conections.php";

$id = $_GET["id"];
$f_i = $_GET["f_i"];
$f_f = $_GET["f_f"];

$consulta = 'SELECT
empleado.id_empleado, 
empleado.nombres, 
empleado.apellidos, 
empleado.estado_civil, 
empleado.direccion, 
empleado.telefono, 
empleado.correo, 
empleado.fecha_n, 
empleado.sexo, 
empleado.cedula, 
empleado.nivel_es, 
empleado.totulo, 
empleado.experiencia, 
empleado.fech_i, 
empleado.id_cargo, 
cargo.tipo_cargo, 
empleado.valor_hora, 
empleado.estado,
CONCAT_WS( " ", empleado.nombres, empleado.apellidos ) AS empleado 
FROM
cargo
INNER JOIN
empleado
ON 
    cargo.id_cargo = empleado.id_cargo
WHERE empleado.id_empleado =  ' . $id . ' ';

$consulta_ha = 'SELECT * FROM empresa';
$result_ha = $mysqli->query($consulta_ha);
$foto_ha = mysqli_fetch_assoc($result_ha);

$result = $mysqli->query($consulta);
while ($row = $result->fetch_assoc()) {


    $html = '<img src="../../../' . $foto_ha['foto'] . '" style="width: 220px; float:left" height="90px" width="90px"> 
    <div style="text-align:center;"><h1><u>Reporte de empleado</u></h1></div><br>
   
    <div style="float:right; width:auto;">
    <span><b>Desde:</b>  ' . $f_i . ' - <b>Hata:</b> ' . $f_f . ' </span>
    </div>
    
    <div style="float:left; width:auto;">
    <span><b>Empleados:</b>  ' . $row['empleado'] . ' </span>
    </div>

    <div style="float:left; width:auto">
    <span><b>Direccion:</b> ' . $row['direccion'] . '  </span>
    </div>

    <div style="float:left; width:auto">
    <span><b>Telefono:</b> ' . $row['telefono'] . '  </span>
    </div>

    <div style="float:left; width:auto">
    <span><b>Correo:</b> ' . $row['correo'] . '  </span>
    </div>
    
    <div style="float:left; width:auto;">
    <span><b>Cedula:</b> ' . $row['cedula'] . ' </span>
    </div>

    <div style="float:left; width:auto;">
    <span><b>Cargo:</b> ' . $row['tipo_cargo'] . ' </span>
    </div>';


    $html .= '<div style="width:700px; text-align:center;">
                    <h2><u>Detalle rol de pagos</u></h2>
            </div>
    <table style="width:100%; border-collapse:collapse;" border="1">
        <thead>
            <tr bgcolor="orange">
            <th>#</th>
            <th>Fecha</th>
            <th>valor hora</th>
            <th>Monto</th>
            <th>Total ingreso</th>
            <th>Total egreso</th>
            <th>Total</th> 
            </tr>
        </thead>';

    $consultacrias = 'SELECT
	rol_pagos.id_rol_pagos,
	rol_pagos.id_empleado,
	DATE(rol_pagos.fecha_pago) as fecha_f,
	rol_pagos.valor_hora,
	rol_pagos.monto,
	rol_pagos.total_ingreso,
	rol_pagos.total_egreso,
	rol_pagos.txtneto_pagar,
	rol_pagos.estado 
    FROM
        rol_pagos 
    WHERE
	rol_pagos.estado = 1 
    AND rol_pagos.id_empleado = ' . $id . ' AND DATE(rol_pagos.fecha_pago) BETWEEN ' . $f_i . ' AND ' . $f_f . ' ';

    $contadromed = 0;
    $sumar = 0;

    //aqui estoy pidiendo la conexion y la consulta envio
    $resultmedi = $mysqli->query($consultacrias);
    while ($rowmedi = $resultmedi->fetch_assoc()) {

        $sumar += $rowmedi['txtneto_pagar'];

        $contadromed++;
        $html .= ' <tr>
               <td style="text-align:center;">' . $contadromed . '</td>
               <td style="text-align:center;">' . $rowmedi['fecha_f'] . ' </td>
               <td style="text-align:center;">' . $rowmedi['valor_hora'] . '</td>
               <td style="text-align:center;">' . $rowmedi['monto'] . '</td>
               <td style="text-align:center;">' . $rowmedi['total_ingreso'] . '</td>
               <td style="text-align:center;">' . $rowmedi['total_egreso'] . '</td>
               <td style="text-align:center;">' . $rowmedi['txtneto_pagar'] . '</td>';
    }

    $html .= '</tr>
    <tbody>
    </tbody>
    </table><br>

    
    <div style="float:left; width:auto;">
    <span><b>Total:</b> $ ' .  number_format($sumar, 2) . ' </span>
    </div>';
}

//esto es para cambiar el tamaño de la hoja
$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
$mpdf->WriteHTML($html);
$mpdf->Output();
