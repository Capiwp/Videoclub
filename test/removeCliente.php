<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . "/../autoload.php";

use Dwes\ProyectoVideoclub\Cliente;
use Dwes\ProyectoVideoclub\Juego;
use Dwes\ProyectoVideoclub\Dvd;

session_start();

        $id = (int) $_GET['id'];

        $clienteABorrar = null;

        $clientes = $_SESSION['clientes'];

        foreach ($clientes as $key => $cliente) {
                
            if ($cliente->getNumero() == $id) {

                $clienteABorrar = $key;

            }

        }

        if ($clienteABorrar !== null) {

            unset($clientes[$clienteABorrar]);
            $_SESSION['clientes'] = $clientes;

        }

        header("Location: mainAdmin.php");
        exit();
    
?>