<h1>Actualizar producto</h1>
<form action="GerenteController.php?accion=procesarActualizarProducto&id=<?= $_GET['id'] ?>" method="post">
    <label for="descripcion">Nombre del producto:</label>
    <input type="text" id="descripcion" name="descripcion" value="<?= htmlspecialchars($producto['Descripcion']) ?>" required>

    <label for="precio">Precio:</label>
    <input type="number" id="precio" name="precio" value="<?= htmlspecialchars($producto['Precio']) ?>" required>

    <button type="submit">Actualizar Producto</button>
</form>
