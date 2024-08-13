<?php
    //Paso 1. Inciar la sesion y establecer la conexion
    session_start();
    require 'conexion.php';
    if(isset($_POST['login'])){
        $usuario=mysqli_real_escape_string($conexion,$_POST['usuario']);
        $password=$_POST['contraseña'];
        //Paso 2. Crear la consulta sql para verificar si el correo esta registrado
        $sql2="SELECT * FROM usuarios WHERE NombreUsuario='$usuario'";
        echo $usuario;
        $resultado=mysqli_query($conexion,$sql2);

        if(mysqli_num_rows($resultado)>0){
            $user=mysqli_fetch_assoc($resultado);
            //Paso 3. Verificar la contraseña
            if(password_verify($password,$user['Contraseña'])){
                //Iniciar Sesion
                $_SESSION['idUsuario']=$user['idUsuario'];
                $_SESSION['Rol']=$user['Rol'];
                $_SESSION['NombreUsuario']=$user['NombreUsuario'];
                //Paso 4. Establecer el redireccionamineto a la pagina principal
                header("Location: home.php");
                exit;
            }else{
                echo "Error correo o contraseña incorrecto";
            }
        }

    }
?>