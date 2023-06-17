<?php
require '../../modelo/modelo_servicio.php';
$MC = new modelo_servicio();
$data = $MC->listar_calendario();
//jason encode para retornar los datos
echo json_encode($data, JSON_UNESCAPED_UNICODE);
?>