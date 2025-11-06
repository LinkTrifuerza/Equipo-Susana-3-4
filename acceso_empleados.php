<?php
session_start();
if (!isset($_SESSION['id_empleado'])) {
    header("Location: login_empleados.php");
    exit;
}



?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8" />
<title>Acceso Empleados</title>
<link rel="stylesheet" href="css/style.css" />
</head>
<body>
<main class="card">
  <h1>Panel restringido para empleados</h1>
  <div class="actions">
    <button class="btn btn-outline" onclick="window.location.href='principal.php'; return false;">Principal</button>
    <button class="btn btn-outline" onclick="window.location.href='logout.php'; return false;">Cerrar sesión</button>
  </div>
</main>
</body>
</html>
