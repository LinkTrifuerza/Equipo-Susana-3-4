<?php
session_start();
if (!isset($_SESSION['id_usuario']) && !isset($_SESSION['id_empleado'])) {
    header("Location: index.php");
    exit;
}

$nombre = $_SESSION['nombre_usuario'] ?? "Usuario";

?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8" />
<title>Página Principal</title>
<link rel="stylesheet" href="css/style.css" />
</head>
<body>
<main class="card">
  <h1>Bienvenido <?= htmlspecialchars($nombre) ?></h1>
  <?php if (isset($_SESSION['id_empleado'])): ?>
    <p>Panel para empleados</p>
  <?php else: ?>
    <p>Panel para usuarios</p>
  <?php endif; ?>
  <div class="actions">
    <button class="btn btn-outline" onclick="window.location.href='logout.php'; return false;">Cerrar sesión</button>
  </div>
</main>
</body>
</html>
