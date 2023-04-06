<?php
$action = $_SERVER['PHP_SELF'];
if (!empty($_POST)) {
	$nombre = $_POST ['nombre'];
	$cantidad = $_POST ['cantidad'];
	$donar = $_POST['donar'];
	$storage = unserialize($_POST['storage']);
	if (isset($nombre) && isset($donar) && !isset ($storage[$nombre]) && !empty($cantidad)){
		$storage[$nombre] = ($cantidad);
	}
	if (isset($nombre) && isset($donar) && isset($storage[$nombre]) && empty ($cantidad)){
		unset($storage[$nombre]);
		
	}
} else {
	$storage = [];
}	
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8" />
	<title>Campaña de Crowdfunding </title>
	<link href="styles.css" rel="stylesheet" type="text/css" />
</head>

<body>

	<h1>Campaña de Crowdfunding </h1>
	
	<h2>Realizado por: <strong>Alba María González Pereira</strong></h2>

	

	<table class="conborde">
		<tr><th>NOMBRE</th> <th>CANTIDAD</th></tr>
		<?php
                    //Creamos e iniciamos a 0 la variable que acumulará el total donado.
                    //Insertamos en la tabla las donaciones y calculamos el total.
   
                        $total = 0;
                        foreach($storage as $nombre => $cantidad) {
                            print '<tr>';
                            print '<td>' . $nombre . '</td>';
                            print '<td>' . $cantidad . '</td>';
                            print '</tr>';

                            $total = $total + $cantidad;
                        }
                    ?>
	</table>

	<p>Total recaudado: <span class="grande"><?php print $total ?> €</span></p>
	
	<form action="" method="post">
		<p> 
			<label for="nombre">Nombre: </label> <input type="text" name ="nombre" /> 
		</p>
		
		<p> 
			<label for="cantidad">Cantidad: </label> <input type="text" name = "cantidad"/> 
			
			<?php
			if(isset($nombre)&&isset($donar)&&!isset($storage[$nombre])&& empty($cantidad))
				echo"<span style='color:red'> &lt; -- Debe introducir una cantidad para donar!!</span>"
			
			?>
		</p>
		
		<input type="hidden" name="storage" value='<?php echo serialize($storage)?>'/>
		
		<p>
			<input type="submit" name="donar" value="Donar" /> 
			<input type="reset" value="Cancelar" />
		</p>
	</form>

</body>
</html>