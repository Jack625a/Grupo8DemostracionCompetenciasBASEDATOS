<?php
    include 'conexion.php';

    if(isset($_GET['nivel'])){
        $nivel = intval($_GET['nivel']);
        $sql = "SELECT * FROM preguntas WHERE nivel = $nivel";
        $resultado = $conexion->query($sql);

        $preguntas = [];
        while($fila = $resultado->fetch_assoc()){
            $preguntas[] = $fila;
        }
        echo json_encode($preguntas);
    }

    $conexion->close(); // Asegúrate de cerrar la conexión correctamente
?>
