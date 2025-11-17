<?php

require_once __DIR__ . "/../autoload.php";

use Dwes\ProyectoVideoclub\Cliente;
use Dwes\ProyectoVideoclub\Juego;
use Dwes\ProyectoVideoclub\Dvd;

session_start();


    if(isset($_POST['enviar'])) {

        $usuario = $_POST['usuario'];
        $password = $_POST['password'];

        if(!isset($_SESSION['clientes'])) {

            $cliente1 = new Cliente("Amancio Ortega", 3, "amancio", "1234");
            $cliente2 = new Cliente("Pablo Picasso", 2, "picasso", "1234");

            $_SESSION['clientes'] = [$cliente1, $cliente2]; 

        }   
        
        if (!isset($_SESSION['soportes'])) {

            $soporte1 = new Juego("God of War", 39.99, "PS5", 1, 2);
            $soporte2 = new Juego("The Last of Us II", 69.99, "PS4", 1, 3);
            $soporte3 = new Dvd("Torrente", 9.99, "ES", "16:9");

            $_SESSION['soportes'] = [$soporte1, $soporte2, $soporte3];

        }

          

        if (empty($usuario) || empty($password)) {

            $_SESSION['error'] = "Usuario o contraseña no introducidos.";
            header("Location: index.php");
            exit();

        }
            
        if ($usuario == 'admin' && $password == 'admin')
        {

            $_SESSION['admin'] = $usuario;
            header("Location: mainAdmin.php");
            exit();

        } 
        
        if (isset($_SESSION['clientes'])) {

            foreach ($_SESSION['clientes'] as $cliente) {

                if ($usuario == $cliente->getUser() && $password == $cliente->getPassword()) {

                    $_SESSION['usuario'] = $cliente;
                    header("Location: mainCliente.php");
                    exit();

                }

            }

        }
            
        $_SESSION['error'] = "Usuario o contraseña no válidos.";
        header("Location: index.php");
        exit();

    
    }
?>