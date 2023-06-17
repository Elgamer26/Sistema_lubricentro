<?php
require_once 'modelo_conexion.php';
class modelo_empresa extends modelo_conexion
{
    ///esta fuencion se encargra traer los datos de la optica
    function traer_datos_optica($id)
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * FROM empresa WHERE id_empleda = ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $id);
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_BOTH);
            $arreglo = array();
            foreach ($result as $respuesta) {
                $arreglo[] = $respuesta;
            }
            return $arreglo;
            //cerramos la conexion
            modelo_conexion::cerrar_conexion();
        } catch (Exception $e) {
            modelo_conexion::cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function ediatar_imagen_optica($id, $ruta)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_a = "UPDATE empresa SET foto = ? WHERE id_empleda = ?";
            $querya = $c->prepare($sql_a);

            $querya->bindParam(1, $ruta);
            $querya->bindParam(2, $id);

            if ($querya->execute()) {
                $res = 1; // SE UPDATE CORRECTAMENTE
            } else {
                $res = 0; // FALLO EN LA MATRIX
            }

            return $res;

            //cerramos la conexion
            modelo_conexion::cerrar_conexion();
        } catch (Exception $e) {
            modelo_conexion::cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

        function editar_empresa_optica($id, $haci_nombre, $Direccion, $Telefono, $Ruc, $email, $fecha_fun, $lema, $Actividad)
        {
            try {
                $res = "";
                $c = modelo_conexion::conexionPDO();
                $sql_a="UPDATE empresa SET nombre = ?, direccion = ?, telefono = ?, ruc = ?, email = ?, fecha = ?, lema = ?, atividad = ? WHERE id_empleda = ?";
                $querya = $c->prepare($sql_a);    
                $querya->bindParam(1, $haci_nombre);
                $querya->bindParam(2, $Direccion);
                $querya->bindParam(3, $Telefono);
                $querya->bindParam(4, $Ruc);
                $querya->bindParam(5, $email);
                $querya->bindParam(6, $fecha_fun);
                $querya->bindParam(7, $lema);
                $querya->bindParam(8, $Actividad);
                $querya->bindParam(9, $id);
    
                if ($querya->execute()) {
                    $res = 1; // SE UPDATE CORRECTAMENTE
                } else {
                    $res = 0; // FALLO EN LA MATRIX
                }
    
                return $res;
    
                //cerramos la conexion
                // modelo_conexion::cerrar_conexion();
            } catch (Exception $e) {
                // modelo_conexion::cerrar_conexion();
                echo "Error: " . $e->getMessage();
            }
            exit();
        }
}
