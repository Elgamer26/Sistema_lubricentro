<?php
//llamos al autoload.php del mpdf
require_once __DIR__ . '/../vendor/autoload.php';
//aqui llamo la nueva conexion
require_once "../../modelo/conection/conections.php";

$consulta = 'SELECT
            servicio_cliente.id_servicio_cliente,
            CONCAT_WS( " ", cliente.nombres, cliente.apellidos ) AS cliente,
            cliente.cedula,
            CONCAT_WS( " ", "Vehiculo: ", vehiculo.vehiculo, " - Marca: ", marca_vehiculo.marca, " - Matricula: ", vehiculo_cliente.matrcula, " - Color: ", vehiculo_cliente.color ) AS vehiculo,
            servicio_cliente.inpuesto,
            servicio_cliente.tipo_comprobante,
            servicio_cliente.num_compro,
            servicio_cliente.fecha,
            servicio_cliente.total_servico,
            servicio_cliente.totalneto_pro,
            servicio_cliente.impuesto_pro,
            servicio_cliente.total_pago_pro,
            servicio_cliente.estado,
            servicio_cliente.tipo_pago 
            FROM
            servicio_cliente
            INNER JOIN vehiculo_cliente ON servicio_cliente.id_vehiculo_cliente = vehiculo_cliente.id_clie_vehi
            INNER JOIN cliente ON vehiculo_cliente.cliente = cliente.id_cliente
            INNER JOIN vehiculo ON vehiculo_cliente.tipo_vehoculo = vehiculo.id_vehiculo
            INNER JOIN marca_vehiculo ON vehiculo_cliente.tipo_marca = marca_vehiculo.id_marca 
            WHERE
            servicio_cliente.id_servicio_cliente =  "' . $_GET["id"] . '" ';

$consulta_ha = 'SELECT * FROM empresa';
$result_ha = $mysqli->query($consulta_ha);
$foto_ha = mysqli_fetch_assoc($result_ha);

$result = $mysqli->query($consulta);
$fecha = date("Y-m-d");
while ($row = $result->fetch_assoc()) {


    $html = '<img src="../../' . $foto_ha['foto'] . '" style="width: 220px; float:left" height="90px" width="90px"> 
    <div style="text-align:center;"><h1><u>Factura de servicio</u></h1></div><br>
   
    <div style="float:right; width:auto;">
    <span><b>Fecha:</b>  ' . $row['fecha'] . '   </span>
    </div>
       
    <div style="float:left; width:auto">
    <span><b>Cliente:</b> ' . $row['cliente'] . '  </span>
    </div>

    <div style="float:left; width:auto">
    <span><b>Cedula:</b> ' . $row['cedula'] . '  </span>
    </div>
    
    <div style="float:left; width:auto;">
    <span><b>Vehiculo:</b>  ' . $row['vehiculo'] . ' </span>
    </div>

    <div style="float:left; width:auto;">
    <span><b>Tipo documento:</b>  ' . $row['tipo_comprobante'] . ' </span>
    </div>

    <div style="float:left; width:auto;">
    <span><b>N° documento:</b> ' . $row['num_compro'] . ' </span>
    </div>
    
    <div style="float:left; width:auto;">
    <span><b>Tipo de pago:</b> ' . $row['tipo_pago'] . ' </span>
    </div>';

    if ($row['estado'] != 1) {

        $html .= ' <center>
        <h2>
            <div style="width:700px; text-align:center;">
                <span style="color:red;"></b> EL SERVICIO FUE ANULADO </span>
            </div>
        </h2>
    </center>';
    }

    $html .= '<div style="width:700px; text-align:center;">
        <h2><u>Detalle servicio</u></h2>
        </div>

            <table style="width:100%; border-collapse:collapse;" border="1">
        <thead>
             <tr bgcolor="orange">
                <th>#</th>
                <th>Servicio</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Desc. moneda</th>
                <th>Total</th>
            </tr>
        </thead>';

    $consultacrias = 'SELECT
    detalle_servicios_cliente.id_detalle_sericios,
    detalle_servicios_cliente.id_servicio_cliente,
    servicio.servicio,
    detalle_servicios_cliente.precio,
    detalle_servicios_cliente.cantidad,
    detalle_servicios_cliente.descuento,
    detalle_servicios_cliente.subtotal 
    FROM
        detalle_servicios_cliente
        INNER JOIN servicio ON detalle_servicios_cliente.id_servicio = servicio.id_servicio 
    WHERE
    detalle_servicios_cliente.id_servicio_cliente = "' . $_GET["id"] . '" ';

    $contadromed = 0;
    //aqui estoy pidiendo la conexion y la consulta envio
    $resultmedi = $mysqli->query($consultacrias);

    while ($rowmedi = $resultmedi->fetch_assoc()) {

        $contadromed++;
        $html .= ' <tr>
               <td style="text-align:center;">  ' . $contadromed . '</td>
               <td style="text-align:center;">  ' . $rowmedi['servicio'] . ' </td>
               <td style="text-align:center;">  ' . $rowmedi['precio'] . '</td>
               <td style="text-align:center;">  ' . $rowmedi['cantidad'] . '</td>
               <td style="text-align:center;">  ' . $rowmedi['descuento'] . '</td> 
               <td style="text-align:center;"> $. ' . $rowmedi['subtotal'] . '</td>';
    }

    $html .= '</tr>
    <tbody>
    </tbody>
    </table><br>
    
    <div style="float:left; width:auto;">
    <span><b>Total:</b> $. ' . $row['total_servico'] . ' </span>
    </div>
    
    
    
    <div style="width:700px; text-align:center;">
        <h2><u>Detalle producto</u></h2>
        </div>

            <table style="width:100%; border-collapse:collapse;" border="1">
        <thead>
             <tr bgcolor="orange">
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

    $consultacrias = 'SELECT
    detalle_servicio_producto.id_detalle_poducto_servcios,
    detalle_servicio_producto.id_servicio_cliente,
    producto.producto_nombre,
    tipo_producto.tipo_producto,
    marca.marca,
    detalle_servicio_producto.cantidad,
    detalle_servicio_producto.precio,
    detalle_servicio_producto.descuento_oferta,
    detalle_servicio_producto.tipo_promo,
    detalle_servicio_producto.descuento_moneda,
    detalle_servicio_producto.subtotal 
    FROM
        detalle_servicio_producto
        INNER JOIN producto ON detalle_servicio_producto.producto_id = producto.id_producto
        INNER JOIN tipo_producto ON producto.tipo_producto_id = tipo_producto.id_tipo_producto
        INNER JOIN marca ON producto.marca_producto_id = marca.id_marca 
    WHERE
    detalle_servicio_producto.id_servicio_cliente = "' . $_GET["id"] . '" ';

    $contadromed = 0;
    //aqui estoy pidiendo la conexion y la consulta envio
    $resultmedi = $mysqli->query($consultacrias);

    while ($rowmedi = $resultmedi->fetch_assoc()) {

        $contadromed++;
        $html .= ' <tr>
               <td style="text-align:center;">  ' . $contadromed . '</td>
               <td style="text-align:center;">  ' . $rowmedi['producto_nombre'] . ' ' . $rowmedi['tipo_producto'] . ' ' . $rowmedi['marca'] . ' </td>
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
    <span><b>Subtotal:</b> $. ' . $row['totalneto_pro'] . ' </span>
    </div>
    
    <div style="float:left; width:auto;">
    <span><b>Impuesto ' . $row['inpuesto'] . ' % :</b> $. ' . $row['impuesto_pro'] . ' </span>
    </div>
    
    <div style="float:left; width:auto;">
    <span><b>Total:</b> $. ' . $row['total_pago_pro'] . ' </span>
    </div>';
}

//esto es para cambiar el tamaño de la hoja
$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
$mpdf->WriteHTML($html);
$mpdf->Output();
