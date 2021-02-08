<?php
include 'bd.php';
$cedula = $_POST['cedula'];
$accion = $_POST['accion'];
if($accion == 'buscar'){
    $datos = $conn->query("SELECT *
    from cabezera c 
    inner JOIN detalle d on c.idCabezera = d.idCabezera
    where c.cedula = $cedula");
    while($row = mysqli_fetch_assoc($datos)){
        $respuesta = array(
            'idcabezera' => $row['idCabezera'],
            'cedula' => $row['cedula'],
            'nombre' => $row['nombre']
        );
    }
    echo json_encode ($respuesta);
}