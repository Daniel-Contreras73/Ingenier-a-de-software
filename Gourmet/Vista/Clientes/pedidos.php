<h1>Pedidos</h1>

<h3><a href="/IGourmet/Gourmet/Vista/Clientes/dashboardCliente.php">Regresar</a></h3>
<table border="1">
    <tr>
        <th>ID Pedido</th>
        <th>Estado</th>
        <th>Total</th>
    </tr>
    <?php foreach ($comandas as $pedido): ?>
        <tr>
            <td><?= $pedido['IdComanda'] ?></td>
            <<td><?= $pedido['IdComanda'] ?></td>
                <td >
                    <?php if ($pedido['Estado'] == 0): ?>
                        <span> Espera</span>
                    <?php elseif ($pedido['Estado'] == 1): ?>
                        <span> Listo</span>
                    <?php elseif ($pedido['Estado'] == 2): ?>
                        <span> Pagado</span>
                    <?php else: ?>
                        <span> Estado desconocido</span>
                    <?php endif; ?>
                </td>

                <td>$<?= htmlspecialchars($pedido['Total']) ?></td>

        </tr>
    <?php endforeach; ?>