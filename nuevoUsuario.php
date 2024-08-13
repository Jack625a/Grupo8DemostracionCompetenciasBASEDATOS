<?php
    //Paso 1. Crear la conexion con la base de datos
    require 'conexion.php';
    //Paso 2. Manejo de sesiones
    session_start();

//Paso 3. Obtencion de los datos que el usuario ingreso
if(isset($_POST['registrar'])){
    $usuario=mysqli_real_escape_string($conexion,$_POST['username']);
    $nombre=mysqli_real_escape_string($conexion,$_POST['nombre']);
    $email=mysqli_real_escape_string($conexion,$_POST['email']);
    $contraseña=password_hash($_POST['contraseña'],PASSWORD_DEFAULT);
    //Paso 5. Insercion de datos.
    $sql="INSERT INTO usuarios (Nombre, NombreUsuario,Email, Rol, Contraseña) VALUES('$nombre','$usuario','$email','User','$contraseña')";
    if(mysqli_query($conexion,$sql)){
        echo "Usuario registrado Correctamente";
    }


    //Paso 4. Verificar el correo
   /* $verificacion=mysqli_query($conexion, "SELECT Email FROM usuarios WHERE Email=$email");

    if(mysqli_num_rows($verificacion)>0){
        echo "Correo ya fue registrado";
    }else{
        //Paso 5. Insercion de datos.
        $sql="INSERT INTO usuarios (Nombre, NombreUsuario,Email, Rol, Contraseña) VALUES('$nombre','$usuario','$email','User','$contraseña')";
        if(mysqli_query($conexion,$sql)){
            echo "Usuario registrado Correctamente";
        }
    }
*/
}


?>