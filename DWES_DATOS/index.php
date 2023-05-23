<?php
// [JAXON-PHP]

// Preparamos Jaxon:
require (__DIR__ . '/include/VerTemperatura.php');

use function Jaxon\jaxon;

// Procesar la solicitud
if($jaxon->canProcessRequest())  $jaxon->processRequest();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <!--Fontawesome CDN-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <title>Temperatura</title>
  
    <script type="text/javascript" src="temperatura.js"></script>
</head>

<body style="background:#00bfa5;">
<h4 class="text-center mt-3">Tarea temperaturas</h4>
   
        <div class="d-flex justify-content-center h-100 mt-2" id="datos">
            <div class="card" style='width:28rem;'>
                <div class="card-header">
                    <h4><i class="fa fa-cog mr-1"></i>Datos por ciudad</h4>
                </div>
                <div class="card-body">
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" style="width:2.5rem;"><i class="fas fa-city"></i></span>
                        </div>
                        <input type="text" class="form-control" placeholder="Ciudad" name="ciudad" id="ciudad">
                    </div>
                

                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" style="width:2.5rem;"><i class="fas fa-thermometer-three-quarters"></i></span>
                        </div>
                        <input type="text" class="form-control" placeholder="Temperatura" id="temp" readonly>
                    </div>

                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" style="width:2.5rem;"><i class="fas fa-paper-plane"></i></span>
                        </div>
                        <input type="text" class="form-control" placeholder="Viento" id="wind" readonly>
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-warning" onclick="envTemp();">Ver datos</button>  
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
