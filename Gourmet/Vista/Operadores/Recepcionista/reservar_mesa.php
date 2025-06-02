<h1>reservar_mesa</h1>
  <h3><a href="/IGourmet/Gourmet/Controlador/Operadores/RecepcionistaController.php?accion=reservaciones">Rgresar</a></h3>
<?= $idMesa ?? '' ?>
<form action="RecepcionistaController.php?accion=insertarReservacion" method="post">
    <input type="hidden" name="idmesa" value="<?= $idMesa ?>">
    <select name="IdUsuario" id="">
        <option value="">Seleccione un cliente</option>
        <?php foreach ($clientes as $cliente): ?>
            <option value="<?= $cliente['IdClientes'] ?>"><?= $cliente['Nombres'] . ' ' . $cliente['Apellidos'] ?></option>
        <?php endforeach; ?>
    </select>
    <select name="IdOperador" id="">
        <option value="">Seleccione un operador</option>
        <?php foreach ($operadores as $operador): ?>
            <option value="<?= $operador['IdOperador'] ?>"><?= $operador['Nombres'] . ' ' . $operador['Apellidos'] ?></option>
        <?php endforeach; ?>

        <label for="fecha">Fecha:</label>
        <input type="date" name="Fecha" id="">

        <label for="hora_inicio">Hora inicio:</label>
        <input type="time" name="Hora_Inicio" id="">

        <label for="hora_inicio">Hora fin:</label>
        <input type="time" name="Hora_Fin" id="">
        <input type="hidden" name="Estado" value="Pendiente">

        <button type="submit">Reservar</button>
</form>