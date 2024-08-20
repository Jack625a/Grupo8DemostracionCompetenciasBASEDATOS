<?php
    //Incluimos la conexion
    include 'conexion.php';

    $data=json_decode(file_get_contents('php://input'),true);
    if(isset($data['nombre'])&& isset($data['puntos'])){
        $nombre=$conexion->real_escape_string($data['nombre']);
        $puntos=intval($data['puntos']);

        $sql="INSERT INTO ranking (Nombre, Puntos) VALUES ($nombre, $puntos)";
        if($conexion->query($sql)===TRUE){
            echo "Puntos Guardados Correctamente ";
        }else{
            echo "Error al guardar los puntos";
        }
    }else{
        echo "Datos incompletos";
    }

    $conexion->close();
?>