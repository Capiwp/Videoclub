<?php 
session_start();

//Si es usuario lo manda a mainCliente si es admin lo manda mainAdmin
if (isset($_SESSION['admin']))
    {
        header('Location: mainAdmin.php');
        exit;
    }
    elseif (isset($_SESSION['usuario']))
        {
           header('Location: mainCliente.php');
           exit;
        }

    $error = $_GET['error'] ?? '';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
</head>
<body>
    <?php 
        if($error)
            {?>
            <p>Usuario o Contraseña incorrectos</p>
                
           <?php }?> 
    
    <form id="formulario" action="login.php" method="post">
        <label>Usuario</label><input type="text" name="usuario" />
        <label>Contraseña</label><input type="password" name="password" />

        <button type="submit">Mandar</button>    
    </form>
</body>
</html>