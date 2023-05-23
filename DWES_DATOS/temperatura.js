// [JAXON-PHP]
function envTemp() {
    let ciudad = document.getElementById("ciudad").value;
    
    // llamamos por AJAX al php:
    jaxon_vCiudad(ciudad);
    
    // anulamos la acción por defecto del formulario:
    return false;
}


