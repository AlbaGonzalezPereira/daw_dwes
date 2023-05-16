## **ENUNCIADO TAREA04**
Tienes que programar una aplicación web sencilla que permita gestionar una serie de preferencias del usuario. La aplicación se dividirá en dos páginas:

* ``preferencias.php``. Permitirá al usuario escoger sus preferencias y las almacenará en la sesión del usuario.

Mostrará un cuadro desplegable por cada una de las preferencias. Estas serán:

* **Idioma**. El usuario podrá escoger un idioma entre "inglés" y "español".
* **Perfil público**. Sus posibles opciones será "sí" y "no".
* **Zona horaria**. Los valores en este caso estarán limitados a "GMT-2", "GMT-1", "GMT", "GMT+1" y "GMT+2".

Además en la parte inferior tendrá un botón con el texto "**Establecer preferencias**" y un enlace que ponga "**Mostrar preferencias**".

El botón almacenará las preferencias en la sesión del usuario y volverá a cargar esta misma página, en la que se mostrará el texto "**Preferencia de usuario guardadas**". Una vez establecidas esas preferencias, deben estar seleccionadas como valores por defecto en los tres cuadros desplegables.

El botón "**Establecer preferencias**" llevará a la página "``mostrar.php``".

* ``mostrar.php``. Debe mostrar un texto con las preferencias que se encuentran almacenadas en la sesión del usuario. Además, en la parte inferior tendrá un botón con el texto "**Borrar**" y un otro que ponga "**Establecer**".

El botón borrará las preferencias de la sesión del usuario y volverá a cargar esta misma página, en la que se mostrará el texto "**Preferencias Borradas.**". Una vez borradas esas preferencias, se debe comprobar que sus valores no se muestran en el texto de la página.

Si pulsamos el botón **Borrar** y no tenemos establecidas la preferencias se nos mostrará el mensaje "**Debes fijar primero las preferencias.**".

El botón establecer llevará a la página "``preferencias.php``".

Se valorará el uso de ``Bootstrap`` y Font ``Awesome`` para los estilos.