<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style2.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
</head>
<body>
  <?php  $id = ($_GET['id']); ?>
<header class="content-header">
        <div class="contenedor cab-btn ">
        <a style="background-color:#e24730 " class="btn" href="editar.php" >Regresar</a>
        </div>
    </header>
    <div class="flex contenedor">
        <aside class="form">
            <form action="">
                <div>
                    <label for="cedula">Cedula:</label>
                    <input disabled  class="inputs" type="text" name="cedula" id="cedula" value="<?php echo $id?>">
                </div>
                
                <div>
                    <label for="nombre">Nombre:</label>
                    <input  class="inputs" type="text" name="nombre" id="nombre" placeholder="Ingrese el nombre">
                </div>
                <div>
                    <label for="direccion">Direccion:</label>
                    <input  class="inputs" type="text" name="direccion " id="direccion" placeholder="direccion">
                </div>
                <div>
                    <label for="telefono">telefono:</label>
                    <input  class="inputs" type="text" name="telefono" id="telefono" placeholder="telefono">
                </div>
                <div>
                    <input id ="hidden" type="hidden" value="editar">
                    <input  type="submit" id="editar" class="btn btn-guardar inputs" value="EDITAR" action>
                </div>
            </form>
        </aside>
      
        <main class="table">
            <table class="tabla">
                <tr>
                    <th>Cedula</th>
                    <th>Nombre</th>
                    <th>Direccion</th>
                    <th>Telefono</th>
                </tr>
                <?php 
                obtenerDatos();
                function obtenerDatos(){
                    include 'src/funciones/bd.php';
                 $id = ($_GET['id']);
                    try{
                        $datos = $conn->query("SELECT * from cabezera where cedula = $id");
                    }catch(Exception $e){
                        echo $e;
                    }
                   
                foreach($datos as $fac){?>
                <tr>
                    <td><?php echo $fac['cedula'] ?></td>
                    <td><?php echo $fac['nombre'] ?></td>
                    <td><?php echo $fac['direccion'] ?></td>
                    <td><?php echo $fac['telefono'] ?></td>
                </tr>
                <?php }
                }?>

            </table>
        </main>
    </div>
<script src="js/editar.js"></script>
<script src="js/jquery-1.12.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</body>
</html>