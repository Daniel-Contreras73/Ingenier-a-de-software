<h1>Reporte de Ventas</h1>

<div class="container-pedidos">
    <h2>Comandas con estado 2</h2>
    <h3><a href="/IGourmet/Gourmet/Vista/Operadores/Gerente/dashboardGerente.php">Rgresar</a></h3>
    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>Id Comanda</th>
                <th>Id Operador</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($ventas as $comanda): ?>
                <tr>
                    <td><?= $comanda['IdComanda'] ?></td>
                    <td><?= $comanda['IdOperador'] ?></td>
                    <td><?= $comanda['Estado'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>