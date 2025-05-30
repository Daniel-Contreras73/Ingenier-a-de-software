<h1>Pedidos</h1>
 
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