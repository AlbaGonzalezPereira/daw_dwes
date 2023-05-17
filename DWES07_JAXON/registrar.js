// [JAXON-PHP]

/**
 * Función que nos registra un usuario, recogiendo los valores puestos en los campos usuario y contraseña
 * @returns 
 */
function registrarUsuario() {
    let usu = document.getElementById("usu").value;
    let pass = document.getElementById('pass').value;

    // llamamos por AJAX al php:
    jaxon_cUsuario(usu, pass);
    
    // anulamos la acción por defecto del formulario:
    return false;
}

/**
 * Función que lanza una alerta si el usuario se ha creado correctamente
 */
function registrado() {
    alert("Usuario creado correctamente");
}

/**
 * Función que lanza una alerta si el usuario o la contraseña están en blanco
 */
function noRegistrado() {
    alert("¡¡Usuario o contraseña no correctos, deben tener más de 1 caracter!!!");
}