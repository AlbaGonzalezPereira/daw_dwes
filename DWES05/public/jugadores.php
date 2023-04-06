<?php
session_start();
require '../vendor/autoload.php';

use Clases\Jugadores;
use Milon\Barcode\DNS1D;//libreria de barcode, que nos permite generar los gráficos de barcode
use Philo\Blade\Blade;

$views = '../views';
$cache = '../cache';
$blade = new Blade($views, $cache);

//inicializamos los datos de la plantilla de Blade
$d          = new DNS1D(); //inicializamos la librería del código de barras
$titulo     = 'Jugadores';
$encabezado = 'Listado de Jugadores';
$jugadores  = (new Jugadores())->recuperarJugadores();//llama al método recuperarJugadores() para hacer la consulta

$d->setStorPath($cache);

//pasa el listado de todos los jugadores a la vista
//si hay un mensaje en la sesión, le pasa a la vista el mensaje. En caso contrario no
if(isset($_SESSION['mensaje'])){
    $mensaje = $_SESSION['mensaje'];
    unset($_SESSION['mensaje']); //Para no volver repetir el mensaje
    echo $blade
    ->view()
    ->make('vjugadores', compact('titulo', 'encabezado','jugadores','d','mensaje'))
    ->render();
} else {//no pasamos el mensaje
    echo $blade
    ->view()
    ->make('vjugadores', compact('titulo', 'encabezado','jugadores','d')) 
    ->render();
}