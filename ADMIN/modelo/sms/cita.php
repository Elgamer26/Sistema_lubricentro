<?php
require 'testAltiriaSms.php';
$envio = new testAltiriaSms();

$id = $_POST["id"];
//aqui llamo la nueva conexion
require_once "../conection/conections.php";

$sql = 'SELECT
cita.id_cita,
CONCAT_WS( " ", cliente.nombres, cliente.apellidos ) AS cliente,
cliente.telefono,
cita.title,
cita.descripcion,
cita.`start` as inicio,
cita.id_reserva 
FROM
cita
INNER JOIN cliente ON cita.cliente_id = cliente.id_cliente
WHERE
cita.id_reserva = "' . $id . '" ';

$result = $mysqli->query($sql);
$celular = "";
$sms = "";
while ($row = $result->fetch_assoc()) {
    $sms = 'LIBRICENTRO "DON GATO": Estimado cliente ' . $row['cliente'] . ', usted tiene una reserva para el dia ' . $row['inicio'] . ', motivo ' . $row['title'] . ', estar 30 minutos antes';
    $celular =  $row['telefono'];
}

$mobil =  substr($celular, 1);
$numero = '593' . $mobil;

// if ($numero != "" && $sms != "") {
//     $resultado = $envio->envio($numero, $sms);
//     echo $resultado;
//     exit();
// }
// exit();
