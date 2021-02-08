<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
</head>

<body>
    <header class="back-header">
        <div class="header-cab contenedor">
            <h1>FACTURA</h1>
            <nav>
                <a href="index.html">Ingresar</a>
                <a href="editar.php">Editar</a>
            </nav>
        </div>
    </header>

    
            <table id="muestra" class="tabla">
                <tr style="text-align:left;">
                    <th>Cedula</th>
                    <th>Nombre</th>
                    <th>direccion</th>
                    <th>Telefono</th>
                    <th>Nombre Producto</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>IVA</th>
                    <th>% IVA</th>
                    <th>Subtotal</th>
                    <th>Total</th>
                    <th>Acciones</th>
                </tr>
                <?php 
                obtenerDatos();
                function obtenerDatos(){
                    include 'src/funciones/bd.php';

                    try{
                        $datos = $conn->query("SELECT *
                        from cabezera c 
                        inner JOIN detalle d on c.idCabezera = d.idCabezera
                        where d.eliminar  = 0");
                    }catch(Exception $e){
                        return false;
                    }
                foreach($datos as $fac){?>
                <tr>
                    <td><?php echo $fac['cedula']; ?></td>
                    <td><?php echo $fac['nombre']; ?></td>
                    <td><?php echo $fac['direccion']; ?></td>
                    <td><?php echo $fac['telefono']; ?></td>
                    <td><?php echo $fac['nombreProducto']; ?></td>
                    <td><?php echo $fac['cantidad']; ?></td>
                    <td><?php echo $fac['precio']; ?></td>
                    <td><?php echo $fac['iva']; ?></td>
                    <td><?php echo $fac['porcentajeIva']; ?></td>
                    <td><?php echo $fac['subtotal']; ?></td>
                    <td><?php echo $fac['total']; ?></td>
                    <td>
                        <a  style="background-color: #b2bbbd" class="btn btn-editar" href="cambiar.php?id=<?php echo $fac['cedula']?>">Editar</a>
                        <button  style="font-size: 16px; background-color:#e24730; border: 0px;" class="btn" onclick = "alerta(<?php echo $fac['idDetalle']?>)">Eliminar</button>
                    </td>
                </tr>
                <?php }
                } ?>
            </table>
    <script src="js/eliminar.js"></script>
    <script src="js/jquery-1.12.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</body>

</html>