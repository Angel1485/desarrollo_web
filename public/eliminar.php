<?php
session_start();
require_once "../classes/Usuario.php";

if (isset($_GET['id'])) {
    $usuario = new Usuario();
    $usuario->eliminar($_GET['id']);
}

header("Location: inicio.php");
exit;