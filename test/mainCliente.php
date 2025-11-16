<?php 
require_once __DIR__ . '/../autoload.php';

session_start();

if(!isset($_SESSION["usuario"]))
    {
        header("Location: index.php");
        exit;
    }


    $usuario = $_SESSION['usuario'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cliente></title>
</head>
<body>
    <h1>Bienvenido, <?php echo $usuario->getNombre() ?></h1>

    <h3>Listado de alquileres</h3>

    <ul>

    <?php foreach ($usuario->getAlquileres() as $alquiler) : ?>

    <li><?php echo $alquiler->getTitulo()?></li>

    <?php endforeach ?>

    </ul>

    <div><a href="logout.php"><button>Cerrar Sesión</button></a></div>


</body>
</html>