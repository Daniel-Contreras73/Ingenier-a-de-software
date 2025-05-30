<h1>Gestionar productos</h1>
<div class="container-productos">
    <h2>Lista de Productos</h2>
    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>ID Producto</th>
                <th>Nombre</th>
                <th>Descripción</th>

            </tr>
        </thead>
        <tbody>
            <?php foreach ($productos as $producto): ?>
                <tr>
                    <td><?= $producto['IdProducto'] ?></td>
                    <td><?= $producto['Descripcion'] ?></td>
                    <td><?= $producto['Precio'] ?></td>
                    <!-- Aquí puedes agregar botones para editar o eliminar productos -->
                    <td><a href="GerenteController.php?accion=borrarProducto&id=<?=$producto['IdProducto'] ?>">Borrar</a></td>
                    </td>
                    <td> <a href="GerenteController.php?accion=actualizarProducto&id=<?=$producto['IdProducto'] ?>">Actualizar</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3">
                    <a href="GerenteController.php?accion=agregarProducto">Agregar nuevo producto</a>
                </td>
            </tr>
    </table>