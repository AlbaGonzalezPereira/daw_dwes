<?php

/**
 * Función que calcula la serie Fibonacci de la posición de un número
 */
function calcularFibonacciRecursiva ($termino) {
    if ( $termino < 2 ) {
        return $termino;
    } else {
        return  calcularFibonacciRecursiva($termino - 1) + calcularFibonacciRecursiva($termino - 2);
    }
}

//función que calcula los puntos que hay que añadir a cada número de la serie fibonacci, que se guardarán
//en un array
function calcularPuntos($fibos,$max){
    $fibosFinal = [];
    $numPuntos;
    for ($n=0; $n < count($fibos) ; $n++) { 
        $numPuntos = $max - strlen($fibos[$n]);//calcula el número de puntos a añadir
        $fibosFinal[$n] = '';
        for ($p=0; $p < $numPuntos; $p++) { 
            $fibosFinal[$n] .= '.';
        }
        $fibosFinal[$n].=$fibos[$n].' ';  
    }
    return $fibosFinal;
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DWES-PHP-B02-09</title>
</head>
<body >

    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="get">
<?php

    $entero = empty($_GET['entero']) ? "": intval($_GET['entero']);
    echo <<<MARCA
    <p>
        <label for="numero">Introduzca un entero positivo del 1 al 8:</label>
        <input type="number"  min="1" max="8" step="1"  id="numero" name="entero" value="{$entero}" />

    </p>
MARCA;

if(!isset($_GET['reset'])){ //para que funcione el reset. Si nos da igual lo sacamos
    $segundaVez = false;
    if ( !isset($_GET['primeraVez']) ) {
        echo '<input type="hidden"  name="primeraVez" value="true" />';
    } else {
        $segundaVez = true;
    }

    if ( $entero === "" || $entero < 1 || $entero > 8 )  {  // el html también se encarga de comprobar rango, pero lo hacemos para asegurarnos
        if ($segundaVez) {
            echo <<<MARCA
            <p style="color: red">¡¡Introduzca el entero solicitado (1-8), por favor!!</p>
            <p id="digitos">&nbsp;</p>
MARCA;
        }
    } else {
        echo "<pre style=\"font-family: monospace\">";
        //declaramos las variables para usar en el for
        $i = 1;
        $fibos=[]; //array de calcular los fibos 
        //Usamos un for para que guarde los datos de la serie fibonacci
        for ($fila = 1; $fila <= $entero; $fila++) {
            for ($columna = 1; $columna <= $entero; $columna++) {
                if ( $fila === 1 || $fila === $entero || $columna === 1 || $columna === $entero ) {
                    $fibos[$i-1]=calcularFibonacciRecursiva($i);
                    $i++;
                } 
            } 
        }
        //Para calcular el número de cifras del último número de la serie, es decir
        //el número máximo:
        $max = strlen($fibos[count($fibos)-1]);
        //var_dump($max); //comprobamos

        //Para visualizar la serie fibonacci en un cuadrado:
        $i=0;
        $fibosPuntitos=calcularPuntos($fibos,$max);
        //var_dump($fibosPuntitos); //comprobamos
        for ($fila = 1; $fila <= $entero; $fila++) {
            for ($columna = 1; $columna <= $entero; $columna++) {
                if ( $fila === 1 || $fila === $entero || $columna === 1 || $columna === $entero ) {
                    echo $fibosPuntitos[$i];
                    $i++; 
                } else {
                    for ($k=0; $k <= $max; $k++) { 
                        echo ' ';
                    }    
                }
            }
            echo '<br>';
        }      
        echo "</pre>";
    }
}
?>
        <button id="botonEnviar" type="submit">Enviar</button>      
        <button id="botonReset" name="reset">Reset</button> 
    </form>
</body>
</html>
