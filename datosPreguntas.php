<?php
    //Paso 1. Establecer la conexion
    include 'conexion.php';

    //Consulta SQL para mostrar las preguntas
    if(isset($_GET['nivel'])){
        $nivel=intval($_GET['nivel']);
        //Consulta sql
        $sql="SELECT * FROM preguntas WHERE nivel=1";
        $resultado=$conexion->query($sql);
        $preguntas=[];
        while($fila=$resultado->fetch_assoc()){
            $preguntas[]=$fila;
        }
        echo json_encode($preguntas);

    }
    $conexion->close()
?>