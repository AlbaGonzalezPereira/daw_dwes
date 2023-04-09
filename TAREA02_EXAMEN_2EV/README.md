## **PREGUNTA 2**
La serie de Fibonacci es una serie de números enteros positivos: 0, 1, 1, 2 , 3, 5, 8, 13, 21, ... que comienza por los términos 0 y 1 y tiene la propiedad de que cada término posterior es la suma de sus 2 predecesores en la sucesión ( 2 = 1 + 1 ,  3 = 2 + 1, ...).

Desarrolla un script que solicite un número entero ***N*** entre 1 y 8 y después produzca un cuadrado de números que son los miembros de la serie de Fibonacci, de longitud de lado  ***N*** unidades, como el formato siguiente, donde cada asterisco representa un término de la serie de Fibonacci.

```php
* * * *
*     *
*     *
* * * *
```
 
Cada número o término debe aparecer formateado como se indica en los ejemplos. Se recomienda realizar una ***`función imprimirTermino`*** para que cada término o número de la serie se imprima:
* ocupando tantos caracteres como ocupe el mayor de los términos
* cada elemento que no sea un dígito (0 a la izquierda) se imprima como un punto "."

Cada término va separado del anterior por un espacio.

---

**Por ejemplo:** 

(Enviar y Reset representan botones html)

<pre>
<b>Introduzca un número comprendido entre 1 y 8: 4 </b>

<font style = "background-color:green">Enviar</font> <font style = "background-color:red">Reset</font>

..1 ..1 ..2 ..3
..5         ..8
.13         .21
.34 .55 .89 144

</pre>

<pre>
<b>Introduzca un número comprendido entre 1 y 8: 3 </b>

<font style = "background-color:green">Enviar</font> <font style = "background-color:red">Reset</font>

.1 .1 .2
.3    .5
.8 13 21

</pre>