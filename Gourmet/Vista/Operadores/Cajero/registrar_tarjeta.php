<h1>Registrar Tarjeta</h1>
  <h3><a href="/IGourmet/Gourmet/Controlador/Operadores/CajeroController.php?accion=caja">Rgresar</a></h3>
<form action="CajeroController.php?accion=registrarPago&id=<?= $idComanda ?>" method="post">
    <input type="hidden" name="id_comanda" value="<?php echo isset($_GET['id']) ? htmlspecialchars($_GET['id']) : ''; ?>">
    <label>Nombre en la tarjeta:</label>
    <input type="text" name="nombre" maxlength="50" required><br>

    <label>Número de tarjeta:</label>
    <input type="text" name="numero_tarjeta" maxlength="16" required><br>

    <label>Fecha de expiración (MM/AA):</label>
    <input type="text" name="expiracion" maxlength="5" required><br>

    <label>CVV:</label>
    <input type="text" name="cvv" maxlength="4" required><br>

<input type="number" name="monto" step="0.01" value="<?= htmlspecialchars($monto) ?>" readonly><br><br>



    <input type="submit" value="Pagar">
</form>