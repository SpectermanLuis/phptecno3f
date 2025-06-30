<?php
//  ***************
//  *  LOGIN.PHP  *
//  ***************
// Formulario de ingreso de usuario para acceder al CRUD
// Verifica credenciales y redirige al dashboard si son válidas


// Conexión a la base de datos
require 'conexion.php';

// Verifica si se envió el formulario por método POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recuperar los datos enviados por el formulario
    $usuario = $_POST['usuario'];
    $clave   = $_POST['clave'];
   
    // Prepara una consulta SQL para buscar el usuario en la base de datos
    $stmt = $mysqli->prepare("SELECT * FROM usuarios WHERE usuario = ?");
    $stmt->bind_param("s", $usuario); 
    $stmt->execute();
    // obtiene el resultado de la consulta 
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    // cierra la consulta 
    $stmt->close(); 

   // Verifica si el usuario existe y si la contraseña es correcta
   if ($user && password_verify(trim($clave), $user['clave'])) {
        $_SESSION['usuario_id'] = $user['id'];
        // Redirecciona al panel de control
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Usuario o Clave inválidas";
    }
}
?>


<!DOCTYPE html>
<html>
<head><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"></head>
<body class="container mt-5">
<h1>TECNO 3F - PHP Y MYSQL - TP FINAL - CRUD</h1>
<h2>Login</h2>
<!-- Formulario de ingreso  Usuario y Clave-->
<form method="POST">
  <div class="mb-3"><input class="form-control" name="usuario" placeholder="Usuario" required></div>
  <div class="mb-3"><input type="password" class="form-control" name="clave" placeholder="Clave" required></div>
  <button class="btn btn-primary">Ingresar</button>
</form>

<h5>Usuario para prueba =  admin</h5>
<h5>Clave  para prueba =  admin123</h5>

<!-- Mostrar error si existe -->
<?php if(isset($error)) echo "<p class='text-danger mt-3'>$error</p>"; ?>
</body>
</html>