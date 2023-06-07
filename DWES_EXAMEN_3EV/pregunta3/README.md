## PREGUNTA 3, problema de modificación y/o corrección de código en PHP:

Como resultado de esta pregunta:

* **a)** se completarán los apartados **"INFORME DEL TRABAJO REALIZADO"** (una lista de pasos principales seguidos)
* **b)** se entregará el **código final desarrollado** tal como se indica en las instrucciones al comienzo del enunciado de este examen.

Dada la siguiente aplicación que ofrece y utiliza un servicio **SOAP** en PHP (descargar código de la pregunta en formato .zip de la web de FPADISTANCIA, fichero **pregunta3.zip**) que se corresponde con una solución posible al ejercicio trabajado en la Tarea 06, te solicitan realizar las siguientes tareas:

**a)** Carga la base de datos (esquema y datos) en MySQL (MariaDB) de Xampp y arregla lo que haya que arreglar para que la página ``public/index.php`` funcione correctamente.

<div align = center><img src="https://github.com/AlbaGonzalezPereira/daw_dwes/blob/main/DWES_EXAMEN_3EV/img/pregunta3-1.PNG" alt="arreglo index" style = "width: 60%"></div>
<br>

**b)** Añade al servicio SOAP una nueva función que permita obtener la ciudad de una tienda dada.

**CONSULTA SQL:** ``SELECT ciudad FROM tiendas WHERE id = <id de la tienda>``

<div align = center><img src="https://github.com/AlbaGonzalezPereira/daw_dwes/blob/main/DWES_EXAMEN_3EV/img/pregunta3-2.PNG" alt="arreglo index" style = "width: 60%"></div>
<div align = center><img src="https://github.com/AlbaGonzalezPereira/daw_dwes/blob/main/DWES_EXAMEN_3EV/img/pregunta3-3.PNG" alt="arreglo index" style = "width: 60%"></div>
<br>

**c)** Añade a la página un formuario que permita al usuario introducir:
* un código de tienda
* un código de producto
* un código de familia
* la fecha actual

**Requisitos:**

**c.1)** Deben validarse los datos, como mínimo en el php. Los rangos válidos de dichos códigos se obtengan mediante las oportunas consultas a la base de datos.

**c.2)** Además cuando se haga clic en el botón "Enviar", se mostrará la ciudad para el código de tienda introducido usando el servicio SOAP añadido en b).

**c.3)** Cuando el usuario haga clic en el botón "Enviar", la página se recargará mostrando la información solicitada y manteniendo el valor de los datos introducidos en el los campos del formulario (mantener la sesión).

(LA PREGUNTA 3C ESTÁ SIN DESARROLLAR)

**d)** Añade la prestación de AJAX (usando ``Jaxon-php``) a la aplicación (fichero ``index.php``), consistente en que aparezca un botón ``"Clima"`` que, al hacer clic en él, permita obtener pequeño informe del tiempo (obtenido usando un **servicio REST** de tu elección) en la ciudad de la tienda introducida por el usuario en ese momento, sin recargar la página ``index.php``.

(LA PREGUNTA 3D ESTÁ SIN DESARROLLAR)


