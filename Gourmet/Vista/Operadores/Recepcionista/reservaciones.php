<link rel="stylesheet" href="/IGourmet/Gourmet/CSS/Recepcionista/reservaciones.css">
<h3><a href="/IGourmet/Gourmet/index.html">Rgresar</a></h3>

<div class="container">
    <?php foreach ($mesas as $mesa): ?>
        <div class="container-cards">
            <div class="mesa-card">
                <h2>Mesa <?php echo $mesa['IdMesa']; ?></h2>
                <p>Capacidad: <?php echo $mesa['Capacidad']; ?></p>
                <p>Estado: <?php echo $mesa['Estado']; ?></p>
                <a href="RecepcionistaController.php?accion=reservar&idmesa=<?= $mesa['IdMesa'] ?> ">Resercvar</a>
                <a href="RecepcionistaController.php?accion=eliminarRecervacion&idmesa=<?= $mesa['IdMesa'] ?> ">Eliminar</a>
            </div>
            <div class="operador-card">
                <?php if (!empty($mesa['IdOperador'])): ?>
                    <h2>Mesero: <?= $mesa['IdOperador'] ?></h2>
                    <p>Nombre: <?= $mesa['Nombres'] . ' ' . ($mesa['Apellidos'] ?? '') ?></p>
                <?php else: ?>
                    <h2>Sin operador asignado</h2>
                <?php endif; ?>
            </div>

        </div>
    <?php endforeach; ?>
</div>