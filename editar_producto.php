<?php

//  *************************
//  *  EDITAR_PRODUCTO.PHP  *
//  *************************
// Edicion del producto a actualizar

// Conexión a la base de datos
require 'conexion.php';

$id = $_REQUEST['id'];

// Obtener los datos del producto para editar
$stmt = $mysqli->prepare("SELECT * FROM productos WHERE id = ?");
$stmt->bind_param("i", $id); // "i" indica que el parámetro es un entero
$stmt->execute();
$result = $stmt->get_result();
$p = $result->fetch_assoc();
$stmt->close();


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los valores del formulario
    $codigo    = $_POST['codigo'];
    $nombre    = $_POST['nombre'];
    $categoria = $_POST['categoria'];
    $unidad    = $_POST['unidad'];
    $cantidad  = $_POST['cantidad'];
    $imagen    = $p['imagen']; // Mantener la imagen existente por defecto

    // Si se subió una nueva imagen se genera el nuevo nombre
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
        $img_name = uniqid() . '_' . $_FILES['imagen']['name'];
        move_uploaded_file($_FILES['imagen']['tmp_name'], 'uploads/' . $img_name);
        $imagen = $img_name;
    }

    // Preparar la sentencia de actualización
    $stmt = $mysqli->prepare("UPDATE productos SET codigo=?, nombre=?, categoria=?, unidad_medida=?, cantidad=?, imagen=? WHERE id=?");
    // Vincular parámetros: "sssssii" -> 5 strings, 2 integers
    $stmt->bind_param("ssssisi", $codigo, $nombre, $categoria, $unidad, $cantidad, $imagen, $id);
    // Ejecutar la sentencia
    $stmt->execute();
    // Cerrar la sentencia
    $stmt->close();

    // Redireccionar al listado de productos
    header("Location: ver_productos.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
  <!-- Bootstrap para estilos -->
  <head><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"></head>
  <body class="container mt-5">
  <h1>TECNO 3F - PHP Y MYSQL - TP FINAL - CRUD</h1>
  <h2>Editar Producto</h2>

  <!-- Formulario para editar el producto -->
  <form method="POST" enctype="multipart/form-data">
    <!-- Campos con los valores para actualizar -->
    <div class="mb-3"><input class="form-control" name="codigo" value="<?= $p['codigo'] ?>" required></div>
    <div class="mb-3"><input class="form-control" name="nombre" value="<?= $p['nombre'] ?>" required></div>
    <div class="mb-3"><input class="form-control" name="categoria" value="<?= $p['categoria'] ?>" required></div>
    <div class="mb-3"><input class="form-control" name="unidad" value="<?= $p['unidad_medida'] ?>" required></div>
    <div class="mb-3"><input class="form-control" type="number" name="cantidad" value="<?= $p['cantidad'] ?>" required></div>
    <!-- Imagen actual (si hay), y opción de subir nueva -->
    <div class="mb-3">
    <input class="form-control" type="file" name="imagen">
    <?php if ($p['imagen']): ?><img src="uploads/<?= $p['imagen'] ?>" width="60"><?php endif; ?>
    </div>
     <!-- Boton para enviar la actualizacion -->
    <button class="btn btn-primary">Actualizar</button>
     <!-- Boton para cancelar actualizacion y vuelve a lista de productos -->
    <a href="ver_productos.php" class="btn btn-secondary">Cancelar</a>
</form>
</body>
</html>