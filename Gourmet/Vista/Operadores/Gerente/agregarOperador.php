
<link rel="stylesheet" href="../../CSS/Operador/agregar.css" />
<div class="form-page">
    <h1>Agregar Operador</h1>

    <form action="GerenteController.php?accion=insertarOperador" method="post">
        <label for="nombres">Nombres:</label>
        <input type="text" id="nombres" name="nombres" required>

        <label for="apellidos">Apellidos:</label>
        <input type="text" id="apellidos" name="apellidos" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="contrasena">Contraseña:</label>
        <input type="password" id="contrasena" name="contrasena" required>

        <label for="tipoOperador">Tipo de Operador:</label>
        <select id="tipoOperador" name="tipoOperador">
            <?php foreach ($tiposOperador as $tipo): ?>
                <option value="<?= htmlspecialchars($tipo['IdTiposOperador']) ?>"><?= htmlspecialchars($tipo['Descripcion']) ?></option>
            <?php endforeach; ?>
        </select>

        <button type="submit">Agregar Operador</button>
    </form>
</div>
