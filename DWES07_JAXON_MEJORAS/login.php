<?php

require (__DIR__ . '/include/Validar.php');
require (__DIR__ . '/include/Registrar.php');
require (__DIR__ . '/include/Tienda.php');

use function Jaxon\jaxon;

// Procesar la solicitud
if($jaxon->canProcessRequest())  $jaxon->processRequest();
session_start();
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!--Fontawesome CDN-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <title>Formulario JAXON</title>
    <script type="text/javascript" src="validar.js"></script>
    <script type="text/javascript" src="registrar.js"></script>


</head>

<body style="background:#00bfa5;">

    <div class="container mt-5">
        <div class="d-flex justify-content-center h-100">
            <div class="card" style='width:24rem;'>
                <div class="card-header">
                    <h3><i class="fa fa-cog mr-1"></i>Registro</h3>
                </div>
                <div class="card-body">
                    <form name='miForm' id="miForm" method='POST' action="listado.php" onsubmit="return envForm();">
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="usuario" id='usu' name='usu'>

                        </div>
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input type="password" class="form-control" placeholder="contraseña" id='pass' name='pass'>
                        </div>

                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            
                            <select class="form-control" name="tiendaCercana" id="tiendaCercana" placeholder="tiendaCercana">
                                <?php
                                $tien = new Tienda();
                                $ciudades = $tien->getCiudades();
                                foreach ($ciudades as $ciudad) {
                                    echo "<option value='{$ciudad[1]}'>{$ciudad[1]} - {$ciudad[0]}</option>";//cogemos las ciudades y los ids
                                }
                                $tien = null; //cerramos la conexión
                                
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <input type="submit" value="Validar" class="btn float-right btn-info" name='enviar' id="enviar">
                            <!--Añadimos el botón registrar para poder registrar usuarios-->
                            <button value="Registrar" class="btn float-right btn-success mx-2" name="registrar" id="registrar" onclick="registrarUsuario();return false;">Registrar</button>
                        </div>
                    </form>
                    
                    <?php 
                    
                    if(isset($_SESSION['ultima'])) echo "última sesión: ".$_SESSION['ultima']; ?>
                </div>
            </div>
        </div>
    </div>

</body>
<?php
$jaxon = jaxon();
echo $jaxon->getCss(), "\n", $jaxon->getJs(), "\n", $jaxon->getScript(), "\n";
echo "<!-- HTTP comment  -->\n"
?>

</html>