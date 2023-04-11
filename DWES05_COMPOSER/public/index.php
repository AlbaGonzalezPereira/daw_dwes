<?php
require '../vendor/autoload.php';

use Clases\Jugadores; //usamos la clase Jugadores, para no tener que escribir Clases\Jugadores más abajo

$jugador = new Jugadores(); //creamos un jugador y ya nos crea la conexión a la bbdd
if ($jugador->tieneDatos()) { //llama al método de Jugadores tieneDatos()
    $jugador = null;
    header('Location: jugadores.php');
} else {
    $jugador = null;
    header('Location: instalacion.php');
}