<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    header("location: romboPersistir.php");
    die();
}

//cando le damos a borrar, cerramos la sesión. IMPORTANTE, ponerlo abajo

?>
        <button id="botonEnviar" type="submit" name="enviar">Enviar</button>
        <button id="botonReset" name="reset">Reset</button>
        <button id ="botonPersistir" name="persistir">Persistir</button>
    </form>
</body>
</html>