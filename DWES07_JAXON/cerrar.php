<?php

session_start();

if (isset($_SESSION['usu'])) unset($_SESSION['usu']);//si existe la sesión de usuario la elimina

header('Location:login.php');//va de vuelta al login.php
