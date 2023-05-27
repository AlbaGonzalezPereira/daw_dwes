// [JAXON-PHP]
/**
 * Función que envía el voto que ha hecho un usuario de un producto
 * @param {*} usu 
 * @param {*} pro 
 */
function envVoto(usu, pro) {
    id = "spuntos_" + pro;
    var puntos = document.getElementById(id).value;
    
    jaxon_miVoto(usu, pro, puntos);
}

/**
 * Función que borra o voto dun producto dun usuario rexistrado. FUNCIÓN AÑADIDA
 * @param {*} usu 
 * @param {*} pro 
 */
function borrarVoto(usu, pro) {    
    jaxon_miNoVoto(usu, pro);
}

/**
 * Función que pintará estrellas si el voto es válido
 * @param {*} datos 
 */
function votoValido(datos) {
    jaxon_pintarEstrellas(datos['media'], datos['pro']);
}