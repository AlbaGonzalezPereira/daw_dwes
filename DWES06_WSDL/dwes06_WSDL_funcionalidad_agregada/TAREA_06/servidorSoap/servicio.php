<?php
require '../vendor/autoload.php';
/** Va a crear un soapServer con las funciones de la clase Operaciones*/

$uri = "http://127.0.0.1/dwes06_WSDL_funcionalidad_agregada/TAREA_06/servidorSoap";
$parametros = ['uri' => $uri];

try {
    $server = new SoapServer(NULL, $parametros);//crea un objeto SoapServer (el servidor)
    /**NULL: especifica que no se va a utilizar ningún archivo WSDL para definir la estructura de los servicios web. 
     * En su lugar, los métodos y argumentos de los servicios web se definirán en código PHP. */
    $server->setClass('Clases\Operaciones');//indica la clase (en este caso Operaciones) en la que están las funciones o métodos que se expondrán como servicios web
    $server->handle();//inicia el servidor SOAP y espera las solicitudes de los clientes
} catch (SoapFault $f) {
    die("error en server: " . $f->getMessage());
}
