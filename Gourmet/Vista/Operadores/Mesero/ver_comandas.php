<h1>Administrador de comandas</h1>

<?php
$comandasAgrupadas = [];

foreach ($comandas as $fila) {
    $id = $fila['IdComanda'];

    if (!isset($comandasAgrupadas[$id])) {
        $comandasAgrupadas[$id] = [
            'NombreOperador' => $fila['NombreOperador'],
            'Estado' => $fila['Estado'] ?? 0,
            'Total' => $fila['Total'],
            'productos' => []
        ];
    }

    $comandasAgrupadas[$id]['productos'][] = [
        'Nombre' => $fila['Nombre'],
        'Descripcion' => $fila['Descripcion'],
        'Precio' => $fila['Precio'],
        'Cantidad' => $fila['Cantidad'],
        'Subtotal' => $fila['Subtotal']
    ];
}
?>

<?php foreach ($comandasAgrupadas as $idComanda => $comanda): ?>
    <h3>Comanda #<?= $idComanda ?> | Operador: <?= $comanda['NombreOperador'] ?> | 
        Estado: 
        <?php 
            if ($comanda['Estado'] == 0) echo 'Pendiente';
            elseif ($comanda['Estado'] == 1) echo 'Lista';
            elseif ($comanda['Estado'] == 2) echo 'Pagada';
            else echo 'Desconocido';
        ?>
    </h3>

    <table border="1" cellpadding="5">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($comanda['productos'] as $producto): ?>
                <tr>
                    <td><?= $producto['Nombre'] ?></td>
                    <td>$<?= number_format($producto['Precio'], 2) ?></td>
                    <td><?= $producto['Cantidad'] ?></td>
                    <td>$<?= number_format($producto['Subtotal'], 2) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3" style="text-align:right;">Total:</th>
                <th>$<?= number_format($comanda['Total'], 2) ?></th>
            </tr>
            <!-- <?php if ($comanda['Estado'] == 0): ?>
            <tr>
                <td colspan="4" style="text-align:right;">
                    <a href="CocineroController.php?accion=completar&idComanda=<?= $idComanda ?>">Finalizado</a>
                </td>
            </tr>
            <?php endif; ?> -->
        </tfoot>
    </table>
    <br><hr><br>
<?php endforeach; ?>
