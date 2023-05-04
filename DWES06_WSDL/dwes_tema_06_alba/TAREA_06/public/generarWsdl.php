<?php
require '../vendor/autoload.php';
/*A partir de una clase que nosotros le indiquemos, nos va a generar un fichero wsdl con las funciones de la clase
y la información de los comentarios de cada función. Sólo se realiza una vez*/
//para generar el fichero wsdl que nos indica las listas de funciones, sus parámetros y sus tipos
use PHP2WSDL\PHPClass2WSDL; //utiliza PHP2WSDL para generar el fichero a partir de Clases\\Operaciones

$class = "Clases\\Operaciones";
$uri = 'http://127.0.0.1/dwes_tema_06_alba/TAREA_06/servidorSoap/servicioW.php';
$wsdlGenerator = new PHPClass2WSDL($class, $uri); //necesita la clase y el servidor
$wsdlGenerator->generateWSDL(true);
$fichero = $wsdlGenerator->save('../servidorSoap/servicio.wsdl'); //donde lo va a guardar (carpeta y nombre)

//para que nos genere el servivio.wsdl le damos a ejecutar y depurar
//desde el navegador vamos a la carpeta principal > generarWsdl.php y ya lo genera
