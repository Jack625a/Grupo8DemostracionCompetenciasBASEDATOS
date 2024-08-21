<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
<style>
        /* Estilos Generales */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #e0f7fa; /* Fondo azul claro */
            display: flex;
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

        form {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.3);
            width: 300px;
            text-align: left;
            animation: fadeInUp 1s ease-in-out;
        }

        label {
            color: #00796b;
            font-size: 1.1em;
            margin-bottom: 10px;
            display: block;
        }

        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            border: 1px solid #b2dfdb;
            font-size: 1em;
        }

        button[type="submit"], #loginGoogle, #botonCerrarSesion {
            width: 100%;
            background-color: #00796b;
            color: white;
            padding: 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1.2em;
            transition: background-color 0.3s, transform 0.3s;
            margin-bottom: 10px;
        }

        button[type="submit"]:hover, #loginGoogle:hover, #botonCerrarSesion:hover {
            background-color: #004d40;
            transform: scale(1.05);
        }

        p {
            text-align: center;
            font-size: 1.1em;
            color: #00796b;
        }

        #mensaje {
            display: none;
            background-color: #e0f2f1;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.2);
            margin-top: 15px;
            animation: fadeIn 1s ease-in-out;
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

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
    </style>
    <h1>Iniciar Sesion</h1>
    <form action="sesion.php" method="POST">
        <label for="usuario">Usuario: </label>
        <input type="usuario" required name="usuario">
        <br>
        <label for="contraseña">Contraseña: </label>
        <input type="password" name="contraseña" required>
        <br>
        <button type="submit" name="login">Iniciar Sesión</button>
    </form>
  
   <p>ó</p>
    <button id="loginGoogle">Iniciar sesion con Google</button>
    <div id="mensaje">
      <p >Se inicio Sesion correctamente: 
      <span id="nombreUsuario"></span>
      <span id="correoUsuario"></span>
      </p>
    </div>
    <button id="botonCerrarSesion">Cerrar Sesion</button>

<!--Configuracion de firebase -->
<script type="module">
  import { initializeApp } from 'https://www.gstatic.com/firebasejs/10.9.0/firebase-app.js';
  import {getAuth, GoogleAuthProvider, signInWithPopup,  signOut, onAuthStateChanged } from 'https://www.gstatic.com/firebasejs/10.9.0/firebase-auth.js';

  // Paso 1. Configuracion de firebase con el proyecto
const firebaseConfig = {
  apiKey: "",
  authDomain: "",
  projectId: "",
  storageBucket: "",
  messagingSenderId: "",
  appId: ""
};

//Paso 2. Inicializar Firebase
const app = initializeApp(firebaseConfig);
const auth=getAuth();
//Paso 3. Configurar el Proveedor de la autentificacion
const proveedor=new GoogleAuthProvider();

//Paso 4. Enlazar el boton de inicio de sesion
const botonLogin=document.getElementById('loginGoogle');
const botonCerrar=document.getElementById('botonCerrarSesion');
const mensaje=document.getElementById('mensaje');
const nombreUsuario=document.getElementById('nombreUsuario');
const correoUsuario=document.getElementById('correoUsuario');

botonCerrar.style.display="none";
mensaje.style.display="none";

const iniciarSesionUsuario=async()=>{
  signInWithPopup(auth,proveedor)
  .then((resultado)=>{
    const usuario=resultado.user;
    console.log(usuario)
    window.location.href='preguntas.php';
  })
  .catch((error)=>{
    console.log("Error al iniciar sesion");
  })
}

const cerrarSesionUsuarion=async()=>{
  signOut(auth).then(()=>{
    alert ("Has cerrado la sesion exitosamente...")
  })
  .catch((error)=>{
    console.log("Error al cerrar sesion");
  })
};

onAuthStateChanged(auth,(usuario)=>{
  if(usuario){
    botonCerrar.style.display="block";
    mensaje.style.display="block";

    nombreUsuario.innerHTML=usuario.displayName;
    correoUsuario.innerHTML=usuario.email;
  }else{
    botonCerrar.style.display="none";
    mensaje.style.display="none";
  }
});

botonLogin.addEventListener('click',iniciarSesionUsuario);
botonCerrar.addEventListener('click', cerrarSesionUsuarion);
</script>

</body>
</html>