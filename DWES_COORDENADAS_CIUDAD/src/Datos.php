<?php
require 'Coordenadas.php';

require(__DIR__ . '/../vendor/autoload.php');

use Jaxon\Jaxon;
use function Jaxon\jaxon;
use Jaxon\Response\Response;

$jaxon = jaxon();

/**
 * Función que nos devuelve una localización dada una latitud y longitud
 */
function getLocalizacion($la, $lo)  {
    $resp = jaxon()->newResponse();

    if (!validar($la, $lo)) {
        $resp->alert("Coordenada erróneas, revíselas");
        return $resp;
    }

    $datos     = new Coordenadas($la, $lo);
    $ubicacion = $datos->getLocalizacion();
    $dir       = $ubicacion['formattedAddress'];
    $ciudad    = $ubicacion['locality'] . ", ". $ubicacion['adminDistrict2'];
    $pais      = $ubicacion['countryRegion'];
    
    $resp->assign('resultado', 'innerHTML', 'direccion: '.$dir.', ciudad: '.$ciudad . ', país: ' . $pais);

    return $resp;
}

/**
 * Función que nos valida las coordenadas
 */
function validar($a, $b)
{
    if (strlen($a) == 0 || strlen($b) == 0 || !is_numeric($a) || !is_numeric($b)) return false;
    return true;
}

$jaxon->register(Jaxon::CALLABLE_FUNCTION, 'getLocalizacion');

if($jaxon->canProcessRequest())  $jaxon->processRequest();
