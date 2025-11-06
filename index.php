<?php
session_start();
include 'conexion.php';

if (isset($_SESSION['id_usuario']) || isset($_SESSION['id_empleado'])) {
    header("Location: principal.php");
    exit;
}

$error = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = trim($_POST['usuario']);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id_usuario, password, nombre FROM Usuarios WHERE usuario = ?");
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['id_usuario'] = $row['id_usuario'];
            $_SESSION['tipo_usuario'] = 'Usuario';
            $_SESSION['nombre_usuario'] = $row['nombre'];
            header("Location: principal.php");
            exit;
        } else {
            $error = "Contraseña incorrecta.";
        }
    } else {
        $error = "Usuario no encontrado.";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8" />
<title>Login Usuarios</title>
<link rel="stylesheet" href="css/style.css" />
</head>
<body>
<main class="card">
  <h1>LOGIN 3-4</h1>
  <?php if ($error) { echo "<div class='error'>$error</div>"; } ?>
  <form method="post">
    <div class="form-group">
      <label for="user">Nombre de usuario</label>
      <input id="user" name="usuario" type="text" placeholder="ej. juan_01" required>
    </div>
    <div class="form-group">
      <label for="pass">Contraseña</label>
      <input id="pass" name="password" type="password" placeholder="••••••••" required>
    </div>
    <div class="actions">
      <button class="btn btn-primary" type="submit">Iniciar sesión</button>
      <button class="btn btn-green" onclick="window.location.href='registro_usuarios.php'; return false;" type="button">Registrarse</button>
      <button class="btn btn-outline" onclick="window.location.href='login_empleados.php'; return false;" type="button">Ir al panel de empleados</button>
    </div>
  </form>
</main>
</body>
</html>
