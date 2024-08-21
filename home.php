<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Juego Salud</title>
</head>
<body>


    <style>
        /* Estilos Generales */
body {
font-family: 'Arial', sans-serif;
background-color: #f0f8ff; /* Fondo azul claro que evoca tranquilidad */
margin: 0;
padding: 0;
display: flex;
justify-content: center;
align-items: center;
height: 100vh;
}

/* Estilo del Contenedor Principal */
div {
text-align: center;
background-color: #fff;
padding: 20px;
border-radius: 15px;
box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.2);
width: 80%;
max-width: 500px;
}

/* Título Principal */
h1 {
color: #2c3e50;
font-size: 2.5em;
margin-bottom: 20px;
}

/* Estilos de los Botones */
.btn {
background-color: #1abc9c;
color: white;
padding: 15px 30px;
margin: 10px;
border: none;
border-radius: 50px;
cursor: pointer;
font-size: 1.2em;
transition: background-color 0.3s, transform 0.3s;
}

.btn:hover {
background-color: #16a085;
transform: scale(1.05);
}

/* Modal */
.modal {
 display: none;
position: fixed;
 z-index: 1;
left: 0;
 top: 0;
  width: 100%;
 height: 100%;
  overflow: auto;
 background-color: rgba(0, 0, 0, 0.5);
}

.contenido-modal {
 background-color: #fff;
 margin: 15% auto;
 padding: 20px;
 border-radius: 10px;
 width: 80%;
 max-width: 400px;
 box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
 animation: abrirModal 0.5s ease-out;
}

/* Animación de apertura de Modal */
@keyframes abrirModal {
 from {
 opacity: 0;
 transform: translateY(-50px);
 }
 to {
 opacity: 1;
 transform: translateY(0);
 }
}

/* Estilo del Botón de Cerrar */
#cerrar {
 float: right;
 font-size: 1.5em;
 cursor: pointer;
 color: #c0392b;
 transition: color 0.3s;
}

#cerrar:hover {
 color: #e74c3c;
}

/* Efectos Visuales Adicionales */
body::before {
content: '';
position: absolute;
 top: 0;
 left: 0;
 width: 100%;
 height: 100%;
  background: url('https://www.example.com/path/to/your/health-theme-image.jpg') no-repeat center center/cover;
 z-index: -1;
 opacity: 0.1;
}

    </style>
    <div>
        <h1>Bienvenidos a Juego de Salud</h1>
        <div style="position: relative; width: auto; height: 0; padding-top: 56.2500%;
 padding-bottom: 0; box-shadow: 0 2px 8px 0 rgba(63,69,81,0.16); margin-top: 1.6em; margin-bottom: 0.9em; overflow: hidden;
 border-radius: 8px; will-change: transform;">
  <iframe loading="lazy" style="position: absolute; width: 100%; height: 100%; top: 0; left: 0; border: none; padding: 0;margin: 0;"
    src="https:&#x2F;&#x2F;www.canva.com&#x2F;design&#x2F;DAGOf-Anh90&#x2F;2_AR-9azAr70-TPbE2G8Sw&#x2F;watch?embed" allowfullscreen="allowfullscreen" allow="fullscreen">
  </iframe>
</div>

        <button class="btn" id="botonJugar">Jugar</button>
        <button class="btn" onclick="window.location.href='reglas.php'">Reglas</button>
        <button class="btn" onclick="window.location.href='tablaPosiciones.php'">Ranking</button>
        <button class="btn" onclick="window.location.href='registro.php'">Registrarse</button>
    </div>
    

    <div id="PantallaLogin" class="modal">
        <div class="contenido-modal">
            <span id="cerrar">❌</span>
                <div id="contenido-login">

                </div>
    </div>

    </div>
    <script>
        //Obtener los elementos para la pantalla
        var boton=document.getElementById('botonJugar');
        var pantalla=document.getElementById('PantallaLogin');
        var botnCerrar=document.getElementById('cerrar');

        boton.onclick=function(){
            pantalla.style.display="block";
       

        //Realizar la peticion para cargar el contenido de Login 
        var solicitud=new XMLHttpRequest();
        solicitud.open('GET','login.php',true);
        solicitud.onreadystatechange=function(){
            if(solicitud.readyState==4 && solicitud.status==200){
                document.getElementById('contenido-login').innerHTML=solicitud.responseText;
            }
        };
        solicitud.send();
    }
    //Accion para cerrar la pantalla
    botnCerrar.onclick=function(){
        pantalla.style.display="none";
    }

    </script>
</body>
</html>