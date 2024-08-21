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
<style>
        /* Estilos Generales */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f0f8ff;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #2c3e50;
        }

        h1 {
            color: #2980b9;
            font-size: 2.5em;
            margin-bottom: 20px;
            text-align: center;
            animation: fadeInDown 1s ease-in-out;
        }

        table {
            width: 80%;
            max-width: 600px;
            margin: 0 auto;
            border-collapse: collapse;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            background-color: #ecf0f1;
            border-radius: 10px;
            overflow: hidden;
            animation: fadeInUp 1s ease-in-out;
        }

        thead {
            background-color: #2980b9;
            color: white;
        }

        th, td {
            padding: 15px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        tbody tr:nth-child(even) {
            background-color: #bdc3c7;
        }

        tbody tr:hover {
            background-color: #95a5a6;
            color: white;
            transform: scale(1.02);
            transition: background-color 0.3s, transform 0.3s;
        }

        /* Animaciones */
        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
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