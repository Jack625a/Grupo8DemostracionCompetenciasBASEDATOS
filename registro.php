<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
</head>
<body>
    <h2>Registrar</h2>
    <form action="nuevoUsuario.php" method="POST">
        <label for="username">Usuario: </label>
        <input type="text" name="username" required>
        <br>
        <label for="nombre">Nombre Completo: </label>
        <input type="text" name="nombre" required>
        <br>
        <label for="email">Correo: </label>
        <input type="email" name="email">
        <br>
        <label for="contraseña">Contraseña: </label>
        <input type="password" name="contraseña">
        <br>
        <button type="submit" name="registrar">Registrar</button>
    </form>
</body>
</html>