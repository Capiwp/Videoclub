<?php

require_once __DIR__ . "/../autoload.php";

use Dwes\ProyectoVideoclub\Cliente;
use Dwes\ProyectoVideoclub\Juego;
use Dwes\ProyectoVideoclub\Dvd;

session_start();


    if(isset($_POST['enviar'])) {

        $nombre = $_POST['nombre'];
        $maxAlquileres = $_POST['maxAlquileres'];
        $usuario = $_POST['user'];
        $password = $_POST['password'];

        if (empty($usuario) || empty($password) || empty($nombre) || empty($maxAlquileres)) {

            $_SESSION['error'] = "Introduce todos los parámetros correctamente.";
            header("Location: formCreateClientes.php");
            exit();

        } else {

            $cliente = new Cliente($nombre, $maxAlquileres, $usuario, $password);

            array_push($_SESSION['clientes'], $cliente);

            header("Location: mainAdmin.php");
            exit();
        }
    
    }
?>