eventsListener();

function eventsListener() {
    document.getElementById("cedula").addEventListener('keyup', buscar);
}

function buscar() {
    let xhr = new XMLHttpRequest();

    let datos = new FormData();
    datos.append('cedula', cedula);
    datos.append('accion', accion);
    xhr.open('POST', 'src/funciones/buscar.php', true);

    xhr.onload = function() {
        if (this.status === 200) {
            console.log(xhr.responseText);
            let respuesta = JSON.parse(xhr.responseText);
            if (respuesta.respuesta === 'correcto') {
                alert('cedula es: ' + respuesta.cedula);
            } else {

            }
        }
    }
    xhr.send(datos);
}