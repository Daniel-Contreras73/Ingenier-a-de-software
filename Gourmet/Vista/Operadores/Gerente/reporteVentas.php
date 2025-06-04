<h1>Reporte de Ventas</h1>

<div class="container-pedidos">
    <h2>Pedidos pagados</h2>
    <h3><a href="/IGourmet/Gourmet/Vista/Operadores/Gerente/dashboardGerente.php">Rgresar</a></h3>
    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>Número de pedido</th>
                <th>Nombre Mesero</th>
                <th>Estado</th>
                <th>Total</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($ventas as $comanda): ?>
                <tr>
                    <td><?= $comanda['IdComanda'] ?></td>
                    <td> <?= $comanda['Nombres'] ?> </td>
                    <td>Pagado</td>
                    <td><?= $comanda['Total'] ?></td>
                    <td><?= $comanda['Fecha'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>