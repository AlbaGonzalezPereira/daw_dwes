<?php
require '../vendor/autoload.php';

use Clases\Clases1\ClasesOperacionesService;

$url = 'http://127.0.0.1/dwes_tema_06_alba/TAREA_06/servidorSoap/servicio.wsdl';

/*********************************** COMENTARIO SOBRE clienteW2.php *************************************************/

/* La diferencia entre clienteW2.php y cliente.php y clienteW.php es que para la implementación del código de la primera (clienteW2.php)
utilizamos un objecto de la clase ClasesOperacionesService. Con dicho objeto, llamamos a las funciones correspondientes, dependiendo 
de los resultados que queramos obtener. Utliza servicio.wsdl pero no utilizamos el método soapCall, ya que llamamos ditrectamente a 
los métodos de la clase ClasesOperacionesService*/

try {
    $cliente = new SoapClient($url); //le pasamos el wsdl
} catch (SoapFault $f) {
    die("Error en cliente SOAP:" . $f->getMessage());
}

$codP = 2;
$codT = 1;
$codF = 'MP3';

//---------------------------------------------------------------------------------------
$objeto = new ClasesOperacionesService(); //creamos un objeto de la clase ClasesOperacionesService para trabajar con ella

//trabajamos todos los métodos a partir de la clase generada del wsdl:
//funcion getPvp ------------------------------------------------------------------------
$pvp = $objeto->getPvp($codP); //llama al método getPvp del objeto de la clase ClasesOperacionesService y lo recoge en la variable pvp
$precio = ($pvp == null) ? "No existe es Producto" : $pvp;
echo "Código de producto de Código $codP: $precio";


//funcion getFamilias -------------------------------------------------------------------
echo "<br>Códigos de Familas:";
$prueba = $objeto->getFamilias();
echo "<ul>";
foreach ($prueba as $k => $v) {
    echo "<code><li>$v</li></code>";
}
echo "</ul>";


//funcion getProductosFamila ------------------------------------------------------------
$productos = $objeto->getProductosFamilia($codF);
echo "<br>Productos de la Famila $codF:";
$prueba = $objeto->getProductosFamilia($codF);
echo "<ul>";
foreach ($prueba as $k => $v) {
    echo "<code><li>$v</li></code>";
}
echo "</ul>";


// funcion getStock ---------------------------------------------------------------------
$unidades = $objeto->getStock($codP, $codT);
echo "<br>Unidades del producto de código $codP en la tienda de código $codT: $unidades";
