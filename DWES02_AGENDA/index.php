 <?php 
 //Indicar si es la primera vez que se entra en la web
 if (!empty($_POST)) {
            //Recogemos el array con la función serialize
            $agenda = unserialize($_POST['agenda']);
            //Guardamos las variables pasadas por $POST
            $nom=$_POST['nom'];
            $tel=$_POST['tel'];
            
            //Si el nombre que se introdujo no existe en la agenda, y el número de teléfono no está vacío, se añadirá a la agenda.
            if(!array_key_exists($nom,$agenda)&& !empty($tel))        
                $agenda[$nom]=$tel;
            //Si el nombre que se introdujo ya existe en la agenda y se indica un número de teléfono, se sustituirá el 
            //número de teléfono anterior.
            if(array_key_exists($nom,$agenda) && !empty($tel))
                $agenda[$nom]=$tel;
            //Si el nombre que se introdujo ya existe en la agenda y no se indica número de teléfono, se eliminará de la 
            //agenda la entrada correspondiente a ese nombre.
            if(array_key_exists($nom,$agenda) && empty($tel))
                unset($agenda[$nom]);
            
    }else {
        //Declaramos el array la primera vez que entramos en la web
	        $agenda = [];
    }	
    ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Alba González">
    <meta name="description" content="Ejercicio DWES02">
    <link href="style.css" rel="stylesheet" type="text/css" />
    <title>DWES02 Tarea</title>
</head>
<body>
    <?php
    // Si el nombre está vacío, se mostrará una advertencia
    if(isset($_POST['enviar'])){
        if (empty($_POST['nom'])) {
            echo "<h3>El Nombre es Obligatorio!!</h3>";
        }
    }
        ?>
    <h2>Agenda</h2>
    <?php
    // Comprobamos datos agenda y los mostramos en una tabla
    if(!empty($agenda)){
        echo "<fieldset>
                <legend>Datos Agenda</legend>
        <table>";
            foreach ($agenda as $key => $value) {
                echo "<tr><td>$key</td><td>$value</td></tr>";
            }
            
                
           echo "</table>
                </fieldset>";
    }

    ?>
    <!--Creamos el formulario donde escribimos el nombre y el teléfono, lo pasamos por post-->
    <form action="<?php $_SERVER['PHP_SELF']?>" method="post">
        <fieldset>
            <legend>Nuevo contacto: </legend>
            <label>Nombre: </label>
            <input type="text" name="nom">
            <br>
            <label>Teléfono: </label>
            <input type="number" name="tel">
            <br><br>
            <input type="hidden" name="agenda" value='<?php echo serialize($agenda)?>'/>
            <input class="anadir" type="submit" value="Añadir Contacto" name="enviar">
            <input class="limpiar" type="reset" value="Limpiar Campos" name="limpiar">
            <?php 
            /*
            Prueba por si funciona:
            foreach ($agenda as $key => $value) {
                echo  "El código del módulo ".$value." es ".$key."<br />";
            }*/
            ?>
        </fieldset>
    </form>
    <br>
    
    <?php
    if(!empty($agenda)){
    //creamos nuevo formulario cuando hay algún dato en la agenda
    echo "<form action=";
    echo $_SERVER['PHP_SELF'];
    // es igual a echo "<form action='index.php' method='get'>
    echo " method='get'>
        <fieldset>
            <legend>Vaciar agenda</legend>
                <input class='vaciar' type='submit' value='Vaciar' name='limpiar'>
        </fieldset>
    </form>";
    }
    ?>
    
</body> 
</html>
<!--
if(isset($_GET['limpiar'])){
unset($agenda);
}

// <a href="<?php $_SERVER['PHP_SELF']?>?limpiar=1"><button>Vaciar</button></a>-->