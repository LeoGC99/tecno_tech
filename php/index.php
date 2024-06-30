<?php
include("./conexion.php");
session_start();

if (!empty($_POST)) {
    $usuario = mysqli_real_escape_string($conn, $_POST['Correo']);
    $contraseña = mysqli_real_escape_string($conn, $_POST['Contraseña']);

    $sql = "SELECT id, Contraseña FROM bbaselogin WHERE Correo = '$usuario'";
    $resultado = $conn->query($sql);

    if ($resultado->num_rows > 0) {
        $row = $resultado->fetch_assoc();
        $hash = $row['Contraseña'];

        if (password_verify($contraseña, $hash)) {
            $_SESSION['id_u'] = $row['id'];
            header("Location: admin.php");
        } else {
            echo "<script>
                    alert('Ingreso Exitoso');
                    window.location='pagprinc.php';
                  </script>";
        }
    } else {
        echo "<script>
                alert('El usuario o contraseña son incorrectos');
                window.location='index.php';
              </script>";
    }
}
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro y logueo</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="../estilologin.css">

   
</head>
<body>
    
    <!--Esta seccion es para el Inicio de sesion , elaboramos el formulario .-->
    <div class="container" id="form2">
        <h1 class="titulo_registro">Iniciar sesión.</h1>
        <form method="post" action="">
            <div class="input_grupo">
                <i class="fas fa-envelope"></i>
                <input type="email" name="Correo" id="Correo"placeholder="Ingrese su correo" required>
                <label for="Correo">Correo</label>
            </div>
            <div class="input_grupo">
                <i class="fas fa-lock"></i>
                <input type="password" name="Contraseña" id="Contraseña"placeholder="Ingrese la contraseña nueva " required>
                <label for="Contraseña">Contraseña</label>
            </div>
            <p class="recuperarContra">
                <a href="#">Recuperar contraseña</a>
            </p>
            <input type="submit" class="btn" value="Ingresar" name="InicioSesion">
            
            <div class="links">
                <p>¿No tienes una cuenta?</p>
              
                <a class="botonCrear" href="registro.php">Crear cuenta</a>

            </div>
        </form> 

    </div>

</body> 
</html>