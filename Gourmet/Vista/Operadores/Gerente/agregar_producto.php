<h1>Agregar Producto</h1>
<form action="GerenteController.php?accion=procesarAgregarProducto" method="post">
    <label for="descripcion">Nombre del producto:</label>
    <input type="text" id="descripcion" name="descripcion" required>

    <label for="precio">Precio:</label>
    <input type="number" id="precio" name="precio" required>

    <button type="submit">Agregar Producto</button>