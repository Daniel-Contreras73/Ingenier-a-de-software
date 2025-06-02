<style>
    .container {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
    }
</style>
<h1>Inicio cajero</h1>
<h3><a href="/IGourmet/Gourmet/index.html">Rgresar</a></h3>
<div class="container">
    <?php foreach ($comandas as $comanda): ?>

        <div class="card-comanda">
            <p>Comanda <?= $comanda['IdComanda'] ?> </p>
            <p>Operador <?= $comanda['IdOperador'] ?> <?= $comanda['Nombre'] ?> </p>
            <p>Costo: <?= $comanda['Total'] ?></p>
            <p>Metodo de pago:</p>
            <a href="CajeroController.php?accion=pagoEfectivo&id=<?= $comanda['IdComanda'] ?>">Efectivo</a>
            <a href="CajeroController.php?accion=pagoTarjeta&id=<?= $comanda['IdComanda'] ?>&monto=<?= $comanda['Total'] ?>">Tarjeta</a>

        </div>
    <?php endforeach; ?>
</div>