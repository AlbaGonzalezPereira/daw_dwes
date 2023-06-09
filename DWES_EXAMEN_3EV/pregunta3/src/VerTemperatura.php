<?php
// [JAXON-PHP]

require 'Temperatura.php';

require(__DIR__ . '/../vendor/autoload.php');

use Jaxon\Jaxon;
use function Jaxon\jaxon;
use Jaxon\Response\Response;

$jaxon = jaxon();

/**
 * Función que devuelve la temperatura de una ciudad
 */
function vCiudadTemperatura($ciudad) {
    $resp = jaxon()->newResponse();

    $datos   = new Temperatura($ciudad);
    $tiempo  = $datos->getTiempo(); //llamamos a la función getTiempo() para obtener la información del tiempo para la ciudad especificada
    //var_dump($tiempo);
    if (($tiempo['cod'])==404) {//si la ciudad no fue encontrada,mostramos una alerta con el mensaje
        //$resp->assign('temp', 'value', "ciudad no encontrada");
        $resp->alert("Ciudad no"); 
    }else{
        $temp    = $tiempo['main']['temp'];
        $tempGrados = $temp - 273.15; //convertimos a grados
        //$resp->assign('temp', 'value', $tempGrados . "º");
        $resp->alert("Ciudad si");
    }   
    return $resp; //devolvemos la respuesta
}

$jaxon->register(Jaxon::CALLABLE_FUNCTION, 'vCiudadTemperatura');
//$jaxon->register(Jaxon::CALLABLE_FUNCTION, 'vCiudadViento');

if($jaxon->canProcessRequest())  $jaxon->processRequest();
