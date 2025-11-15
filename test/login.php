<?php 
session_start();

    $usuariosvalidos = 
    [
        'admin' => 'admin',
        'usuario' => 'usuario'
    ];

    if($_POST['usuario'] == 'admin' && $_POST['password'] == 'admin')
        {
            $_SESSION['admin'] = $usuario;
            header('Location: mainAdmin.php');
            exit;
        }

        if ($usuario == 'usuario' && $password == 'usuario') {
            $_SESSION['usuario'] = $usuario;
            header('Location: mainCliente.php');
        exit;
}
        header('index.php?error=1');
        exit;
?>