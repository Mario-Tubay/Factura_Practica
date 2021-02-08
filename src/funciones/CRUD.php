<?php 

$accion =  $_POST['accion'];
include('bd.php');
if($accion == 'crear'){
$nombre = $_POST['nombre'];
$nombreProducto = $_POST['nombreProducto'];
$direccion = $_POST['direccion'];
$telefono = $_POST['telefono'];
$cedula = $_POST['cedula'];
$cantidad = $_POST['cantidad'];
$precio = $_POST['precio'];
$iva = $_POST['iva'];
$porcIva = $_POST['porcIva'];
$subtotal = $_POST['subtotal'];
$total = $_POST['total'];
    $eliminar = 0;
    try{
        $stmt = $conn->prepare("INSERT INTO cabezera(cedula, nombre, direccion, telefono, eliminar) VALUES (?,?,?,?,?)");
        $stmt->bind_param('ssssi',$cedula,$nombre,$direccion,$telefono,$eliminar);
        $stmt->execute();
       
        if($stmt->affected_rows>0){
            $id = (int) mysqli_insert_id($conn);
            $stmt1 = $conn->prepare("INSERT INTO detalle(nombreProducto,cantidad, precio, iva, porcentajeIva, subtotal, total, idCabezera, eliminar)VALUES(?,?,?,?,?,?,?,?,?)");
            $stmt1->bind_param('siiiiiiii', $nombreProducto,$cantidad,$precio,$iva,$porcIva,$subtotal, $total, $id, $eliminar);
            $stmt1->execute();
            
        } 

        if($stmt1->affected_rows > 0){
            $respuesta = array(
                'respuesta'=>'correcto'
            );
        }else{
            $respuesta = array(
                'respuesta' => 'error',
                'id'=> $id
            );
        }
    }catch(Exception $e){
        $respuesta = array(
            'error' => $e->getMessage()
        );
    }

    $stmt1->close();
    $stmt->close();
    $conn->close();

    echo json_encode($respuesta);
}else if($accion == 'editar'){
    $nombre = $_POST['nombre'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $cedula = $_POST ['cedula'];
    try{
        $stmt = $conn->prepare("UPDATE cabezera SET nombre = ? , direccion = ?, telefono = ? WHERE cedula = ?");
        $stmt->bind_param('ssss',$nombre,$direccion,$telefono,$cedula);
        $stmt->execute();
        if($stmt->affected_rows > 0){
            $respuesta = array(
                'respuesta'=>'correcto'
            );
        }else{
            $respuesta = array(
                'respuesta' => 'error'
            );
        }
    }catch(Exception $e){
        $respuesta = array(
            'error' => $e->getMessage()
        );
    }
    $stmt->close();
    $conn->close();
    echo json_encode($respuesta);

}else if($accion == 'eliminar'){
    $id = $_POST['id'];
    try{
        $stmt = $conn->prepare("UPDATE detalle SET eliminar = 1 WHERE idDetalle = ?");
        $stmt->bind_param('i',$id);
        $stmt->execute();
        if($stmt->affected_rows > 0){
            $respuesta = array(
                'respuesta'=>'correcto'
            );
        }else{
            $respuesta = array(
                'respuesta' => 'error'
            );
        }
    }catch(Exception $e){
        $respuesta = array(
            'error' => $e->getMessage()
        );
    }
    $stmt->close();
    $conn->close();

    
}
