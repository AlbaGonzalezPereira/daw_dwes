<?php
session_start(); //carga una sesión
require '../vendor/autoload.php';

use Philo\Blade\Blade;

//carga las plantillas
$views = '../views';
$cache = '../cache';
$blade = new Blade($views, $cache);

$titulo='Instalar BBDD'; //título de la página web
$encabezado='Instalación'; //Encabezado

echo $blade //va a la plantilla
    ->view()
    ->make('vinstalacion', compact('titulo', 'encabezado')) //va a la vista de instalación
    ->render();