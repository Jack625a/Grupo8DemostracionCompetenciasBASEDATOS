<?php
/*    session_start();
    if(!isset($_SESSION['idUsuario'])){
        echo 'Bienvenido participante';
        exit();
    }*/
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preguntas</title>
</head>
<body>
<style>
        /* Estilos Generales */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #e0f7fa; /* Fondo azul claro */
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        h1 {
            color: #00796b; /* Verde oscuro */
            font-size: 2.5em;
            margin-bottom: 20px;
            text-align: center;
            animation: fadeInDown 1s ease-in-out;
        }

        #contenedor-preguntas, #contenedor-opciones, #contenedor-nivel, #contendor-puntos {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.3);
            margin-bottom: 15px;
            width: 80%;
            max-width: 600px;
            animation: fadeInUp 1s ease-in-out;
        }

        p {
            font-size: 1.2em;
            color: #00796b;
            margin: 10px 0;
        }

        label {
            font-size: 1.1em;
            color: #004d40;
        }

        input[type="radio"] {
            margin-right: 10px;
        }

        button {
            background-color: #00796b;
            color: white;
            padding: 15px 30px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1.2em;
            margin: 10px;
            transition: background-color 0.3s, transform 0.3s;
        }

        button:hover {
            background-color: #004d40;
            transform: scale(1.05);
        }

        #siguientePregunta, #salir {
            margin-top: 20px;
            width: 150px;
            animation: bounce 2s infinite;
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

        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {
                transform: translateY(0);
            }
            40% {
                transform: translateY(-10px);
            }
            60% {
                transform: translateY(-5px);
            }
        }

        /* Estilo para el contenedor de preguntas */
        #contenedor-preguntas {
            border-left: 5px solid #00796b;
            border-right: 5px solid #00796b;
        }

        /* Estilo para las opciones */
        #contenedor-opciones {
            display: flex;
            flex-direction: column;
        }

        #contenedor-opciones label {
            display: flex;
            align-items: center;
            padding: 10px;
            border-radius: 5px;
            background-color: #b2dfdb;
            margin-bottom: 10px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        #contenedor-opciones label:hover {
            background-color: #80cbc4;
        }

        /* Estilo para el contenedor de puntos */
        #contendor-puntos {
            font-size: 1.5em;
            color: #00796b;
            font-weight: bold;
        }

    </style>
    <h1>Juego de trivias - Medicina</h1>
    <audio id="sonido-fondo" loop>
        <source src="correcto.mp3" type="audio/mp3">
    </audio>
    <script>
        window.onload=function(){
            var sonido=document.getElementById('sonido-fondo');
            sonido.play();
        };
    </script>
    <div id="contenedor-preguntas"></div>
    <div id="contenedor-opciones"></div>
    <div id="contenedor-nivel"></div>
    <div id="contendor-puntos"></div>
    <button id="siguientePregunta">Siguiente</button>
    <button id="salir">Salir</button>
</body>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        let nivelActual = 1;
        let preguntaActual = 0;
        let preguntas = [];
        let puntos=0;
        const puntosMinimos=[0,180,360,540] //Puntos minimos para pasar de nivel
        //alert (puntosMinimos[nivelActual]);
        const contenedorPreguntas = document.getElementById('contenedor-preguntas');
        const contenedorNivel = document.getElementById('contenedor-nivel');
        const botonSiguiente = document.getElementById('siguientePregunta');
        const contenedorOpciones=document.getElementById('contenedor-opciones');
        const contenedorPuntos=document.getElementById('contendor-puntos');
        const botonSalir=document.getElementById('salir')

        function cargarPreguntas() {
            console.log('Cargando preguntas para el nivel:', nivelActual); 

            fetch('datospreguntas.php?nivel=' + nivelActual)
                .then(response => {
                    //console.log('Respuesta del servidor:', response);
                    if (!response.ok) {
                        throw new Error('Error al cargar las preguntas: ' + response.statusText);
                    }
                    return response.json();
                })
                .then(data => {
                    //console.log('Preguntas recibidas:', data); 
                    preguntas = data;
                    mostrarPregunta();
                })
                .catch(error => {
                    console.error('Error:', error);
                    contenedorPreguntas.innerHTML = `<p>Error al cargar las preguntas.</p>`;
                });
        }

        function mostrarPregunta() {
            if (preguntaActual < preguntas.length) {
                let pregunta=preguntas[preguntaActual];
                contenedorPreguntas.innerHTML = `<p>${preguntas[preguntaActual].pregunta}</p>`;
                contenedorNivel.innerHTML = `<p>Nivel ${nivelActual}</p>`;
                mostrarOpciones(pregunta);
            } else {
                contenedorPreguntas.innerHTML = `<p>¡Has completado este nivel!</p>`;
                contenedorOpciones.innerHTML='';
            }
        }
        //Funcion para mostrar las opciones de cada pregunta
        function mostrarOpciones(pregunta){
            contenedorOpciones.innerHTML='';
            for(let i=1; i<=4;i++){
                let opcion=pregunta['opcion'+i];
                //console.log(opcion)
                contenedorOpciones.innerHTML += `
                <label>
                <input type="radio" name="opcion" value="${i}">
                ${opcion}  
                </label>
                <br>`;
           }
        }
        //Funcion para verificar la resupuesta correcta
        function verificarRespuesta(){
            const opciones=document.getElementsByName('opcion');
            let seleccion=null;
            opciones.forEach(opcion=>{
                if(opcion.checked){
                    seleccion=parseInt(opcion.value);
                    //console.log("Opcion seleccionada por el usuario: "+seleccion);
                }
            });
            if(seleccion!== null){
                let respuestaCorrecta=preguntas[preguntaActual].rsepuesta //Cambiar a la variable de respuesta que pusieron en su base de datos;
                //console.log("Opcion Correcta "+respuestaCorrecta)
                //console.log(seleccion===parseInt(respuestaCorrecta))
                    if(seleccion === parseInt(respuestaCorrecta)){
                    //Asignacion de puntos por respuesta correcta
                       
                    
                    puntos+=10;
                }
            }else{
                alert("Seleccione una opcion para continuar ");
                return false;
            }
        contenedorPuntos.innerHTML=`<p>Puntos: ${puntos}</p>`;
        //console.log(puntos);
        return true;
        }

        //Funcion para verificar la cantidad de Puntos para el siguiente nivel
        function verificarPuntos(){
        
            if(puntos<puntosMinimos[nivelActual]){
                alert("Nos alcanzaste los "+puntosMinimos[nivelActual]+ " puntos necesarios para avanzar de siguiente nivel. REPROBADO");
                guardarPuntos();
                reiniciar();
            }else{
                nivelActual++;
                preguntaActual=0;
                cargarPreguntas();
            }
        }
        //Funcion para guardar los puntos
        function guardarPuntos(){
            const nombreUsuario=prompt("Ingrese su nombre para guardar en el ranking: ");
            if(nombreUsuario){
                fetch('ranking.php',{
                    method:'POST',
                    headers:{
                        'Content-Type':'application/json'
                    },
                    body:
                    JSON.stringify({
                        nombre:nombreUsuario,
                        puntos:puntos
                    })
                })
                .then(respuesta=>respuesta.text())
                .then(data=>{
                    alert("Puntos guadrados correctamente "+data);
                })
                .catch(error=>{
                    console.error("Error al guardar los datos ",error);
                });
            }

        }




        //Funcion para reiniciar el juego
        function reiniciar(){
            nivelActual=1;
            preguntaActual=0;
            puntos=0;
            contenedorPuntos=`<p>Puntos: ${puntos}</p>`;
            cargarPreguntas();
        }

        //Evento para salir de la preguntas
        botonSalir.addEventListener('click',()=>{
            if(puntos==0){
                location.reload();
                reiniciar();
                
            }else{
                guardarPuntos();
                location.reload();
                reiniciar();  
            }  
        })

        //Evento para pasar a la siguiente pregunta
        botonSiguiente.addEventListener('click', () => {
            //ingresar la verificacion de respuesta correcta
            if(verificarRespuesta()){
                preguntaActual++
                 if (preguntaActual < preguntas.length) {
                    mostrarPregunta();
                } else {
                   verificarPuntos();
                }
            }   
        });

        // Cargar las preguntas al iniciar
        cargarPreguntas();
    });
</script>
</html>
