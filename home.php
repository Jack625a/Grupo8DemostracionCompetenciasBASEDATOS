<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div>
        <h1>Bienvenidos a Juego de Salud</h1>
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