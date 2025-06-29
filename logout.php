<?php
//  *************************
//  *  LOGOUT.PHP  *
//  *************************

// Finaliza la sesión del usuario y redirige al login
session_start();
$_SESSION = [];
session_destroy();
header("Location: login.php");
exit;
?>