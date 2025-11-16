<?php 

require_once __DIR__ . '/../autoload.php';

session_start();

if(!isset($_SESSION["admin"]))
    {
        header("Location: index.php");
        exit;
    }

$clientes = $_SESSION['clientes'];
$soportes = $_SESSION['soportes'];
$admin = $_SESSION['admin'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador</title>
</head>
<body>
    <h1>Bienvenido, <?php echo $admin?></h1>
    <h3>Listado de Clientes</h3>

    <ul>
    <?php 
    
    foreach ($_SESSION['clientes'] as $cliente) :
        ?>
        <li><?php echo $cliente->getNombre() . " | User: " . $cliente->getUser()?></li>

    <?php endforeach; ?>
    </ul>

    <h3>Listado de Soportes</h3>

    <ul>
    <?php 
    
    foreach ($_SESSION['soportes'] as $soporte) :
        ?>
        <li><?php echo $soporte->getTitulo()?></li>

    <?php endforeach; ?>
    </ul>

    <a href="formCreateCliente.php"><button>Crear Cliente</button></a>
    <a href="logout.php"><button>Cerrar Sesión</button></a>

</body>
</html>