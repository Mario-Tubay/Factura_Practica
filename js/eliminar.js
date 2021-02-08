function alerta(id) {
    Swal.fire({
        title: 'Eliminar',
        text: "Esta seguro que desea eliminar!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, eliminar!'
    }).then((result) => {
        if (result.isConfirmed) {
            eliminar(id);
        }
    })

}

function eliminar(id) {
    var datos = new FormData();
    datos.append('id', id);
    datos.append('accion', 'eliminar')

    var xhr = new XMLHttpRequest();

    xhr.open('POST', 'src/funciones/CRUD.php', true);
    xhr.onload = function() {
        if (this.status === 200) {
            location.reload();
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