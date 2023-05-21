<?php

require 'Coordenadas.php';
require(__DIR__ . '/../vendor/autoload.php');

use Jaxon\Jaxon;
use function Jaxon\jaxon;
use Jaxon\Response\Response;

$jaxon = jaxon();

/**
 * Función que devuleve las coordenadas
 * @return $resp - respuesta jaxon
 */
function getCoordenadas($dir) {
    $resp = jaxon()->newResponse(); //creamos una respuesta de Jaxon
    $dir  = trim($dir); //elimina los espacios

    //comprueba si son coordenadas válidas
    if (strlen($dir) < 4) {
        $resp->alert("Coordenadas no válidas!!!");
        
        return $resp;
    }

    $c   = new Coordenadas($dir);
    $lat = $c->getCoordenadas()[0];
    $lon = $c->getCoordenadas()[1];
    $alt = $c->getCoordenadas()[2] . " mts.";

    //asignamos los valores de latitud, longitud y altitud
    $resp->assign('lat', 'value', $lat);
    $resp->assign('lon', 'value', $lon);
    $resp->assign('alt', 'value', $alt);
    
    return $resp;//devuelve la respuesta de jaxon
}

/**
 * función que ordena los puntos de envío
 * @return $resp - respuesta jaxon
 */
function ordenarEnvios($puntos, $id) {
    $resp = jaxon()->newResponse();//creamos una respuesta de jaxon

    if (strlen(trim($puntos)) == 0) {
        $resp->alert("Puntos no válidos");
        return $resp;
    }

    $c     = new Coordenadas();
    $datos = $c->ordenarEnvios($puntos);

    // Usando AJAX (a través de Jaxon), invocamos el método javascript obtivimosDatos
    $datosRespuesta = array( 'respuesta' => $datos, 'id' =>$id);
    $resp->call('obtuvimosDatos', $datosRespuesta);
    
    return $resp;
}

//registramos esas funciones para que se puedan invocar desde el lado del cliente, las cuales están en el archivo funciones.js
$jaxon->register(Jaxon::CALLABLE_FUNCTION, 'getCoordenadas');
$jaxon->register(Jaxon::CALLABLE_FUNCTION, 'ordenarEnvios');

if($jaxon->canProcessRequest())  $jaxon->processRequest();