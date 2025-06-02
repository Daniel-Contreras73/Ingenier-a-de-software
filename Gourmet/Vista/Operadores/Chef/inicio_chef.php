<h1>Inicio mesas</h1>
<h3><a href="/IGourmet/Gourmet/index.html">Rgresar</a></h3>
<?php
// Agrupar comandas por IdComanda
$comandasAgrupadas = [];

foreach ($comandas as $item) {
    $id = $item['IdComanda'];
    if (!isset($comandasAgrupadas[$id])) {
        $comandasAgrupadas[$id] = [
            'IdComanda' => $id,
            'NombreOperador' => $item['NombreOperador'],
            'productos' => []
        ];
    }
    $comandasAgrupadas[$id]['productos'][] = [
        'Descripcion' => $item['Descripcion'],
        'Precio' => $item['Precio'],
        'Cantidad' => $item['Cantidad'],
        'Subtotal' => $item['Subtotal']
    ];
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <title>Comandas - Chef</title>
    <link rel="stylesheet" href="/IGourmet/Gourmet/CSS/Chef/inicio_chef.css" />

</head>

<body>
    <h1>Comandas con Estado 0</h1>

    <?php foreach ($comandasAgrupadas as $comanda): ?>
        <h2>Comanda #<?= htmlspecialchars($comanda['IdComanda']) ?> - Operador: <?= htmlspecialchars($comanda['NombreOperador']) ?></h2>
        <table>
            <thead>
                <tr>
                    <th>Platillo</th>
                    <th>Precio Unitario</th>
                    <th>Cantidad</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $totalComanda = 0;
                foreach ($comanda['productos'] as $prod):
                    $totalComanda += $prod['Subtotal'];
                ?>
                    <tr>
                        <td><?= htmlspecialchars($prod['Descripcion']) ?></td>
                        <td><?= number_format($prod['Precio'], 2) ?></td>
                        <td><?= $prod['Cantidad'] ?></td>
                        <td><?= number_format($prod['Subtotal'], 2) ?></td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="3" style="text-align:right;"><strong>Total Comanda:</strong></td>
                    <td><strong><?= number_format($totalComanda, 2) ?></strong></td>
                </tr>
            </tbody>
            <a href="CocineroController.php?accion=completar&idComanda=<?= $comanda['IdComanda'] ?>">
                Completar pedido
            </a>
        </table>
    <?php endforeach; ?>

</body>

</html>