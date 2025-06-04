<h1>Administrador de comandas</h1>

<table border="1" cellpadding="10">
    <thead>
        <tr>
            <th>Comanda pendiente</th>
            <th>Comanda terminada</th>
            <th>Comanda pagada</th>
            <th>Mesa</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($comandas as $comanda): ?>
            <tr>
                <td>
                    <?php if ($comanda['Estado'] == 0): ?>
                        <p><?= $comanda['IdComanda']; ?></p>
                    <?php endif; ?>
                </td>
                <td>
                    <?php if ($comanda['Estado'] == 1): ?>
                        <p><?= $comanda['IdComanda']; ?></p>
                    <?php endif; ?>
                </td>
                <td>
                    <?php if ($comanda['Estado'] == 2): ?>
                        <p><?= $comanda['IdComanda']; ?></p>
                    <?php endif; ?>
                </td>
                <td>
                    <?= $comanda['IdMesa'] ?? 'No asignada'; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
