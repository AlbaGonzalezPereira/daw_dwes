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

//declaramos las funciones
function calcularSerieFibo($termino){
    $fib1 = 0;
    $fib2 = 1;
    $i = 2;

while ($i <= $termino) {
    $temp = $fib2;
    $fib2 += $fib1;
    $fib1 = $temp;
    $i++;
}

return $termino > 1 ? $fib2 : 1;

}

function numeroDeTerminos($terminoRombo){
$cont=0;
$medio = floor($terminoRombo / 2) + 1;
        // Dibujar parte superior rombo:
        for ($fila = 1; $fila <= $medio; $fila++) {
            for ($columna = 1; $columna <= $terminoRombo; $columna++) {
                if ( ($columna > $medio - $fila) && ($columna < $medio + $fila) ) {
                    $cont++;
                } 
            }
        
        }

        // Dibujar parte inferior rombo:
        for ($fila = $medio - 1 ; $fila >= 1; $fila--) {
            for ($columna = 1; $columna <= $terminoRombo; $columna++) {
                if ( ($columna > $medio - $fila) && ($columna < $medio + $fila ) ) {
                    
                    $cont++;
                } 
            }
           
        }   
        return $cont;     

}

function longitudUltimoTerminoFibo($terminoRombo){
    $cont=numeroDeTerminos($terminoRombo);
    $digitos=strlen(calcularSerieFibo($cont));
    return $digitos;
}

function imprimirFiboConFormato($fibonacci, $anchocampo){
    $diferencia=strlen($fibonacci) - $anchocampo;
    $cadena = "";
    for ($i=0; $i < $diferencia; $i++) { 
        $cadena.="-";
        # code...
    }
    return $cadena.$fibonacci;


}

    $entero = empty($_GET['entero']) ? "": intval($_GET['entero']);
    echo <<<MARCA
    <p>
        <label for="entero">Introduzca un entero impar positivo de 1 a 20:</label>
        <input type="number"  min="1" max="20" step="2"  id="entero" name="entero" value="{$entero}" />
    </p>
MARCA;
    $segundaVez = false;
    if ( !isset($_GET['primeraVez']) ) {
        echo '<input type="hidden"  name="primeraVez" value="true" />';
    } else {
        $segundaVez = true;
    }

    if ($entero === "" || $entero < 1 || $entero > 20 || ($entero % 2 == 0))  {  // aunque el html se encarga de comprobar rango, no hace daño probar aquí
         if ($segundaVez) {
            echo <<<MARCA
            <p style="color: red">Introduzca el entero IMPAR solicitado (1-20), por favor</p>
            <p id="digitos">&nbsp;</p>
MARCA;
        }
    } else {
        echo "<pre style=\"font-family: monospace\">";
        $medio = floor($entero / 2) + 1;
        // Dibujar parte superior rombo:
        for ($fila = 1; $fila <= $medio; $fila++) {
            for ($columna = 1; $columna <= $entero; $columna++) {
                if ( ($columna > $medio - $fila) && ($columna < $medio + $fila) ) {
                    echo '*';
                } else {
                    echo ' ';
                }
            }
            echo '<br>';
        }

        // Dibujar parte inferior rombo:
        for ($fila = $medio - 1 ; $fila >= 1; $fila--) {
            for ($columna = 1; $columna <= $entero; $columna++) {
                if ( ($columna > $medio - $fila) && ($columna < $medio + $fila ) ) {
                    echo '*';
                } else {
                    echo ' ';
                }
            }
            echo '<br>';
        }        

        echo "</pre>";
    }
    //Para comprobar lo que hay:
    // var_dump(numeroDeTerminos(5));
    // var_dump(longitudUltimoTerminoFibo(7));
    // var_dump(imprimirFiboConFormato(calcularSerieFibo(7),longitudUltimoTerminoFibo(7)));
?>
        <button id="botonEnviar" type="submit">Enviar</button>      
        <button id="botonReset">Reset</button> 
    </form>
</body>
</html>