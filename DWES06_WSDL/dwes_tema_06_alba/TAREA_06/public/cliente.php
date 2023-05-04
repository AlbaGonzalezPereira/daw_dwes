<?php
$url = 'http://127.0.0.1/dwes_tema_06_alba/TAREA_06/servidorSoap/servicioW.php'; //se hace llamada a este servicio que se crea
$uri = 'http://127.0.0.1/dwes_tema_06_alba/TAREA_06/servidorSoap';


try {
    //SoapClient el primer parámetro es nulo ya que no necesita ningún wsdl porque ya sabe el nombre de las funciones
    $cliente = new SoapClient(null, ['location' => $url, 'uri' => $uri]);
} catch (SoapFault $f) {
    die("Error en cliente SOAP:" . $f->getMessage());
}
$codP = 2; //parámetro de código de producto
$codT = 14; //parámetro de código de tienda
$codF = 'CONSOL'; //parámetro de código de familia

//funcion getPvp ----------------------------------------------------------------------------
//hacemos una petición al servidor, llamando a la función getPvp y va a devolver el precio (pvp)
$pvp = $cliente->__soapCall('getPvp', ['id' => $codP]); //hace el soapCall con el nombre de la función que ya conoce
$precio = ($pvp == null) ? "No existe es Producto" : $pvp; //operador ternario: si es verdero (null) sale "No existe es Producto"
echo "Código de producto de Código $codP: $precio"; //visualiza el resultado


//funcion getFamilias -----------------------------------------------------------------------
echo "<br>Código de Familas";
//obtiene todas las familias
$familias = $cliente->__soapCall('getFamilias', []); //cuando no se le pasa ningún parámetro hay que pasarle un array vacío
echo "<ul>"; //abre lista desordenada
foreach ($familias as $k => $v) {//hace una lista con todas las familias
    echo "<code><li>$v</li></code>";
}
echo "</ul>";

//funcion getProductosFamila ----------------------------------------------------------------
$productos = $cliente->__soapCall('getProductosFamilia', ['codF' => $codF]); //1º parámetro: nombre de la función, 2º parámetro: un array
echo "<br>Productos de la Famila $codF:";
echo "<ul>";
foreach ($productos as $k => $v) { //hace una lista con todos los productos
    echo "<code><li>$v</li></code>";
}
echo "</ul>";

// funcion getStock -------------------------------------------------------------------------
$unidades = $cliente->__soapCall('getStock', ['codP' => $codP, 'codT' => $codT]); //llamada al método getStock, el cual devuelve el Stock dado un código del producto y el código de la tienda
echo "<br>Unidades del producto de código; $codP en la tienda de código: $codT: $unidades"; //muestra las unidades del producto de esa tienda
