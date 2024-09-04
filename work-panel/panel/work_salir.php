<?php
session_start(); // Iniciar sesión

// Blanquear cookie de password, así como todas las sesiones

setcookie("c_usuario", "", time() - (365*24*60*60), "/");
setcookie("c_password", "", time() - (365*24*60*60), "/");

session_unset();
session_unset($_SESSION['usuario_id']);
session_unset($_SESSION['usuario_datos_nombre']);
session_unset($_SESSION['usuario_datos_id']);

session_unset($_SESSION['sesionhid3']);
session_unset($_SESSION['xt']);
session_unset($_SESSION['permisos']);

session_destroy();

// Redireccionar al inicio
header("Location: login.php");