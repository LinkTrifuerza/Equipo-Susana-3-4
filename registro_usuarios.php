<?php
session_start();
include 'conexion.php';

$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = trim($_POST['nombre']);
    $apellido = trim($_POST['apellido']);  
    $usuario = trim($_POST['usuario']);
    $correo = trim($_POST['email']);
    $password = $_POST['password'];
    $confirmar = $_POST['confirmar'];

    if ($password !== $confirmar) {
        $error = "Las contraseñas no coinciden.";
    } else {
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO Usuarios (nombre, apellido, usuario, email, password, fecha_registro) VALUES (?, ?, ?, ?, ?, NOW())");
        $stmt->bind_param("sssss", $nombre, $apellido, $usuario, $correo, $hash);
        if ($stmt->execute()) {
            $success = "Registro exitoso. Ya puedes iniciar sesión.";
        } else {
            $error = "Error al registrar usuario.";
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8" />
<title>Registro Usuarios</title>
<link rel="stylesheet" href="css/style.css" />
</head>
<body>
<main class="card">
  <h1>Registro Usuarios</h1>
  <?php if ($error) { echo "<div class='error'>$error</div>"; } ?>
  <?php if ($success) { echo "<div class='success'>$success</div>"; } ?>
  <form method="post">
    <div class="form-group">
      <label>Nombre</label>
      <input name="nombre" type="text" required>
    </div>
    <div class="form-group">
      <label>Apellido</label>
      <input name="apellido" type="text" required>
    </div>
    <div class="form-group">
      <label>Usuario</label>
      <input name="usuario" type="text" required>
    </div>
    <div class="form-group">
      <label>Email</label>
      <input name="email" type="email" required>
    </div>
    <div class="form-group">
      <label>Contraseña</label>
      <input name="password" type="password" required>
    </div>
    <div class="form-group">
      <label>Confirmar Contraseña</label>
      <input name="confirmar" type="password" required>
    </div>
    <div class="actions">
      <button type="submit" class="btn btn-primary">Registrar</button>
      <button class="btn btn-outline" onclick="window.location.href='index.php'; return false;" type="button">Volver al login</button>
    </div>
  </form>
</main>
</body>
</html>
