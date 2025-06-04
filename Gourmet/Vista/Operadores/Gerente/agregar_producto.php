<h1>Agregar Producto</h1>
<h3><a href="/IGourmet/Gourmet/Vista/Operadores/Gerente/dashboardGerente.php">Rgresar</a></h3>
<form action="GerenteController.php?accion=procesarAgregarProducto" method="post" enctype="multipart/form-data">

      <label>Descripción:</label>
    <input type="text" name="descripcion" required><br>

    <label>Precio:</label>
    <input type="number" name="precio" step="0.01" required><br>

    <label>Imagen:</label>
    <input type="file" name="imagen" accept="image/*" required><br>

    <button type="submit">Agregar Producto</button>