<?php 
session_start();

if(!isset($_SESSION["usuario"]))
    {
        header("Location: index.php");
        exit;
    }


    $usuario = $_SESSION["usuario"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mainClient</title>
</head>
<body>
    <h1>Bienvenido <?php echo $usuario?></h1>

    <h2>Alquileres</h2>

</body>
</html>