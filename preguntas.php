<?php
    //Sesion del usuario
    session_start();
    if(!isset($_SESSION['idUsuario'])){
        die ('Bienvenido participante');
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preguntas</title>
</head>
<body>
    <h1>Juego de trivias - Medicina</h1>
    <div id="contenedor-preguntas">

    </div>
    <div id="contenedor-nivel">

    </div>

    <button id="siguientePregunta">Siguiente</button>
    
</body>
<script>
    document.addEventListener('DOMContentLoaded',()=>{
        //Variables para el manejo de las preguntas
        let nivelActual=1;
        let preguntaActual=0;
        let preguntas=[];

        const contenedorPreguntas=document.getElementById('contenedor-preguntas');
        const contenedorNivel=document.getElementById('contenedor-nivel');
        const botonSiguiente=document.getElementById('siguientePregunta');

    function cargarPreguntas(){
        fetch('datosPreguntas.php?nivel='+nivelActual)
        .then
    }
    });
    //Creacion de la funcion para mostrar Preguntas
</script>
</html>