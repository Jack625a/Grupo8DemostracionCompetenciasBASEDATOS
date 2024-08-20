<?php
    //Incluimos la conexion
    include 'conexion.php';

    //Consulta sql para obtener los jugadores con mas puntos ordenados de mayor a menor
    $sql="SELECT Nombre,Puntos FROM ranking ORDER BY puntos DESC";
    $resultado=$conexion->query($sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ranking</title>
</head>
<body>
    <h1>Tabla de Posiciones</h1>
    <table>
        <thead>
            <tr>
                <th>Posicion</th>
                <th>Nombre</th>
                <th>Puntos</th>
            </tr>
        </thead>
        <tbody>
            <?php
                //verifcamos que se tiene registro
                if($resultado->num_rows>0){
                    $posicion=1;
                    //Iterar en los registros obetenidos
                    while($fila=$resultado->fetch_assoc()){
                        echo "<tr>";
                        echo "<td>".$posicion."</td>";
                        echo "<td>".htmlspecialchars($fila['Nombre'])."</td>";
                        echo "<td>".$fila['Puntos']."</td>";
                        echo "</tr>";
                        $posicion++;

                    }
                }else{
                    echo "No hay registros";
                }
            ?>
        </tbody>
    </table>
</body>
</html>

<?php

$conexion->close();
?>