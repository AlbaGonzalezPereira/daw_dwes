function validarFecha() {
    let fecha = document.getElementById("title").value;

    if (fecha.length == 0) {
        alert("Elija una fecha.");
        return false;
    }

    let miFecha = new Date(fecha);
    let hoy = new Date();

    hoy.setHours(0, 0, 0, 0);
    miFecha.setHours(0, 0, 0, 0);

    if (miFecha < hoy) {
        alert("La fecha no puede se inferior a la actual");
        return false;
    }

    return true;
}

function getCoordenadas() {
    let dir = document.getElementById("dir").value;

    jaxon_getCoordenadas(dir);
    return true;
}

function ordenarEnvios(id) {
    var puntos = $("#t_" + id + " input:hidden")
        .map(function () {
            return this.value;
        })
        .get()
        .join("|");

    jaxon_ordenarEnvios(puntos, id);
}

function obtuvimosDatos(datosRespuesta) {
    if (datosRespuesta["respuesta"] == "404") {
        alert(
            "Servicio para ordenar Rutas de Bing Maps no disponible temporalmente"
        );
        return datosRespuesta["respuesta"];
    }

    // Si obtuvimos una respuesta, reordenamos los envíos del reparto
    // Cogemos la URL base del documento, quitando los parámetros GET si los hay
    let url = "http://localhost/dwes_tema_08/TAREA_08/public/repartos.php";

    // Añadimos el código de la lista de reparto
    url += "?action=oEnvios&idLt=" + datosRespuesta["id"];
    const respuesta = datosRespuesta["respuesta"];

    // Y un array con las nuevas posiciones que deben ocupar los envíos
    //for (var r of datosRespuesta['respuesta']) url += '&pos[]=' + respuesta[r];
    for (let i = 0; i < respuesta.length; i++) url += "&pos[]=" + respuesta[i];

    window.location = url;
}

function semaforo() {
    var latitud = document.getElementById("lat").value;
    var pro = document.getElementById("pro").value;

    if (latitud.length == 0 || pro == -1) {
        //alert("Elija un producto.");
        return false;
    }

    return true;
}

function ocultar(id){
    jaxon_ocultar(id.attributes[1].value);
}

//script para que nos oculte la orden. FUNCIONALIDAD AÑADIDA
// $(document).ready(function () {
//     // Utilizando un selector similar a querySelectorAll
//     // var ocultos = $(document).find('.ocultar');
//     // var ordenes =$(document).find('.orden');

//     // Iterar sobre los elementos seleccionados
//     // ocultos.each(function() {
//     //Esto sólo oculta el primer reparto:
//     $("#ocultar").click(function () {
//         //al darle clic en el elemento con id="ocultar"
//         $("#ocultar").toggleClass("ver");
//         if ($("#ocultar").hasClass("ver")) {
//             //para cambiar el color, icono y el texto del botón
//             $("#ocultar").removeClass("btn-primary");
//             $("#ocultar").addClass("btn-light");
//             $("#ocultar").html("<i class='fas fa-eye mr-1'></i>Ver orden"); //cambiamos icono y texto
//         } else {
//             $("#ocultar").removeClass("btn-light");
//             $("#ocultar").addClass("btn-primary");
//             $("#ocultar").html(
//                 "<i class='fas fa-eye-slash mr-1'></i>Ocultar orden"
//             );
//         }
//         $("#orden").toggle(); //oculta el elemento con id="orden"
//     });

//     // //     // Haz algo con cada elemento
//     // // console.log($(this).text());
//     // $(this).click(function() {//al darle clic en el elemento con class="ocultar"
//     //     $(this).toggleClass( "ver" );
//     //     if($(this).hasClass('ver')){
//     //         //para cambiar el color, icono y el texto del botón
//     //         $(this).removeClass("btn-primary");
//     //         $(this).addClass("btn-light");
//     //         $(this).html("<i class='fas fa-eye mr-1'></i>Ver orden");//cambiamos icono y texto
//     //     }else{
//     //         $(this).removeClass("btn-light");
//     //         $(this).addClass("btn-primary");
//     //         $(this).html("<i class='fas fa-eye-slash mr-1'></i>Ocultar orden");
//     //     }
//     //     ordenes.each(function() {
//     //         $(this).toggle();//oculta el elemento con class="orden"
//     //   });
// });
