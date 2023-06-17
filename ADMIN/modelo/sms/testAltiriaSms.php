<?php

// XX, YY y ZZ se corresponden con los valores de identificacion del
// usuario en el sistema.
include('httpPHPAltiria.php');

$altiriaSMS = new AltiriaSMS();

class testAltiriaSms extends AltiriaSMS
{
    function envio($celular, $sms)
    {
        AltiriaSMS::setLogin('computacioneinformaticauae@gmail.com');
        AltiriaSMS::setPassword('uy5sg5qb');

        // AltiriaSMS::setLogin('eduardoaucancela2811@gmail.com');
        // AltiriaSMS::setPassword('nb397gdb');

        AltiriaSMS::setDebug(true);
        // $sDestination = '346xxxxxxxx';
        // $sDestination = '593985906677';
        // $sDestination = array('346xxxxxxxx','346yyyyyyyy');
        $response = AltiriaSMS::sendSMS($celular, $sms);
        if (!$response)
            echo "error";
        else
            echo "ok";
    }
}
