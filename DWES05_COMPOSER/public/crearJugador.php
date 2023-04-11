<?php
session_start();
require '../vendor/autoload.php';

use Clases\Jugadores;

/**
 * Función por si hay un error
 */
function error($text) {
    $_SESSION['error']=$text;
    header('Location:fcrear.php');
    die();
}

//por $_POST recoge los datos del formulario
$nom    = trim($_POST['nombre']);//trim quita espacios
$ape    = trim($_POST['apellidos']);
$pos    = $_POST['posicion'];
$dorsal = (int)$_POST['dorsal'];
$cod    = $_POST['barcode'];

//comprueba que el nombre y/o apellido no tengan valores vacíos
if (strlen($nom)==0 || strlen($ape)==0) {
    error("Nombre y Apellidos deben contener algún carácter válido!!!");
}

//crea un jugador
$jugador = new Jugadores();
//comprueba si el dorsal está elegido
if ($jugador->existeDorsal($dorsal)) {
    $jugador=null;
    error("El Dorsal ya está elegido");
}

//Si hemos llegado aquí todo ha ido bien vamos a hacer el insert
$jugador->setNombre(ucwords($nom));//ucwords pone la primera letra en mayúscula
$jugador->setApellidos(ucwords($ape));
$jugador->setPosicion($pos);

if ($dorsal != 0) $jugador->setDorsal($dorsal);
$jugador->setBarcode($cod);
$jugador->create();
$jugador = null;

$_SESSION['mensaje'] = "Jugador creado con éxito";
header('Location:jugadores.php');