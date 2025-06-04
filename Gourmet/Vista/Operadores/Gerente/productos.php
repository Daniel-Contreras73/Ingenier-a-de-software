<h1>Gestionar productos</h1>
<div class="container-productos">
    <h2>Lista de Productos</h2>
    <h3><a href="/IGourmet/Gourmet/Vista/Operadores/Gerente/dashboardGerente.php">Rgresar</a></h3>
    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>ID Producto</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Imagen</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($productos as $producto): ?>
                <tr>
                    <td><?= $producto['IdProducto'] ?></td>
                    <td><?= $producto['Nombre'] ?></td>
                    <td><?= $producto['Descripcion'] ?></td>
                    <td><?= $producto['Precio'] ?></td>
                    <td><img src="/IGourmet/Gourmet/<?=$producto['Imagen'] ?>" alt="" height="30px" width="50px" ></td>
                    <!-- Aquí puedes agregar botones para editar o eliminar productos -->
                    <td><a href="GerenteController.php?accion=borrarProducto&id=<?= $producto['IdProducto'] ?>">Borrar</a></td>
                    </td>
                    <td> <a href="GerenteController.php?accion=actualizarProducto&id=<?= $producto['IdProducto'] ?>">Actualizar</a></td>
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