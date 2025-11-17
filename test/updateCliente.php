<?php

require_once __DIR__ . "/../autoload.php";

use Dwes\ProyectoVideoclub\Cliente;
use Dwes\ProyectoVideoclub\Juego;
use Dwes\ProyectoVideoclub\Dvd;

session_start();


    if(isset($_POST['enviar'])) {

        $id = (int) $_GET['id'];
        $origen = $_GET['origen'];

        $clientes = $_SESSION['clientes'];

        $nombre = $_POST['nombre'];
        $maxAlquileres = $_POST['maxAlquileres'];
        $usuario = $_POST['user'];
        $password = $_POST['password'];

        if (empty($usuario) || empty($password) || empty($nombre) || empty($maxAlquileres)) {

            $_SESSION['error'] = "Introduce todos los parámetros correctamente.";
            header("Location: formUpdateCliente.php?id=<?php $id?>&origen=<?php $origen?>");
            exit();

        } else {

            foreach ($clientes as $cliente) {
                
                if ($cliente->getNumero() === $id) {

                    $cliente->setNombre($nombre);
                    $cliente->setMaxAlquilerConcurrente($maxAlquileres);
                    $cliente->setUser($usuario);
                    $cliente->setPassword($password);

                }

            }

            header("Location: " . $origen);
            exit();
        }
    
    }
?>