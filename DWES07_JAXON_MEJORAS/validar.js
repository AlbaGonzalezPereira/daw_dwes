// [JAXON-PHP]
function envForm() {
    let usu = document.getElementById("usu").value;
    let pass = document.getElementById('pass').value;
    let idTienda = document.getElementById("tiendaCercana");
    let iT = idTienda.options[idTienda.selectedIndex].value;
    console.log(idTienda); //comprobamos

    // llamamos por AJAX al php:
    jaxon_vUsuario(usu, pass, iT);
    
    // anulamos la acción por defecto del formulario:
    return false; 
}

/**
 * Función que nos cargará listado.php en la misma ventana o pestaña actual del navegador
 */
function validado() {
    window.open("listado.php", "_self");
}

/**
 * Función que lanza una alerta cuando el usuario o la contraseña no son válidos
 */
function noValidado() {
    alert("¡¡Usuario o contraseña no válidos!!!");
}