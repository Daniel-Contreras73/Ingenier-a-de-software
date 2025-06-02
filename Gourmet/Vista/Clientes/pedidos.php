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
            <td><?= htmlspecialchars($pedido['IdComanda']) ?></td>
            <td><?= htmlspecialchars($pedido['Estado']) ?></td>
            <td>$<?= htmlspecialchars($pedido['Total']) ?></td>
            
        </tr>
    <?php endforeach; ?>