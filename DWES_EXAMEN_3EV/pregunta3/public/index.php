<?php
// // [JAXON-PHP]

// // Preparamos Jaxon:
// require (__DIR__ . '/include/VerTemperatura.php');

// use function Jaxon\jaxon;

// // Procesar la solicitud
// if($jaxon->canProcessRequest())  $jaxon->processRequest();

?><?php
// EXAMEN 3º AVALIACION DWES

require '../vendor/autoload.php';

use Clases\Clases1\ClasesOperacionesService;

$url = 'http://127.0.0.1/pregunta3/servidorSoap/servicio.wsdl';
try {
    $cliente = new SoapClient($url);
} catch (SoapFault $f) {
    die("Error en cliente SOAP:" . $f->getMessage());
}

$codP = 2;
$codT = 1;
$codF = 'MP3';

//---------------------------------------------------------------------------------------
$objeto = new ClasesOperacionesService();


//funcion getPvp ------------------------------------------------------------------------
$pvp = $objeto->getPvp($codP);
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


/**************************************PREGUNTA 3b)******************************************* */
// funcion getCiudadTienda ---------------------------------------------------------------------
$ciudad = $objeto->getCiudadTienda($codT);//usamos ya el código declarado
echo "<br>La ciudad de la tienda con id $codT es $ciudad";



/**************************************PREGUNTA 3c)******************************************** */
// echo "<script>
// // [JAXON-PHP]
// function envTemp(c) {
//     let ciudad = c;
    
//     // llamamos por AJAX al php:
//     jaxon_vCiudadTemperatura(ciudad);
    
//     // anulamos la acción por defecto del formulario:
//    return false;
// }
// </script>";
// echo "<button type='button' class='btn btn-warning' onclick='envTemp($ciudad);'>Ver datos</button>"; 

// $jaxon = jaxon();
// echo $jaxon->getCss(), "\n", $jaxon->getJs(), "\n", $jaxon->getScript(), "\n";
// echo "<!-- HTTP comment  -->\n";
