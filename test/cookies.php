<?php
session_start();

$error = $_SESSION["error"] ?? null;
unset($_SESSION["error"]);

if (isset($_POST["guardarCookies"])) {

    if (!isset($_POST["tecnicas"])) {
        $error = "Debes aceptar las cookies técnicas para continuar.";
    } else {

        setcookie("cookies_tecnicas", "1", time() + 365*24*60*60, "/");

        if (isset($_POST["comerciales"])) {

        setcookie("cookies_comerciales", "1", time() + 365*24*60*60, "/");

        }

        header("Location: index.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cookies</title>
</head>
<body>

<h2>Configuración de cookies</h2>

<form method="POST">

    <label>
        <input type="checkbox" name="tecnicas">
        Aceptar cookies técnicas
    </label><br>

    <label>
        <input type="checkbox" name="comerciales">
        Aceptar cookies comerciales
    </label><br><br>

    <button type="submit" name="guardarCookies">Guardar</button>
</form>

<?php if ($error): ?>
    <p style="color:red;"><?php echo $error; ?></p>
<?php endif; ?>

</body>
</html>
