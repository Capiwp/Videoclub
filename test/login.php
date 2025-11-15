<?php
session_start();

    if(isset($_POST['enviar'])) {

        $usuario = $_POST['usuario'];
        $password = $_POST['password'];

        if (empty($usuario) || empty($password)) {

            $_SESSION['error'] = "Usuario o contraseña no introducidos.";
            header("Location: index.php");
            exit();


        }
            
        if ($usuario == 'admin' && $password == 'admin')
        {
            session_start();
            $_SESSION['admin'] = $usuario;
            header("Location: mainAdmin.php");
            exit();

        } 
        
        if ($usuario == 'usuario' && $password == 'usuario') {
            
            session_start();
            $_SESSION['usuario'] = $usuario;
            header("Location: mainCliente.php");
            exit();

        }
            
        $_SESSION['error'] = "Usuario o contraseña no válidos.";
        header("Location: index.php");
        exit();

    
    }
?>