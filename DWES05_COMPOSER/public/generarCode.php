<?php
session_start();
require '../vendor/autoload.php';

use Clases\Jugadores;
use Faker\Factory;

$faker = Factory::create('es_ES');
$jugador = new Jugadores;

//generamos un código y comprobamos que NO existe
while (true) {
    $code = $faker->ean13;
    if (!$jugador->existeBarcode($code)) { //genera un Barcode y comprueba que no existe un Barcode. Si existe genera otro 
        $jugador = null;
        break;
    }
}

$_SESSION['codigo'] = $code;
header('Location:fcrear.php');