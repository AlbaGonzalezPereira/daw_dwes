<?php
// [JAXON-PHP]

// Preparamos Jaxon:
require __DIR__ . '/include/VerTemperatura.php';

use function Jaxon\jaxon;

// Procesar la solicitud
if ($jaxon->canProcessRequest()) {
    $jaxon->processRequest();
}

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
<h4 class="text-center mt-3">Examen Tipo 3</h4>
    <form action = "" method="get">

        <div class="d-flex justify-content-center h-100 mt-2" id="datos">
            <div class="card" style='width:28rem;'>
                <div class="card-header">
                    <h4><i class="fa fa-cog mr-1"></i>Datos</h4>
                </div>
                <?php
if (isset($_GET['temperatura']) || isset($_GET['viento'])) {
    echo "<div class='card-body'>
                    <div class='input-group form-group'>
                        <div class='input-group-prepend'>
                            <span class='input-group-text' style='width:2.5rem;'><i class='fas fa-city'></i></span>
                        </div>
                        <input type='text' class='form-control' placeholder='Ciudad' name='ciudad' id='ciudad'>
                    </div>";
}

?>
                <?php
if (isset($_GET['temperatura'])) {
    echo "<div class='input-group form-group'>";
    echo "<div class='input-group-prepend'>";
    echo "<span class='input-group-text' style='width:2.5rem;'><i class='fas fa-thermometer-three-quarters'></i></span>";
    echo "</div>";
    echo "<input type='text' class='form-control' id='temp' readonly>";
    echo "</div>";
    echo "<div class='form-group'>
                        <button type='text' class='btn btn-warning' name ='calcularT' onClick='envTemp();return false;'>Calcular</button>
                        </div>";
}

if (isset($_GET['viento'])) {

    echo "<div class='input-group form-group'>";
    echo "<div class='input-group-prepend'>";
    echo "<span class='input-group-text' style='width:2.5rem;'><i class='fas fa-paper-plane'></i></span>";
    echo "</div>";
    echo "<input type='text' class='form-control' id='wind' readonly>";
    echo "</div>";
    echo "<div class='form-group'>
                                <button type='text' class='btn btn-warning' name = 'calcularV' onClick='envViento();return false;'>Calcular</button>
                                </div>";
}
?>


                    <?php
if (!isset($_GET['temperatura']) && !isset($_GET['viento'])) {
    echo "<div class='form-group'>
                        <button type='submit' class='btn btn-warning' name = 'temperatura'>Ver Temperatura</button>
                        <button type='submit' class='btn btn-warning' name = 'viento' >Ver Viento</button>
                    </div>";
}

?>

<?php
if (isset($_GET['temperatura']) || isset($_GET['viento'])) {
    echo "<div class='form-group'>
                        <a href='estadoInicial.php' type='button' class='btn btn-warning' name = 'volver'>Volver</a>
                    </div>";
}

?>


                </div>
            </div>
        </div>
</form>

</body>
<?php
$jaxon = jaxon();
echo $jaxon->getCss(), "\n", $jaxon->getJs(), "\n", $jaxon->getScript(), "\n";
echo "<!-- HTTP comment  -->\n"
?>
</html>
