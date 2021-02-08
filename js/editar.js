eventsListener();

function eventsListener() {
    document.getElementById("editar").addEventListener('click', editar);
}

function editar(e) {
    e.preventDefault();
    let nombre = document.getElementById('nombre').value,
        direccion = document.getElementById('direccion').value,
        telefono = document.getElementById('telefono').value,
        cedula = document.getElementById('cedula').value,
        accion = document.getElementById('hidden').value;
    let datos = new FormData();
    datos.append('nombre', nombre);
    datos.append('direccion', direccion);
    datos.append('telefono', telefono);
    datos.append('cedula', cedula);
    datos.append('accion', accion);

    var xhr = new XMLHttpRequest();

    xhr.open('POST', 'src/funciones/CRUD.php', true);

    xhr.onload = function() {
        if (this.status === 200) {
            console.log(xhr.responseText);
            let respuesta = JSON.parse(xhr.responseText);
            if (respuesta.respuesta === 'correcto') {
                location.reload();
                alertas('success', 'Exito', 'Los datos se modificaron correctamente');

            } else {
                alertas('error', 'Error', 'No se modificaron');
            }
        }
    }

    xhr.send(datos);
}

function alertas(icono, titulo, texto) {
    Swal.fire({
        icon: `${icono}`,
        title: `${titulo}`,
        text: `${texto}`
    })
}