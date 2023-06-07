<?php
// [JAXON-PHP]

require 'Temperatura.php';

require(__DIR__ . '/../vendor/autoload.php');

use Jaxon\Jaxon;
use function Jaxon\jaxon;
use Jaxon\Response\Response;

$jaxon = jaxon();

function vCiudadTemperatura($ciudad) {
    $resp = jaxon()->newResponse();

    // if (!validar($ciudad)) {
    //     $resp->alert("Ciudad errónea, revísela!!");
    //     return $resp;
    // }

    $datos   = new Temperatura($ciudad);
    $tiempo  = $datos->getTiempo();
    //var_dump($tiempo);
    if (($tiempo['cod'])==404) {
        //$resp->assign('temp', 'value', "ciudad no encontrada");
        $resp->alert("Ciudad no");
    }else{
        $temp    = $tiempo['main']['temp'];
        $tempGrados = $temp - 273.15;
        //$resp->assign('temp', 'value', $tempGrados . "º");
        $resp->alert("Ciudad si");
    }
    
    return $resp;
}

// function vCiudadViento($ciudad) {
//     $resp = jaxon()->newResponse();

//     // if (!validar($ciudad)) {
//     //     $resp->alert("Ciudad errónea, revísela!!");
//     //     return $resp;
//     // }

//     $datos   = new Temperatura($ciudad);
//     $tiempo  = $datos->getTiempo();
//     //var_dump($tiempo);
//     if (($tiempo['cod'])==404) {
//         $resp->assign('wind', 'value', "ciudad no encontrada");
//     }else{   
//         $viento = $tiempo['wind']['speed'];
//         $resp->assign('wind', 'value', $viento . "m/s");

//     }
    
//     return $resp;
// }

// function validar($ciudad)
// {
//     if (strlen($ciudad) == 0 || is_numeric($ciudad)) return false;
//     return true;
// }

$jaxon->register(Jaxon::CALLABLE_FUNCTION, 'vCiudadTemperatura');
//$jaxon->register(Jaxon::CALLABLE_FUNCTION, 'vCiudadViento');

if($jaxon->canProcessRequest())  $jaxon->processRequest();
