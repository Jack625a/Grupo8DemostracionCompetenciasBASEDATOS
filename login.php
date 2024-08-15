<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
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
    window.location.href='home.php';
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