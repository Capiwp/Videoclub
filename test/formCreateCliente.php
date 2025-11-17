<?php 
session_start();
$error = $_SESSION['error'] ?? null;
unset($_SESSION['error']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Cliente</title>
</head>
<body>    
    <form id="formulario" action="createCliente.php" method="post"> 

        <label>Nombre completo: </table></label><input type="text" name="nombre" id="nombre"/><br><br>
        <label>Máximo de alquileres: </label><input type="integer" name="maxAlquileres" id="maxAlquileres"/><br><br>
        <label>Usuario: </label><input type="text" name="user" id="user"/><br><br>
        <label>Contraseña: </label><input type="text" name="password" id="password"/><br><br>

        <button type="submit" name="enviar">Enviar</button>  
        <div><span class='error'><?php echo $error; ?></span></div>
    
    </form>
</body>
</html>