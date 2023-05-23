<?php
// [JAXON-PHP]

require 'Temperatura.php';

require(__DIR__ . '/../vendor/autoload.php');

use Jaxon\Jaxon;
use function Jaxon\jaxon;
use Jaxon\Response\Response;

$jaxon = jaxon();

function vCiudad($ciudad) {
    $resp = jaxon()->newResponse();

    if (!validar($ciudad)) {
        $resp->alert("Ciudad errónea, revísela!!");
        return $resp;
    }

    $datos   = new Temperatura($ciudad);
    $tiempo  = $datos->getTiempo();
    //var_dump($tiempo);
    if (($tiempo['cod'])==404) {
        $resp->assign('temp', 'value', "ciudad no encontrada");
    }else{
        $temp    = $tiempo['main']['temp'];
        $viento = $tiempo['wind']['speed'];
        // $humedad = $tiempo['main']['humidity'];
        // $tiem    = $tiempo['weather'][0]['description'];
        $tempGrados = $temp - 273.15;
        $resp->assign('temp', 'value', $tempGrados . "º");
        $resp->assign('wind', 'value', $viento . "m/s");

    }
    
    return $resp;
}

function validar($ciudad)
{
    if (strlen($ciudad) == 0 || is_numeric($ciudad)) return false;
    return true;
}

$jaxon->register(Jaxon::CALLABLE_FUNCTION, 'vCiudad');

if($jaxon->canProcessRequest())  $jaxon->processRequest();
