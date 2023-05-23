// [JAXON-PHP]
function envTemp() {
    let ciudad = document.getElementById("ciudad").value;
    
    // llamamos por AJAX al php:
    jaxon_vCiudadTemperatura(ciudad);
    
    // anulamos la acción por defecto del formulario:
   return false;
}

function envViento() {
    let ciudad = document.getElementById("ciudad").value;
    
    // llamamos por AJAX al php:
    jaxon_vCiudadViento(ciudad);
    
    // anulamos la acción por defecto del formulario:
   return false;
}


