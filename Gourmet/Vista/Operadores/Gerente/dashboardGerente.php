<?php
session_start(); // <--- ESTA LÍNEA ES ESENCIAL



// Verificación de rol (solo Gerente = 1)
if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 1) {
    header('Location: ../../../Vista/AccesoDenegado.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Gerente</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background-color: #f4f4f4;
        }

        .contenedor {
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #2c3e50;
        }

        .opciones {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            margin-top: 40px;
        }

        .card {
            background-color: #fff;
            padding: 20px;
            width: 220px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            text-align: center;
            border-radius: 8px;
        }

        .card a {
            text-decoration: none;
            color: #007BFF;
            font-weight: bold;
        }

        .card a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
  <h3><a href="/IGourmet/Gourmet/index.html">Rgresar</a></h3>

<div class="contenedor">
    <h1>Panel de Control del Gerente</h1>
   <div>
        Bienvenido, <?= htmlspecialchars($_SESSION['nombre']); ?> (<?php echo htmlspecialchars($_SESSION['tipo']); ?>)
    </div>
    <div class="opciones">
        <div class="card">
            <p>Ver Operadores</p>
            <a href="../../../Controlador/Operadores/GerenteController.php?accion=catalogo">Ir al catálogo</a>
        </div>

        <div class="card">
            <p>Agregar Operador</p>
            <a href="../../../Controlador/Operadores/GerenteController.php?accion=agregarOperador">Nuevo operador</a>
        </div>

        <div class="card">
            <p> Reportes de ventas</p>
            <a href="../../../Controlador/Operadores/GerenteController.php?accion=reporteVentas">Ver reportes</a>
        </div>

        <div class="card">
            <p> Gestión de productos</p>
            <a href="../../../Controlador/Operadores/GerenteController.php?accion=gestionarProductos">Gestionar productos</a>
        </div>
    </div>
</div>

</body>
</html>
