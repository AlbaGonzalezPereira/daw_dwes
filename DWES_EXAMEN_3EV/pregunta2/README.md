## PREGUNTA 2, problema de programación en PHP, contra base de datos y con clases:
**NOTA:** En todo este ejercicio se debe respetar el criterio seguido durante el curso de que:
* las páginas "públicas" (=a servir a internet) se guardan en el directorio ``"public"``
* las páginas de soporte en ``"src"``


**a)** Desarrolla una página web ``"pagina1.php"`` que solicite del usuario una frase que solo tenga letras minúsculas sin acentuar y sin signos de puntuación ni otro carácter extraño (es decir, abcdefghijklemnñopqrstuvwxyz).

* **a.1)** si la frase **no cumple** con lo anterior: se le indicará al usuario por qué, y se solicitará de nuevo su introducción.
* **a.2)** si la frase **valida** correctamente:
    * se escribirá la frase del revés
    * se indicará si la frase es un palíndromo o si no lo es.
* **a.3)** además, se mostrará en una **tabla html** (TABLA) las frases que ese usuario ha ido introduciendo hasta ese momento, incluida la actual (después de darle a ``"Enviar"``)

**Por ejemplo:** 

(Las entradas aparecen en fondo gris, las salidas calculadas en fondo azul)  
(Enviar y Reset representan botones html)

<div align = center><img src="https://github.com/AlbaGonzalezPereira/daw_dwes/blob/main/DWES_EXAMEN_3EV/img/pregunta2-1.PNG" alt="Palindromo" style = "width: 60%"></div>

<div align = center><img src="https://github.com/AlbaGonzalezPereira/daw_dwes/blob/main/DWES_EXAMEN_3EV/img/pregunta2-2.PNG" alt="Palindromo2" style = "width: 60%"></div>
<br>

**b)** Descarga de FPADISTANCIA la base de datos "pregunta2.zip" y cárgala en tu entorno de desarrollo del examen.

<div align = center><img src="https://github.com/AlbaGonzalezPereira/daw_dwes/blob/main/DWES_EXAMEN_3EV/img/Imaxe2.png" alt="Tablas bbdd" style = "width: 80%"></div>
<br>

Desarrolla una página ``"login.php"`` que permita autenticar a un usuario contra la tabla ``"usuarios"`` de la base de datos ``"pregunta2"``.
* si el usuario se autentica correctamente, será redirigido a la página ``pagina1.php``, pasándole a esta (pagina1.php) los datos de sesión con el nombre de usuario validado.
*	modificar la ``pagina1.php`` para que muestre el nombre del usuario **"logeado"**.

El **nombre de usuario** será una cadena sin espacios, de 10 caracteres como máximo, y los caracteres serán letras minúsculas o mayúsculas del alfabeto castellano (debe ***validarse*** la entrada).

**c)** Añade un nuevo botón a la **pagina1.php** ``"Persistir"`` (y toda la lógica (=página/s php) subyacente) que permita almacenar en la base de datos, en la tabla ``"palindromos"`` la información que en ese momento el usuario tenga en la tabla TABLA.
* la actualización se realizará **usando AJAX** (librería Jaxon-php), sin que se tenga que recargar la página pagina1.php
* **no se enviarán**, en una misma sesión, aquellas filas de la tabla TABLA que ya fueron enviadas.

(SIN RESOLVER)