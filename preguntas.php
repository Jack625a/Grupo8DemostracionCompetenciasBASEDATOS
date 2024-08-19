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
    <h1>Juego de trivias - Medicina</h1>
    <div id="contenedor-preguntas"></div>
    <div id="contenedor-opciones"></div>
    <div id="contenedor-nivel"></div>
    <div id="contendor-puntos"></div>
    <button id="siguientePregunta">Siguiente</button>
</body>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        let nivelActual = 1;
        let preguntaActual = 0;
        let preguntas = [];
        let puntos=0;

        const contenedorPreguntas = document.getElementById('contenedor-preguntas');
        const contenedorNivel = document.getElementById('contenedor-nivel');
        const botonSiguiente = document.getElementById('siguientePregunta');
        const contenedorOpciones=document.getElementById('contenedor-opciones');
        const contenedorPuntos=document.getElementById('contendor-puntos');

        function cargarPreguntas() {
            console.log('Cargando preguntas para el nivel:', nivelActual); 

            fetch('datospreguntas.php?nivel=' + nivelActual)
                .then(response => {
                    console.log('Respuesta del servidor:', response);
                    if (!response.ok) {
                        throw new Error('Error al cargar las preguntas: ' + response.statusText);
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Preguntas recibidas:', data); 
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
                let respuestaCorrecta=preguntas[preguntaActual].rsepuesta;
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

        botonSiguiente.addEventListener('click', () => {
            //ingresar la verificacion de respuesta correcta
            if(verificarRespuesta()){
                preguntaActual++
                 if (preguntaActual < preguntas.length) {
                    mostrarPregunta();
                } else {
                    nivelActual++;
                     preguntaActual = 0;
                    cargarPreguntas();
                }
            }   
        });

        // Cargar las preguntas al iniciar
        cargarPreguntas();
    });
</script>
</html>
