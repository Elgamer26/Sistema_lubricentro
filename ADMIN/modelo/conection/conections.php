<?php
$mysqli = new mysqli('localhost', 'root', 'elgamer1', 'don_gato');

if ($mysqli->connect_error) {
    die('error de conexion (' . $mysqli->connect_errno . ')'
        . $mysqli->connect_error);
}

if (mysqli_connect_error()) {
    die('error de conexion (' . $mysqli->connect_errno . ')'
        . $mysqli->connect_error);
}
