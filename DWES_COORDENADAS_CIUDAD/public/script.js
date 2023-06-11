function obtenerLocalizacion() {
    let la = document.getElementById('latitud').value;
    let lo = document.getElementById('longitud').value;
    
    jaxon_getLocalizacion(la, lo);
}