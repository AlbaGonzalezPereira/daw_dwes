<?php
// [JAXON-PHP]
spl_autoload_register(function ($clase) {
    include $clase . ".php";
});

require (__DIR__ . '/../vendor/autoload.php');

//incluimos los archivos jaxon
use Jaxon\Jaxon;
use function Jaxon\jaxon;

$jaxon = jaxon();

/**
 * función que nos permite votar y elegir el un número de estrellas que queremos añadir a un producto
 * @param $u,$p,$c - usuario, contraseña y número de estrellas
 * @return $resp - la respuesta del jaxon
 */
function miVoto($u, $p, $c) {
    $resp = jaxon()->newResponse();//creamos una respuesta jaxon

    if (strlen($u) == 0 || strlen($p) == 0) {//si el usuario o la clave son ==0
        $resp->alert("Ni el usuario ni el producto pueden estar vacíos!!!");//sale una alerta
    } else {
        $voto = new Voto();//creamos un objeto Voto
        
        if ($voto->puedeVotar($u, $p)) {//si puedeVotar es verdadero, llama a todos esos métodos
            $voto->setIdPr($p);
            $voto->setIdUs($u);
            $voto->setCantidad($c);
            $voto->create();
            
            // Usando AJAX (a través de Jaxon), invocamos el método javascript votoValido
            $datosRespuesta = array( 'pro' => $p, 'media' => $voto->getMedia($p));
            $resp->call('votoValido', $datosRespuesta);
        } else {
            $resp->alert("Ya has votado ese producto !!!");//lanza una alerta
        }

        $voto = null;//cierra la conexión
    }

    return $resp;//devuelve la respuesta jaxon
}

/**
 * función que dibuja las estrellas del producto seleccionado
 * @param $c,$p - cantidad y producto
 */
function pintarEstrellas($c, $p) {
    $voto      = new Voto();//creamos un objeto de la clase Voto
    $total     = $voto->getTotalVotos($p); //llamamos al método getTotalVotos($p) de la clase Voto
    $voto      = null;

    $resp      = jaxon()->newResponse();//creamos una respuesta jaxon
    $en        = intval($c);//ponemos $c como entero
    $dec       = $c - $en;
    $estrellas = "$total Valoraciones. ";

    if ($en > 0) {//para pintar la estrella entera o mitad
        for ($i = 1; $i <= $en; $i++) {
            $estrellas .= "<i class='fas fa-star'></i>";
        }
        if ($dec >= 0.5)
            $estrellas .= "<i class='fas fa-star-half-alt'></i>";
    }

    $resp->assign("votos_$p", "innerHTML", $estrellas);//modifica el html poniendo el número de estrellas
    
    return $resp;//devuelve la respuesta jaxon
}

//se llaman a las funciones desde votar.js
$jaxon->register(Jaxon::CALLABLE_FUNCTION, 'miVoto');
$jaxon->register(Jaxon::CALLABLE_FUNCTION, 'pintarEstrellas');

