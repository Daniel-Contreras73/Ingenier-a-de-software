<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Actualizar Operador</title>
    <link rel="stylesheet" href="../../CSS/Operador/actualizar.css">
</head>
<body>
    <div class="form-container">
        <h1>Actualizar Operador</h1>
        <form action="GerenteController.php?accion=procesarActualizarOperador" method="post">
            <input type="hidden" name="idOperador" value="<?= $IdOperador ?>">

            <label for="nombres">Nombres:</label>
            <input type="text" id="nombres" name="nombres" value="" required>

            <label for="apellidos">Apellidos:</label>
            <input type="text" id="apellidos" name="apellidos" value="" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="" required>

            <label for="contrasena">Contraseña:</label>
            <input type="password" id="contrasena" name="contrasena" placeholder="Dejar vacío para mantener actual">

            <label for="tipoOperador">Tipo de Operador:</label>
            <select id="tipoOperador" name="tipoOperador" required>
                <?php foreach ($tiposOperador as $tipo): ?>
                   <option value="<?= $tipo['IdTiposOperador'] ?>"><?= $tipo['Descripcion'] ?></option>
                <?php endforeach; ?>
            </select>

            <button type="submit">Actualizar Operador</button>
        </form>
    </div>
</body>
</html>
