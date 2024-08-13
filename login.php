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
</body>
</html>