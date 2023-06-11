<?php
// [JAXON-PHP]

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
 * Función que valida el usuario y la contraseña y almacena el nombre de usuario en la sesión de PHP.
 * @param $u,$p - usuario y contraseña
 */
function cUsuario($u, $p)  {
    $resp = jaxon()->newResponse(); //creamos un objeto respuesta
    if (strlen($u) == 0 || strlen($p) == 0) {//si el nombre de usuario o la contraseña tienen una longitud igual a cero
        $resp->call('noRegistrado');//llama a la función noRegistrado del archivo registrar.js
    } else {  
        $usuario = new Usuario();//nos crea la conexión con la tabla usuarios
        if(!$usuario->existe($u)){
        $usuario->setUsuario($u);//modificamos el usuario
        $usuario->setPass($p);//modificamos la contraseña
        $usuario->create();//llama al método create para crear un usuario con los datos anteriores
        $resp->call('registrado');//llama a la función registrado() que nos abre una alerta
        }else{
            $resp->call('yaExiste');//llama a la función registrado() que nos abre una alerta   
        }
        $usuario = null;//cierra la conexión
    }
    return $resp;//devuelve la respuesta de registrar
}

$jaxon->register(Jaxon::CALLABLE_FUNCTION, 'cUsuario');//hace que sea accesible esa función desde el lado del cliente(javascript)
