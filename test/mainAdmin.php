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
    <h1>Bienvenido, Administrador</h1>
    <h3>Listado de Clientes</h3>

    <ul>
    <?php 
    
    foreach ($_SESSION['clientes'] as $cliente) :
        ?>
        <span><li><?php echo $cliente->getNombre() . " | User: " . $cliente->getUser()?></span>

        <div style="display:inline-block; margin-left:10px;">
        <form action="formUpdateCliente.php" method="get" style="display:inline-block; margin-left:10px;">
        <input type="hidden" name="id" value="<?= $cliente->getNumero() ?>">
        <input type="hidden" name="origen" value="mainAdmin.php">
        <button type="submit">Actualizar Cliente</button>
        </form>

        <form action="removeCliente.php" method="get" style="display:inline-block; margin-left:10px;">
        <input type="hidden" name="id" value="<?= $cliente->getNumero() ?>">
        <button type="submit">Borrar Cliente</button>
        </form>
        </div>


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