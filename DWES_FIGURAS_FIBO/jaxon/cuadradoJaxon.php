<?php
session_start();

/*************************************JAXON************************************* */
//1.- Incluimos las librerias Jaxon
//require(__DIR__ . '/vendor/autoload.php');
require 'vendor/autoload.php';

use function Jaxon\jaxon;
use Jaxon\Jaxon;

//2.- Creamos las funciones de validación que serán lammadas desde JS
/**
 * Función que nos dibuja un cuadrado
 */
function dibujarCuadrado($entero)
{
    //declaramos las variables para usar en el for
    $i = 1;
    $fibos = []; //array de calcular los fibos
    $datos = "<pre>";
    //Usamos un for para que guarde los datos de la serie fibonacci
    for ($fila = 1; $fila <= $entero; $fila++) {
        for ($columna = 1; $columna <= $entero; $columna++) {
            if ($fila === 1 || $fila === $entero || $columna === 1 || $columna === $entero) {
                $fibos[$i - 1] = calcularFibonacciRecursiva($i);
                $i++;
            }
        }
    }
    //Para calcular el número de cifras del último número de la serie, es decir
    //el número máximo:
    $max = strlen($fibos[count($fibos) - 1]);
    //var_dump($max); //comprobamos

    //Para visualizar la serie fibonacci en un cuadrado:
    $i = 0;
    $fibosPuntitos = calcularPuntos($fibos, $max);
    //var_dump($fibosPuntitos); //comprobamos
    for ($fila = 1; $fila <= $entero; $fila++) {
        for ($columna = 1; $columna <= $entero; $columna++) {
            if ($fila === 1 || $fila === $entero || $columna === 1 || $columna === $entero) {
                $datos .= $fibosPuntitos[$i];
                $i++;
            } else {
                for ($k = 0; $k <= $max; $k++) {
                    $datos .= ' ';
                }
            }
        }
        $datos .= '<br>';
    }
    $datos .= "</pre>";
    return $datos;
}

/**
 * Función que nos muestra un cuadrado si hay un rombo pintado
 */
function mostrarCuadrado($entero)
{
    $resp = jaxon()->newResponse();
    $cuadrado = dibujarCuadrado($entero);
    $resp->assign('texto', 'innerHTML', $cuadrado);
    return $resp;
}

/**
 * función que calcula el clima de una ciudad
 */
function calcularClima($ciudad)
{
    $resp = jaxon()->newResponse();
    $resp->assign('resultadoClima', 'value', $ciudad);
    return $resp;

}

/**
 * Función que muestra el clima de una ciudad y lo visualiza en el input con id="resultadoClima"
 */
function mostrarClima($ciudad)
{
    $resp = jaxon()->newResponse();
    if (comprobarCiudad($ciudad)) {
        $clima = calcularTemperatura($ciudad); //llamamos a la función
        // $resp->alert("Probando clima");
        if (($clima['cod']) == 404) { //si la ciudad no fue encontrada,mostramos una alerta con el mensaje
            //$resp->alert("Ciudad no");//comprobamos donde entra
            $resp->assign('resultadoClima', 'value', 'ciudad no encontrada'); //asigna valor
        } else {
            $temp = $clima['main']['temp']; //accedemos al jaxon
            $tempGrados = $temp - 273.15; //convertimos a grados
            $resp->assign('resultadoClima', 'value', $tempGrados . "º"); //asigna valor
            //$resp->alert("Ciudad si");//comprobamos donde entra
        }
        //$resp->alert("Ciudad si");//comprobamos
        //return $resp;
    } else {
        $resp->alert("Introduzca una ciudad correcta"); //si introduce una ciudad incorrecta
    }
    return $resp;
}

/**
 * función que calcula la temperatura de una ciudad
 */
function calcularTemperatura($ciudad)
{
    // Preparar datos acceso a consulta REST tiempo:
    $urlTemperatura = 'https://api.openweathermap.org/data/2.5/weather?';
    $keyOpenWeatherMap = '6f7dc4624ba4740af695556d6945a5b8';
    $urlCompleto = $urlTemperatura . 'q=' . $ciudad . '&limit=5' . "&appid=" . $keyOpenWeatherMap; //creamos la url

    $opciones = array(
        CURLOPT_URL => $urlCompleto,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache",
        ),
    );

    $ch = curl_init();
    curl_setopt_array($ch, $opciones);
    $respuesta = curl_exec($ch);
    curl_close($ch);
    $salida = json_decode($respuesta, true);
    return $salida;
}

/**
 * Función que nos comprueba si la ciudad introducida cumple con una posible ciudad española
 */
function comprobarCiudad($ciudad)
{
    $regex = "/^[A-ZÑÁÉÍÓÚÜñáéíóúü ]+$/i";
    if (preg_match($regex, $ciudad) == 1) { // preg_match devuelve 1 o 0
        return true;
    } else {
        return false;
    }
}

//3.- Creamos el objeto jaxon
$jaxon = jaxon();

// Podemos incluir las opciones que queramos
$jaxon->setOption('js.app.minify', false);
$jaxon->setOption('core.decode_utf8', true);
$jaxon->setOption('core.debug.on', false);
$jaxon->setOption('core.debug.verbose', false);

// 4.- Registramos la función que vamos a llamar desde JavaScript
$jaxon->register(Jaxon::CALLABLE_FUNCTION, 'mostrarCuadrado', ['mode' => "'asynchronous'"]);
$jaxon->register(Jaxon::CALLABLE_FUNCTION, 'mostrarClima', ['mode' => "'asynchronous'"]);

// 5.- El método processRequest procesa las peticiones que llegan a la página
// Debe ser llamado antes del código HTML
if ($jaxon->canProcessRequest()) {
    $jaxon->processRequest();
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="clima.js" defer></script>
    <title>DWES-PHP-B03-04</title>
</head>
<body >

    <form action="<?php echo $_SERVER['PHP_SELF'] ?>"  method="get">
<?php
/*************************FIBONACCI********************************* */

/**
 * Función que calcula la serie Fibonacci de la posición de un número
 */
function calcularFibonacciRecursiva($termino)
{
    if ($termino < 2) {
        return $termino;
    } else {
        return calcularFibonacciRecursiva($termino - 1) + calcularFibonacciRecursiva($termino - 2);
    }
}

//función que calcula los puntos que hay que añadir a cada número de la serie fibonacci, que se guardarán
//en un array
function calcularPuntos($fibos, $max)
{
    $fibosFinal = [];
    $numPuntos;
    for ($n = 0; $n < count($fibos); $n++) {
        $numPuntos = $max - strlen($fibos[$n]); //calcula el número de puntos a añadir
        $fibosFinal[$n] = '';
        for ($p = 0; $p < $numPuntos; $p++) {
            $fibosFinal[$n] .= '.';
        }
        $fibosFinal[$n] .= $fibos[$n] . ' ';
    }
    return $fibosFinal;
}
if (isset($_GET['reset'])) {
    unset($_SESSION['rombo']);
}
/***************************************************************************************** */
$entero = empty($_GET['entero']) ? "" : intval($_GET['entero']);
if (!isset($_SESSION['rombo'])) {
    echo <<<MARCA
    <p>
        <label for="entero">Introduzca un entero positivo de 1 a 20:</label>
        <input type="number" id="entero" name="entero" value="{$entero}" />
    </p>
MARCA;
} else {
    echo <<<MARCA
    <p>
        <label for="entero">Introduzca un entero positivo de 1 a 20:</label>
        <input type="number" id="entero" name="entero" value="{$_SESSION['rombo']}" />
    </p>
MARCA;
}
/**************************************DIBUJAR ROMBO***************************************** */
if (isset($_GET['enviar']) || isset($_SESSION['rombo']) || isset($_GET['persistir'])) {
    if (isset($_SESSION['rombo']) && !isset($_GET['enviar'])) {
        $entero = $_SESSION['rombo'];
    }

    $regex = "/^(1[0-9]|20|[1-9])$/"; //expresión regular que valida un número entero entre 1 y 20
    if (preg_match($regex, $entero) == 1) { // preg_match devuelve 1 o 0
        if (isset($_GET['persistir'])) {
            $_SESSION['rombo'] = $entero; //para persistir la serie fibonacci
        }

        echo "<pre style=\"font-family: monospace\">";
        $medio = floor($entero / 2) + 1;
        $encontrado = true;
        $i = 1;
        $fibos = []; //array de calcular los fibos

        // Dibujar parte superior rombo:
        for ($fila = 1; $fila <= $medio; $fila++) {
            for ($columna = 1; $columna <= $medio + $fila - 2; $columna++) {
                if (($columna > $medio - $fila) && ($columna < $medio + $fila)) {
                    if ($encontrado) { //si encontró un '*'
                        $fibos[$i - 1] = calcularFibonacciRecursiva($i); //para que nos ponga el número fibonacci
                        $i++;
                        $encontrado = false;
                    }
                }
            }
            $encontrado = true;
            $fibos[$i - 1] = calcularFibonacciRecursiva($i); //para que nos ponga el número fibonacci
            $i++;
        }

        // Dibujar parte inferior rombo:
        for ($fila = $medio - 1; $fila >= 1; $fila--) {
            for ($columna = 1; $columna <= $medio + $fila - 2; $columna++) {
                if (($columna > $medio - $fila) && ($columna < $medio + $fila)) {
                    if ($encontrado) { //si encontró un '*'
                        $fibos[$i - 1] = calcularFibonacciRecursiva($i); //para que nos ponga el número fibonacci
                        $i++;
                        $encontrado = false;
                    }
                }
            }
            $encontrado = true;
            $fibos[$i - 1] = calcularFibonacciRecursiva($i); //para que nos ponga el número fibonacci
            $i++;
        }

        //Para calcular el número de cifras del último número de la serie, es decir
        //el número máximo:
        $max = strlen($fibos[count($fibos) - 1]);
        //var_dump($max); //comprobamos

        //Para visualizar la serie fibonacci en un cuadrado:
        $i = 0;
        $fibosPuntitos = calcularPuntos($fibos, $max);
        // Dibujar parte superior rombo:
        for ($fila = 1; $fila <= $medio; $fila++) {
            for ($columna = 1; $columna <= $medio + $fila - 2; $columna++) {
                if (($columna > $medio - $fila) && ($columna < $medio + $fila)) {
                    if ($encontrado) { //si encontró un '*'
                        //echo '*';
                        echo $fibosPuntitos[$i++]; //que nos dibuje los puntitos
                        $encontrado = false;
                    } else {
                        //echo ' ';
                        for ($k = 0; $k <= $max; $k++) {
                            echo ' ';
                        }
                    }

                } else {
                    // echo ' ';
                    for ($k = 0; $k <= $max; $k++) {
                        echo ' ';
                    }
                }
            }
            $encontrado = true;
            echo $fibosPuntitos[$i++]; //que nos dibuje los puntitos
            echo '<br>';
            //echo '*<br>';
        }

        // Dibujar parte inferior rombo:
        for ($fila = $medio - 1; $fila >= 1; $fila--) {
            for ($columna = 1; $columna <= $medio + $fila - 2; $columna++) {
                if (($columna > $medio - $fila) && ($columna < $medio + $fila)) {
                    if ($encontrado) {
                        // echo '*';
                        echo $fibosPuntitos[$i++]; //que nos dibuje los puntitos
                        $encontrado = false;
                    } else {
                        //echo ' ';
                        for ($k = 0; $k <= $max; $k++) {
                            echo ' ';
                        }
                    }

                } else {
                    //echo ' ';
                    for ($k = 0; $k <= $max; $k++) { //nos dibuje los espacios dependiendo del tamaño máximo del fibonacci
                        echo ' ';
                    }
                }
            }
            $encontrado = true;
            // echo '*<br>';
            echo $fibosPuntitos[$i++]; //que nos dibuje los puntitos
            echo '<br>';
        }

        /************************************************************************************* */

        echo "</pre>";
    } else {
        echo <<<MARCA
            <p style="color: red">Introduzca el entero IMPAR solicitado (1-20), por favor</p>
            <p id="digitos">&nbsp;</p>
        MARCA;

    }
}

//En caso de darle a reset que me dirija al index
if (isset($_GET['reset'])) {
    header("location: cuadradoJaxon.php");
    die();
}

//cando le damos a borrar, cerramos la sesión. IMPORTANTE, ponerlo abajo

?>
        <button id="botonEnviar" type="submit" name="enviar">Enviar</button>
        <button id="botonReset" name="reset">Reset</button>
        <button id ="botonPersistir" name="persistir">Persistir</button>
        <button id="botonAlerta" name="alerta" onClick="jaxon_mostrarCuadrado(<?php echo $entero; ?>);return false;">Mostrar cuadrado</button>
        <!--<button id="botonClima" onClick="jaxon_mostrarClima(); return false;">Mostrar clima</button>-->
        <button id="botonClima" onClick="muestraClima(); return false;">Mostrar clima</button>

        <br>
        <label for="resultadoClima">Resultado</label>
        <input type="text" id="resultadoClima" readonly/><br>
        <label for="ciudad">Ciudad</label>
        <input type="text" id="ciudad" />
        <br>
        <div id ="texto"></div>
    </form>
</body>
<?php
// 6.- Injectamos los scripts javascript antes de enviar la página:
$jaxon = jaxon();
echo $jaxon->getCss(), "\n", $jaxon->getJs(), "\n", $jaxon->getScript(), "\n";
echo "<!-- HTTP comment  -->\n"
?>
</html>