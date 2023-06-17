<?php
//llamos al autoload.php del mpdf
require_once __DIR__ . '/../../vendor/autoload.php';
//aqui llamo la nueva conexion
require_once "../../../modelo/conection/conections.php";

$consulta_ha = 'SELECT * FROM empresa';
$result_ha = $mysqli->query($consulta_ha);
$foto_ha = mysqli_fetch_assoc($result_ha);

$html = '<img src="../../../' . $foto_ha['foto'] . '" style="width: 220px; float:left" height="90px" width="90px"> 
    <div style="text-align:center;"><h1><u>Reporte de productos</u></h1></div><br>';

$html .= '<div style="width:700px; text-align:center;">
          </div>

      <table style="width:100%; border-collapse:collapse;" border="1">
        <thead>
                <tr bgcolor="orange">
                    <th>#</th>
                    <th>Codigo</th> 
                    <th>Producto</th> 
                    <th>Tipo</th>
                    <th>Marca</th>
                    <th>Precio venta</th> 
                    <th>Stock</th>  
                </tr>
        </thead>';

$consultacrias = 'SELECT
                    producto.poducto_codigo,
                    producto.producto_nombre,
                    tipo_producto.tipo_producto,
                    marca.marca,
                    producto.producto_precio_venta,
                    producto.estado,
                    producto.producto_destacar,
                    producto._eliminado,
                    producto.stock 
                    FROM
                    producto
                    INNER JOIN marca ON producto.marca_producto_id = marca.id_marca
                    INNER JOIN tipo_producto ON producto.tipo_producto_id = tipo_producto.id_tipo_producto 
                    WHERE
                    producto._eliminado = 1 AND producto.marca_producto_id = ' . $_GET["id"] . ' ';

$contadromed = 0;
$sumar = 0;
//aqui estoy pidiendo la conexion y la consulta envio
$resultmedi = $mysqli->query($consultacrias);
while ($rowmedi = $resultmedi->fetch_assoc()) {

    $sumar += $rowmedi['subtotal'];
    $contadromed++;
    $html .= ' <tr>
               <td style="text-align:center;">' . $contadromed . '</td>
               <td style="text-align:center;">' . $rowmedi['poducto_codigo'] . '  </td> 
               <td style="text-align:center;">' . $rowmedi['producto_nombre'] . '  </td> 
               <td style="text-align:center;">' . $rowmedi['tipo_producto'] . '</td>
               <td style="text-align:center;">' . $rowmedi['marca'] . '</td>   
               <td style="text-align:center;">$. ' . $rowmedi['producto_precio_venta'] . '</td>
               <td style="text-align:center;">' . $rowmedi['stock'] . '</td>';
}

$html .= '</tr>
    <tbody>
    </tbody>
    </table>';


//esto es para cambiar el tamaño de la hoja
$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
$mpdf->WriteHTML($html);
$mpdf->Output();
