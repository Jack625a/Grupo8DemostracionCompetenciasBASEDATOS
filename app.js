import { initializeApp } from "firebase/app";
import { getAuth, GoogleAuthProvider, signInWithPopup, signOut, onAuthStateChanged } from "firebase/auth";


// Paso 1. Configuracion de firebase con el proyecto
const firebaseConfig = {
  apiKey: "AIzaSyAL9-JIERX-ekrRX-wpIOq3QoWAinQWQmw",
  authDomain: "competenciasbasedatos.firebaseapp.com",
  projectId: "competenciasbasedatos",
  storageBucket: "competenciasbasedatos.appspot.com",
  messagingSenderId: "945695308269",
  appId: "1:945695308269:web:6a0f6b0d6cbcaa17960fe4"
};

//Paso 2. Inicializar Firebase
const app = initializeApp(firebaseConfig)
const auth=getAuth(app)

//Paso 3. Configurar el Proveedor de la autentificacion
const proveedor=new GoogleAuthProvider()

//Paso 4. Enlazar el boton de inicio de sesion
const botonLogin=document.getElementById('loginGoogle')

//Paso 5. Crear la accion para el manejo del inicio de sesion
botonLogin.addEventListener('click',()=>{
  auth.signInWithPopup(proveedor)
  .then((resultado)=>{
    const usuario=resultado.user;
    alert("Bienvenido ".usuario)

  })
  .catch((error)=>{
   // alert("Error al iniciar sesion")
  })
})



