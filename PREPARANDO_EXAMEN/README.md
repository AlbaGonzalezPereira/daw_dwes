## FUNCIONES ÚTILES

``explode()``: Esta función divide un string en partes utilizando un delimitador y devuelve un array con esas partes. Toma **dos argumentos**: el delimitador y la cadena original. Divide la cadena en cada ocurrencia del delimitador y devuelve un arreglo con los elementos resultantes.

Esto es útil cuando tienes una cadena que contiene elementos separados por un carácter específico (en este caso, un espacio) y necesitas **trabajar con cada elemento por separado**.

**Ejemplo:**
Al utilizar ``explode(" ", $string)`` la cadena se divide en cada espacio encontrado y se crea un arreglo con las palabras individuales.
```php
$string = "Hola Mundo PHP";
$array = explode(" ", $string);
print_r($array);
```
<br>



``implode()``: Esta función une los elementos de un array en un solo string, utilizando un separador opcional.

**Ejemplo:**
Al utilizar ``implode(",", $array)``, los elementos se unirán en una cadena separada por comas. La salida será: "Hola,Mundo,PHP".
```php
$array = array("Hola", "Mundo", "PHP");
$string = implode(",", $array);
echo $string;
```
<br>

``preg_match()``: Valida una entrada utilizando una expresión regular.
```php
$regex = '/^\d{3}-\d{3}-\d{4}$/'; // Expresión regular para validar un número de teléfono en el formato XXX-XXX-XXXX
$phone = '123-456-7890';

if (preg_match($regex, $phone)) {
    echo "El número de teléfono es válido.";
} else {
    echo "El número de teléfono no es válido.";
}
```
Ahora vamos a utilizar ``preg_match('/^-?\d+$/', $input)`` para verificar si la entrada $input es un número entero (positivo o negativo). Si la expresión regular coincide, se imprimirá "Entrada válida: -123". De lo contrario, se imprimirá "Entrada inválida: -123".
```php
$input = "-123";
if (preg_match('/^-?\d+$/', $input)) {
    echo "Entrada válida: $input";
} else {
    echo "Entrada inválida: $input";
}
```
<br>

``preg_split()``: Divide un string mediante una expresión regular.
```php
preg_split(
    string $pattern,
    string $subject,
    int $limit = -1,
    int $flags = 0
): array
```
**Ejemplo:**
Utilizamos ``preg_split('/,/', $string)`` para dividir la cadena ``$string`` en elementos de un arreglo, utilizando la coma como separador. La salida será un arreglo con los elementos: ["Hola", "Mundo", "PHP"].
```php
$string = "Hola,Mundo,PHP";
$array = preg_split('/,/', $string);
print_r($array);
```
<br>

``array_map()``: Recorre un array aplicando un callback a cada elemento

**Ejemplo:**
Definimos una función de devolución de llamada (callback) que multiplica cada elemento por 2. Luego utilizamos ``array_map($callback, $array)`` para aplicar esa función a cada elemento del arreglo $array. La salida será un nuevo arreglo con los elementos multiplicados por 2: [2, 4, 6, 8, 10].
```php
$array = array(1, 2, 3, 4, 5);
$callback = function($item) {
    return $item * 2;
};
$result = array_map($callback, $array);
print_r($result);
```
<br>

---
## EXPRESIONES REGEX:
Las expresiones regulares (***RegExp*** o ***RegEx***) son un sistema para buscar, capturar o reemplazar texto utilizando **patrones**.

Permiten filtrar textos para encontrar coincidencias, comprobar la validez de fechas, documentos de identidad o contraseñas, se pueden utilizar para reemplazar texto con unas características concretas por otro, y muchos más usos.

Breve lista de los elementos **más utilizados** en las expresión regulares:
*	**^** Indica el principio de una cadena
*	**$** Indica el final de una cadena
*	**()** Un agrupamiento de parte de una expresión
*	**[]** Un conjunto de caracteres de la expresión
*	**{}** Indica un número o intervalo de longitud de la expresión
*	**.** Cualquier caracter salvo el salto de línea
*	**?** 0-1 ocurrencias de la expresión
*	**+** 1-n ocurrencias de la expresión
*	**\*** 0-n ocurrencias de la expresión
*	**\\** Para escribir un caracter especial como los anteriores y que sea tratado como un literal
*	**|** Para indicar una disyunción lógica (para elegir entre dos valores: a|b se tiene que cumplir al menos uno de los dos).

Podemos comprobar nuestras expresiones regulares en: [https://regex101.com/](https://regex101.com/).

Podemos descargarnos alguna **cheatsheet** en la siguiente página:
[https://cheatography.com/davechild/cheat-sheets/regular-expressions/pdf/](https://cheatography.com/davechild/cheat-sheets/regular-expressions/pdf/)

### Búsqueda avanzada con banderas:
Las expresiones regulares tienen seis **indicadores opcionales** que permiten funciones como la búsqueda global y que no distinga entre mayúsculas y minúsculas. Estos indicadores se pueden usar por separado o juntos en cualquier orden y se incluyen como parte de la expresión regular.

* **g**	-> Búsqueda global.	
* **i**	-> Búsqueda que no distingue entre mayúsculas y minúsculas.	
* **m**	-> Búsqueda multilínea.	
* **s**	-> Permite que el **.** coincida con caracteres de nueva línea.	
* **u**	"unicode" -> Trata un patrón como una secuencia de puntos de código Unicode.	
* **y**	-> Realiza una búsqueda "pegajosa" que coincida a partir de la posición actual en la cadena de destino.

### Ejemplos de algunas expresiones regex:
```php
// Expresión regular para validar un número de teléfono en el formato XXX-XXX-XXXX
$expresionTel = '/^\d{3}-\d{3}-\d{4}$/'; 
```
```php
//Expresión regular que valida números de teléfono ya sean fijos como móviles, sin espacios ni guiones
$expresionTel= /^[689]\d{8}$/; 
```
```php
//Validar un número con o sin signo: 
$expresionNum = '/^[+-]?\d+(\.\d+)?$/';
$expresionNum2 = /^[-+]?[0-9]+(\.[0-9]+)?$/;
```
```php
//Expresión que valida los campos de texto NOMBRE en español con espacios, tildes y ñ
$expresion2 = /^[(A-ZÁÉÍÓÚÜÑ)][(a-záéíóúüñ)]+(?:['\s][A-ZÁÉÍÓÚÜÑ][(a-záéíóúüñ)]+)*$/; 
```
```php
//Expresión regular que permita solamente 8 números un guión y una letra
$expresionNif = /^\d{8}-[A-Z]$/; 
```
```php
//Expresión regular que valida un email
$expresionEmail = /^[\w\-\.]+@([\w-]+\.)+[\w-]{2,}$/  
```
```php
//Expresión regular para Fecha: dd/mm/yyyy o dd-mm-yyyy
let expresionFecha = /^([0-2][0-9]|3[0-1])(\/|-)(0[1-9]|1[0-2])\2(\d{4})$/; 
```