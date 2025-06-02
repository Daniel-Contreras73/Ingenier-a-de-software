<link rel="stylesheet" href="../../CSS/Operador/catalagoOperador.css" />
<!-- catalogoOperador.php -->
<h2>Catálogo de Operadores</h2>
  <h3><a href="/IGourmet/Gourmet/Vista/Operadores/Gerente/dashboardGerente.php">Rgresar</a></h3>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Correo</th>
        <!-- Agrega más columnas según tu tabla -->
    </tr>
    <?php foreach ($operadores as $op): ?>
        <tr>
            <td><?= htmlspecialchars($op['IdOperador']) ?></td>
            <td><?= htmlspecialchars($op['Nombres']) ?></td>
            <td><?= htmlspecialchars($op['Email']) ?></td>
            <td><a href="GerenteController.php?accion=actualizarOperador&id=<?= $op['IdOperador'] ?>">Actualizar</a></td>
            <td><a href="GerenteController.php?accion=borrarOperador&id=<?= $op['IdOperador'] ?>">Borrar</a>            </td>
        </tr>
        
    <?php endforeach; ?>
    <a href="GerenteController.php?accion=agregarOperador">Agregar Operador</a>
</table>
