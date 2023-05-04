<?php
require '../vendor/autoload.php';

use Clases\Pub_gestdocente;
use Clases\wstitulosuni;

$puerta = new Pub_gestdocente();
$servicio = new wstitulosuni('es', '2023');
$respuesta = $puerta->wstitulosuni($servicio);
$listaTitulos = $respuesta->getWstitulosuniResult();

echo "Número de títulos: " . $listaTitulos->count() . "<br>" . PHP_EOL;

for ($i = 0; $i <  $listaTitulos->count(); $i++ ) {
    $titulo = $listaTitulos->current();

    echo "nº titulo: " . ($i +1) . "<br>" . PHP_EOL;
    echo "Código título: ". $titulo->getCodigo()  . "<br>" . PHP_EOL;
    echo "Nombre título: ". $titulo->getNombre()  . "<br>" . PHP_EOL;
    $listaTitulos->next();
}
// var_dump($listaTitulos );

