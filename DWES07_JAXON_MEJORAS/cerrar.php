<?php
//cierra una sesión
session_start();

if (isset($_SESSION['usu'])) unset($_SESSION['usu']);//si existe la sesión de usuario la elimina
if (isset($_SESSION['idT'])) unset($_SESSION['idT']);//si existe la sesión de idTienda la elimina

header('Location:login.php');//va de vuelta al login.php
