<?php
// [JAXON-PHP]
require 'Conexion.php';
require 'Usuario.php';
require (__DIR__ . '/../vendor/autoload.php');

//incluimos los archivos jaxon
use Jaxon\Jaxon;
use function Jaxon\jaxon;

$jaxon = jaxon();//creamos un objeto jaxon

// Opciones de configuración Jaxon: 
$jaxon->setOption('js.app.minify', false);
$jaxon->setOption('core.decode_utf8', true);
$jaxon->setOption('core.debug.on', false);
$jaxon->setOption('core.debug.verbose', false);

/**
 * Función que valida el usuario y la contraseña y almacenar el nombre de usuario en la sesión de PHP.
 * @param $u,$p - usuario y contraseña
 */
function vUsuario($u, $p)  {
    $resp = jaxon()->newResponse(); //creamos un objeto respuesta
    if (strlen($u) == 0 || strlen($p) == 0) {//si el nombre de usuario o la contraseña tienen una longitud igual a cero
        $resp->call('noValidado');//llama a la función noValidado del archivo validar.js
    } else {
        $usuario = new Usuario();//nos crea la conexión con la tabla usuarios
        if (!$usuario->isValido($u, $p)) {//comprueba si el usuario y la contraseñas son válidos
            $resp->call('noValidado');//llama a la función noValidado()
        } else {
            session_start();//inicia la sesión
            $_SESSION['usu'] = $u;//sesión de usuario
            $resp->call('validado');//llama a la función validado() que nos abrirá listado.php
        }
        $usuario = null;//cierra la conexión
    }
    return $resp;//devuelve la respuesta de validar
}

$jaxon->register(Jaxon::CALLABLE_FUNCTION, 'vUsuario');//hace que sea accesible esa función desde el lado del cliente(javascript)
