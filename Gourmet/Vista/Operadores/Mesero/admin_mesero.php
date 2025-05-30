<h1>Administrador de comandas</h1>

<table border="1">
    <tr>
        <th>Comandas pendientes</th>
        <th>Comandas terminadas</th>
        <th>Gestor de mesas</th>
    </tr>
    <?php foreach($comandas as $comanda): ?>
        <tr>
            <td>
                <?php if ($comanda['Estado'] === '0'): ?>
                    <p><?= $comanda['IdComanda']; ?></p>
                <?php endif; ?>
            </td>
            <td>
                <?php if ($comanda['Estado'] === '1'): ?>
                    <?php echo $comanda['IdComanda']; ?>
                <?php endif; ?>
            </td>
            <td>
                <?= $comanda['IdMesa']; ?> <!-- Aquí puedes agregar el botón o link del gestor de mesas -->
            </td> <!-- Aquí puedes agregar el botón o link del gestor de mesas -->
        </tr>
    <?php endforeach; ?>
</table>
