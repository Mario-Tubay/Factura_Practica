eventsListener();
cambiar();

function eventsListener() {
    document.getElementById("enviar").addEventListener('click', validar);
    document.getElementById("precio").addEventListener('keyup', calcular);
    document.getElementById("cantidad").addEventListener('keyup', calcular);
}


function calcular() {
    cambiar();
}

function cambiar() {
    let check = document.getElementsByName('radio');
    if (check[0].checked) {
        console.log(check[0].value);
        document.getElementById('iva').value = "12%"
        document.getElementById('porcIva').value = "0.12"
        let precio = document.getElementById('precio').value;
        let cantidad = document.getElementById('cantidad').value;
        let total = Number(cantidad) * precio
        let subtotal = Number(total) + (0.12 * total);
        console.log(subtotal)
        document.getElementById('subtotal').value = subtotal.toFixed(2);
        document.getElementById('total').value = subtotal.toFixed(2);
        document.getElementById('totales').innerHTML = '$' + subtotal.toFixed(2);
    } else if (check[1].checked) {

        document.getElementById('iva').value = "0%"
        document.getElementById('porcIva').value = "0"
        let precio = document.getElementById('precio').value;
        let cantidad = document.getElementById('cantidad').value;
        let total = Number(cantidad) * precio
        let subtotal = Number(total) + (0 * total);
        console.log(subtotal)
        document.getElementById('subtotal').value = subtotal.toFixed(2);
        document.getElementById('total').value = subtotal.toFixed(2);
        document.getElementById('totales').innerHTML = "$" + subtotal.toFixed(2);
    }
}

function validar(e) {
    e.preventDefault();
    let datos = [document.getElementById('hidden').value,
        document.getElementById('nombre').value,
        document.getElementById('direccion').value,
        document.getElementById('telefono').value,
        document.getElementById('nombreProducto').value,
        document.getElementById('cantidad').value,
        document.getElementById('precio').value,
        document.getElementById('iva').value,
        document.getElementById('porcIva').value,
        document.getElementById('subtotal').value,
        document.getElementById('total').value,
        document.getElementById('cedula').value
    ];

    let validar = false;
    for (let i = 0; i < datos.length; i++) {
        if (datos[i] === '' || datos === null) {
            validar = true;
            break;
        }
    }
    if (validar) {
        alertas('error', 'Error', 'Faltan datos para llenar');
    } else {
        location.reload();
        guardar(datos);
    }
}

function guardar(datos) {
    let dato = new FormData();
    dato.append('accion', datos[0]);
    dato.append('nombre', datos[1]);
    dato.append('direccion', datos[2]);
    dato.append('telefono', datos[3]);
    dato.append('nombreProducto', datos[4]);
    dato.append('cantidad', datos[5]);
    dato.append('precio', datos[6]);
    dato.append('iva', datos[7]);
    dato.append('porcIva', datos[8]);
    dato.append('subtotal', datos[9]);
    dato.append('total', datos[10]);
    dato.append('cedula', datos[11]);

    let xhr = new XMLHttpRequest();

    xhr.open('POST', 'src/funciones/CRUD.php', true);

    xhr.onload = function() {
        if (this.status === 200) {
            console.log(xhr.responseText);
            let respuesta = JSON.parse(xhr.responseText);
            if (respuesta.respuesta === 'correcto') {
                alertas('success', 'Exito', 'Los datos se almacenaron correctamente');
            } else {
                alertas('error', 'Error', 'No se almacenaron correctamente');
            }
        }
    }
    xhr.send(dato);
}

function alertas(icono, titulo, texto) {
    Swal.fire({
        icon: `${icono}`,
        title: `${titulo}`,
        text: `${texto}`
    })
}