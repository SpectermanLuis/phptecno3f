<?php
//  ************************
//  *  CREAR_PRODUCTO.PHP  *
//  ************************
// Alta de un producto

// Conexión a la base de datos
require 'conexion.php';

// Variable para mostrar mensajes de error o éxito al usuario
$mensaje = ''; 

// Inicializamos las variables para mantener valores en el formulario si hay errores
$codigo     = '' ;
$nombre     = '' ;
$categoria  = '' ;
$unidad     = '' ;
$cantidad   = '' ;


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtenemos y quitamos posibles espacios en blanco en los datos del formulario
    $codigo    = trim($_POST['codigo']);
    $nombre    = trim($_POST['nombre']);
    $categoria = trim($_POST['categoria']);
    $unidad    = trim($_POST['unidad']);
    $cantidad  = trim($_POST['cantidad']);
    $imagen    = '';

    // Validar campos obligatorios
    if (empty($codigo) || empty($nombre) || empty($categoria) || empty($unidad) || empty($cantidad)) {
        $mensaje = '<div class="alert alert-danger">Por favor, complete todos los campos obligatorios.</div>';
    } else {
        // Verificar si el código del producto que se esta creando ya existe 
        // ( evitar duplicados )
        $stmt = $mysqli->prepare("SELECT id FROM productos WHERE codigo = ?");
        $stmt->bind_param("s", $codigo);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $mensaje = '<div class="alert alert-warning">El producto con ese código ya existe.</div>';
        } else {
            // Si se envió una imagen, la subimos a la carpeta 'uploads'
            if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
                $img_name = uniqid() . '_' . basename($_FILES['imagen']['name']);
                $img_path = 'uploads/' . $img_name;
                move_uploaded_file($_FILES['imagen']['tmp_name'], $img_path);
                $imagen = $img_name;
            }

            // Insertar los datos en la base de datos
            $stmt_insert = $mysqli->prepare("INSERT INTO productos (codigo, nombre, categoria, unidad_medida, cantidad, imagen) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt_insert->bind_param("ssssis", $codigo, $nombre, $categoria, $unidad, $cantidad, $imagen);
            if ($stmt_insert->execute()) {
                // header("Location: ver_productos.php?exito=1");
                header("Location: ver_productos.php");
                exit;
            } else {
                $mensaje = '<div class="alert alert-danger">Error al guardar el producto. Intente nuevamente.</div>';
            }
            $stmt_insert->close();
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html>
<head><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"></head>
<body class="container mt-5">
<h1>TECNO 3F - PHP Y MYSQL - TP FINAL - CRUD</h1>
<h2>Agregar Producto</h2>

<!-- Mostramos mensaje de error o éxito si corresponde -->
<?php echo $mensaje; ?>

<!-- Formulario para agregar producto -->
<form method="POST" enctype="multipart/form-data">
  <!-- Campo Código Producto-->
  <div 
     class="mb-3"><input class="form-control" name="codigo" placeholder="Código" requiered>
  </div>
<!-- Campo Nombre del Producto-->
  <div 
     class="mb-3"><input class="form-control" name="nombre" placeholder="Nombre"  value="<?php echo $nombre; ?>" >
  </div>
  
  <!-- Campo Categoria del Producto-->
  <div 
     class="mb-3"><input class="form-control" name="categoria" placeholder="Categoría"  value="<?php echo $categoria; ?>">
  </div>
  
  <!-- Campo Unidad ( unidad de medida ) del Producto-->
  <div 
     class="mb-3"><input class="form-control" name="unidad" placeholder="Unidad de medida" value="<?php echo $unidad; ?>">
  </div>
  
  <!-- Campo Cantidad del Producto-->
  <div 
     class="mb-3"><input type="number" class="form-control" name="cantidad" placeholder="Cantidad" value="<?php echo $cantidad; ?>">
  </div>

  <!-- Campo imagen del Producto  (opcional )-->
 <div 
    class="mb-3"><input type="file" class="form-control" name="imagen">
 </div>
  <button class="btn btn-success">Guardar</button>
  <a href="ver_productos.php" class="btn btn-secondary">Cancelar</a>
</form>
</body>
</html>