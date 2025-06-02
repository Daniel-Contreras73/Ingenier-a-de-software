<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Carrito de Compras</title>
    <h3><a href="/IGourmet/Gourmet/Vista/Operadores/Mesero/mesero_inicio.php">Rgresar</a></h3>
    <style>
        .producto,
        #carrito {
            margin: 20px;
            padding: 10px;
            border: 1px solid #ccc;
        }

        .cards {
            display: flex;
        }

        .producto {
            cursor: pointer;
            background: pink;
            width: 200px;
            display: flex;
        }
    </style>
</head>

<body>

    <h1>Crear Comanda</h1>
    <div class="container">

        <h2>Productos</h2>
        <div class="cards">
            <?php foreach ($productos as $producto): ?>
                <div class="producto"
                    data-id="<?= $producto['IdProducto'] ?>"
                    data-nombre="<?= $producto['Descripcion'] ?>"
                    data-precio="<?= $producto['Precio'] ?>">
                    <?= $producto['Descripcion'] ?> - $<?= $producto['Precio'] ?>
                </div>
            <?php endforeach; ?>
        </div>
        <h2>Carrito</h2>
        <div id="carrito"></div>

        <form id="formComanda" action="MeseroController.php?accion=insertarComanda" method="post">
            <input type="hidden" name="carrito" id="carritoInput">
            <button id="enviarComanda" type="button">Enviar Comanda</button>
        </form>
    </div>

    <script src="/IGourmet/Gourmet/js/comanda.js"></script>
</body>

</html>