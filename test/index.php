<?php 
session_start();

if (!isset($_COOKIE["cookies_tecnicas"])) {
    $_SESSION["error"] = "Debes aceptar las cookies técnicas para iniciar sesión.";
    header("Location: cookies.php");
    exit();
}

$error = $_SESSION['error'] ?? null;
unset($_SESSION['error']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
</head>
<body>    
    <form id="formulario" action="login.php" method="post"> 

        <label>Usuario: </label><input type="text" name="usuario" id="usuario"/>
        <label>Contraseña: </label><input type="password" name="password" id="password"/>
        <button type="submit" name="enviar">Enviar</button>    
        <div><span class='error'><?php echo $error; ?></span></div>

    </form>
</body>
</html>