<?php
// Variables para la conexion
$host='localhost';
$usuario='root';
$contraseña='';
$nombreDb='demostracioncompetenciasdb';

//Creacion de la conexion
$conexion=new mysqli($host,$usuario,$contraseña,$nombreDb);

//Verificacion de la conexion
if (!$conexion){
    die ("Conexion fallida: ".mysqli_connect_error());
}
?>