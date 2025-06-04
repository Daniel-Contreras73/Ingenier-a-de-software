<h1>Actualizar producto</h1>
<h3><a href="/IGourmet/Gourmet/Vista/Operadores/Gerente/dashboardGerente.php">Rgresar</a></h3>
<form action="GerenteController.php?accion=procesarActualizarProducto&id=<?= $_GET['id'] ?>" method="post" enctype="multipart/form-data">
    <label for="nombre">Nombre del producto:</label>
    <input type="text" id="descripcion" name="nombre" value="<?= $producto['Nombre'] ?>" required>
    <label for="descripcion">Descripción:</label>
    <input type="text" id="descripcion" name="descripcion" value="<?= $producto['Descripcion'] ?>" required>

    <label for="precio">Precio:</label>
    <input type="number" id="precio" name="precio" value="<?= $producto['Precio'] ?>" required>
    <label for="imagen">Imagen:</label>

    <input type="file" name="imagen" accept="image/*"><br>

    <button type="submit">Actualizar Producto</button>
</form>