<?php
session_start();//comenzamos la sesión
require '../vendor/autoload.php';

use Clases\Jugadores;
use Faker\Factory; //usa Faker que genera datos aleatorios

//Borrar los datos de todos los jugadores de la base de datos
$jugador = (new Jugadores())->borrarTodo();//borramos todo lo que teníamos
$jugador = null;

$faker = Factory::create('es_Es');//utiliza la carpeta de ES, España

$cantidad=15; //creamos 15 jugadores
for ($i=0; $i < $cantidad; $i++) { 
    $jugador = new Jugadores(); //crea un objeto jugador
    //modifica los valores de los atributos
    $jugador->setNombre($faker->firstName('male' | 'female'));
    $jugador->setApellidos($faker->lastname . " " . $faker->lastname);
    $jugador->setDorsal($faker->unique()->numberBetween(1,60));
    $jugador->setPosicion($faker->numberBetween(1,6));
    $jugador->setBarcode($faker->unique()->ean13);
    $jugador->create(); //crea el jugador en la bbdd
    $jugador=null;
}

$_SESSION['mensaje']='Datos creados correctamente';

header('Location:jugadores.php');