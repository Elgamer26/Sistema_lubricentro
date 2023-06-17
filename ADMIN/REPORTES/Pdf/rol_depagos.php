<?php
//llamos al autoload.php del mpdf
require_once __DIR__ . '/../vendor/autoload.php';
//aqui llamo la nueva conexion
require_once "../../modelo/conection/conections.php";

$consulta = 'SELECT
            rol_pagos.id_rol_pagos,
            rol_pagos.id_empleado,
            empleado.nombres,
            empleado.apellidos,
            empleado.direccion,
            empleado.telefono,
            empleado.correo,
            empleado.sexo,
            empleado.cedula,
            rol_pagos.fecha_pago,
            rol_pagos.valor_hora,
            rol_pagos.monto,
            rol_pagos.total_ingreso,
            rol_pagos.total_egreso,
            rol_pagos.txtneto_pagar,
            rol_pagos.estado 
            FROM
            rol_pagos
            INNER JOIN empleado ON rol_pagos.id_empleado = empleado.id_empleado 
            WHERE rol_pagos.id_rol_pagos =  "' . $_GET["id"] . '" ';

$consulta_ha = 'SELECT * FROM empresa';
$result_ha = $mysqli->query($consulta_ha);
$foto_ha = mysqli_fetch_assoc($result_ha);

$result = $mysqli->query($consulta);
$fecha = date("Y-m-d");
while ($row = $result->fetch_assoc()) {


    $html = '<img src="../../' . $foto_ha['foto'] . '" style="width: 220px; float:left" height="90px" width="90px"> 
    <div style="text-align:center;"><h1><u>ROL DE PAGOS</u></h1></div><br>
   
    <div style="float:right; width:auto;">
    <span><b>Fecha imprimir:</b>  ' . $fecha . '   </span>
    </div>
       
    <div style="float:left; width:auto">
    <span><b>Nombres:</b> ' . $row['nombres'] . ' ' . $row['apellidos'] . '  </span>
    </div>

    <div style="float:left; width:auto">
    <span><b>Direccion:</b> ' . $row['direccion'] . '  </span>
    </div>
    
    <div style="float:left; width:auto;">
    <span><b>Correo:</b>  ' . $row['correo'] . ' </span>
    </div>

    <div style="float:left; width:auto;">
    <span><b>Cedula:</b> ' . $row['cedula'] . ' </span>
    </div>

    <div style="float:left; width:auto;">
    <span><b>Telefono:</b> ' . $row['telefono'] . ' </span>
    </div>

    <div style="float:left; width:auto;">
    <span><b>Fecha rol de pagos:</b> ' . $row['fecha_pago'] . '  </span>
    </div>
    
    <div style="float:left; width:auto;">
    <span><b>Total pago:</b> $. ' . $row['txtneto_pagar'] . '  </span>
    </div>
    
    <div style="width:700px; text-align:center;">
        <h2><u>Detalle ingreso</u></h2>
        </div>

            <table style="width:100%; border-collapse:collapse;" border="1">
        <thead>
             <tr bgcolor="green">
                <th>#</th>
                <th>Nombre</th>
                <th>Cantidad</th>
            </tr>
        </thead>';

    $consultacrias = 'SELECT
                    detalle_rol_pago_ingreso.id_detalle_ingreso, 
                    detalle_rol_pago_ingreso.id_rol_pagos, 
                    detalle_rol_pago_ingreso.nombre, 
                    detalle_rol_pago_ingreso.cantidad, 
                    detalle_rol_pago_ingreso.estado
                    FROM
                    detalle_rol_pago_ingreso 
                    WHERE detalle_rol_pago_ingreso.id_rol_pagos = "' . $_GET["id"] . '" ';

    $contadromed = 0;
    $subtotal_ingreso = 0;


    //aqui estoy pidiendo la conexion y la consulta envio
    $resultmedi = $mysqli->query($consultacrias);

    while ($rowmedi = $resultmedi->fetch_assoc()) {

        $subtotal_ingreso += $rowmedi['cantidad'];

        $contadromed++;
        $html .= ' <tr>
               <td style="text-align:center;">  ' . $contadromed . '</td>
               <td style="text-align:center;">  ' . $rowmedi['nombre'] . '</td>
               <td style="text-align:center;"> $. ' . $rowmedi['cantidad'] . '</td>';
    }

    $html .= '</tr>
    <tbody>
    </tbody>
    </table><br>
    
    <div style="float:left; width:auto;">
    <span><b>Total:</b> $. ' .  number_format($subtotal_ingreso, 2, '.', '') . ' </span>
    </div>
    
    
    <div style="width:700px; text-align:center;">
        <h2><u>Detalle egreso</u></h2>
        </div>

            <table style="width:100%; border-collapse:collapse;" border="1">
        <thead>
             <tr bgcolor="red">
                <th>#</th>
                <th>Nombre</th>
                <th>Cantidad</th>
            </tr>
        </thead>';

    $consultacrias = 'SELECT
                    detalle_rol_pago_egreso.id_detalle_egreso, 
                    detalle_rol_pago_egreso.id_rol_pagos, 
                    detalle_rol_pago_egreso.nombre, 
                    detalle_rol_pago_egreso.cantidad
                FROM
                    detalle_rol_pago_egreso WHERE detalle_rol_pago_egreso.id_rol_pagos = "' . $_GET["id"] . '" ';

    $contadromed = 0;
    $subtotal_egreso = 0;


    //aqui estoy pidiendo la conexion y la consulta envio
    $resultmedi = $mysqli->query($consultacrias);

    while ($rowmedi = $resultmedi->fetch_assoc()) {

        $subtotal_egreso += $rowmedi['cantidad'];

        $contadromed++;
        $html .= ' <tr>
               <td style="text-align:center;"> ' . $contadromed . '</td>
               <td style="text-align:center;"> ' . $rowmedi['nombre'] . '</td>
               <td style="text-align:center;"> $. ' . $rowmedi['cantidad'] . '</td>';
    }

    $html .= '</tr>
    <tbody>
    </tbody>
    </table><br>
    
    <div style="float:left; width:auto;">
    <span><b>Total:</b> $. ' .  number_format($subtotal_egreso, 2, '.', '') . ' </span>
    </div>
    
    <br>

    <table style="width:100%; border-collapse:collapse;" border="1">
        <thead>
            <tr bgcolor="orange">
                <th>$. ' . $subtotal_ingreso . ' - $. ' . $subtotal_egreso . ' = $. ' . $subtotal_ingreso - $subtotal_egreso . '</th> 
            </tr>
        </thead>
    </table>';
}

//esto es para cambiar el tamaño de la hoja
$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
$mpdf->WriteHTML($html);
$mpdf->Output();
 