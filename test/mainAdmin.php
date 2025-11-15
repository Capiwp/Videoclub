<?php 
session_start();

if(!isset($_SESSION["admin"]))
    {
        header("Location: index.php");
        exit;
    }
$admin = $_SESSION["admin"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mainAdmin</title>
</head>
<body>
    <h1>Bienvenido, <?php echo $admin?></h1>
    <a href="logout.php">Cerrar Sesión</a>


</body>
</html>