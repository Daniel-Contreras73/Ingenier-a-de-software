<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mesero Incio</title>
      <h3><a href="/IGourmet/Gourmet/index.html">Rgresar</a></h3>
</head>

<body>
    <div class="container">
        <div class="card">
            <h1>Crear comanda</h1>
            <a href="../../../Controlador/Operadores/MeseroController.php?accion=crearComanda">Click</a>

        </div>
        <div class="card">
            <h1>Administrar Comanda</h1>
            <a href="../../../Controlador/Operadores/MeseroController.php?accion=administrarComandas">Click</a>

        </div>
    <!-- </div>
        <div class="card">
            <h1>Administrar Mesas</h1>
            <a href="../../../Controlador/Operadores/MeseroController.php?accion=gestionarMesas">Click</a>

        </div> -->
    </div>
</body>

</html>