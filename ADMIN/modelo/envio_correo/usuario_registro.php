<?php
require 'envio_correo.php';
$ME_CO = new envio_correo();

//cambiar por la direccion del hosting
$location = "http://localhost:8080/PROYECTO_TESIS/";

$correo = $_POST["correo"];

//aqui llamo la nueva conexion
require_once "../conect/conect_r.php";
$consula_correo = 'SELECT * FROM cliente WHERE cliente_correo = "' . $correo . '"';
$resulta_correo = $mysqli->query($consula_correo);
$count = mysqli_num_rows($resulta_correo);

if ($count == 0) {

    $html = '<!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>

    <table style="border: 1px solid black; width: 100%; height: 258px;">
    <thead>
    <tr style="height: 73px;">
    <td style="text-align: center; background: red; color: white; height: 73px;" colspan="2">
    <h1><strong>.:Crear usuario:.</strong></h1>
    </td>
    </tr>
    <tr style="height: 188px;">
    <td style="height: 134px; text-align: center;" width="20%"><strong>Estimado cliente, se le a enviado por este medio el formulario de registro para su cuenta de usuario del sistema web de la Optica kairos, cree un usuario para poder acceder al sistema y separar sus citas, comprar en linea, para mas informacion comuniquese con la Optica a traves de los numeros de telefono que se encuentran en la paquina web de la Optica, gracias por confiar en nosotros :)</strong></td>
    </tr>
    <tr style="height: 188px;">
    <td style="height: 51px; text-align: center;" width="20%"><a href=' . $location . 'CART_OPT/register/registro_cliente.php?crr=' . $correo . '>Link para crear usuario de cliente.</a></td>
    </tr>
    </thead>
    </table>

    </body>
    </html>';

    $sms = "Registro de usuario/cliente";
    $resultado = $ME_CO->enviar_correo($correo, $html, $sms);
    echo $resultado;
    exit();
} else {
    echo 10;
    exit();
}
