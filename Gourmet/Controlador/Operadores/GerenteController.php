<?php
session_start();
require_once('../../Modelo/Operadores/gerenteModelo.php');

$mensaje = '';

class GerenteController
{
    private $modelo;

    public function __construct()
    {
        $this->modelo = new GerenteModelo();
    }

    public function catalogo()
    {
        $operadores = $this->modelo->obtenerTodosLosOperadores();
        include('../../Vista/Operadores/Gerente/catalogoOperador.php');
        exit();
    }

    public function agregarOperador()
    {

        $tiposOperador = $this->modelo->obtenerTiposOperador();
        include('../../Vista/Operadores/Gerente/agregarOperador.php');
        exit();
    }

    public function insertarOperador()
    {
        $datosOperador = [
            'nombres' => $_POST['nombres'],
            'apellidos' => $_POST['apellidos'],
            'email' => $_POST['email'],
            'contrasena' => $_POST['contrasena'],
            'idTiposOperador' => $_POST['tipoOperador']
        ];

        $this->modelo->insertar($datosOperador);

        header('Location: ../../Vista/Operadores/Gerente/dashboardGerente.php');
        exit();
    }

    public function actualizarOperador()
    {
        // Aquí deberías implementar la lógica para actualizar un operador
        // Por ejemplo, recibir el ID del operador a actualizar y mostrar un formulario para editarlo
        $IdOperador = $_GET['id'];
        $tiposOperador = $this->modelo->obtenerTiposOperador();
        include('../../Vista/Operadores/Gerente/actualizarOperador.php');
        echo  $IdOperador;
        echo "Función de actualizar operador no implementada.";
    }
    public function procesarActualizarOperador()
    {
        // Aquí deberías implementar la lógica para procesar la actualización del operador
        // Por ejemplo, recibir los datos del formulario y llamar al modelo correspondiente
        $idOperador = $_POST['idOperador'];
        $nombres = $_POST['nombres'];
        $apellidos = $_POST['apellidos'];
        $email = $_POST['email'];
        $contrasena = $_POST['contrasena'];
        $tipoOperador = $_POST['tipoOperador'];

        $this->modelo->actualizarOperador($idOperador, $nombres, $apellidos, $email, $contrasena, $tipoOperador);

        $this->catalogo();
        exit();
    }
    public function borrarOperador()
    {
        // Aquí deberías implementar la lógica para borrar un operador
        // Por ejemplo, recibir el ID del operador a borrar y llamar al modelo correspondiente
        $this->modelo->borrarOperador($_GET['id']);
        $this->catalogo();
        $this->catalogo();
        exit();
        echo "Función de borrar operador no implementada.";
    }
    public function reporteVentas()
    {
        $ventas = $this->modelo->obtenerVentas();
        include('../../Vista/Operadores/Gerente/reporteVentas.php');
        exit();
    }
    public function gestionarProductos()
    {
        $productos = $this->modelo->obtenerProductos();
        include('../../Vista/Operadores/Gerente/productos.php');
    }
    public function borrarProducto()
    {
        // Aquí deberías implementar la lógica para borrar un producto
        // Por ejemplo, recibir el ID del producto a borrar y llamar al modelo correspondiente
        // $this->modelo->borrarProducto($idProducto);
        $this->modelo->borrarProducto($_GET['id']);
        $this->gestionarProductos();
        echo "Función de borrar producto no implementada.";
    }
    public function actualizarProducto()
    {
        // Aquí deberías implementar la lógica para actualizar un producto
        // Por ejemplo, recibir el ID del producto a actualizar y mostrar un formulario para editarlo
        $producto = $this->modelo->obtenerProductoPorId($_GET['id']);
        include('../../Vista/Operadores/Gerente/actualizar_producto.php');
        echo "Función de actualizar producto no implementada.";
    }
    public function procesarActualizarProducto()
    {
        // Aquí deberías implementar la lógica para procesar la actualización del producto
        // Por ejemplo, recibir los datos del formulario y llamar al modelo correspondiente
        $datosProducto = [
            'idProducto' => $_GET['id'],
            'nombre' => $_POST['nombre'],
            'descripcion' => $_POST['descripcion'],
            'precio' => $_POST['precio']
        ];

        // Manejo de la imagen
        if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === 0) {
            $nombreImagen = $_FILES['imagen']['name'];
            $rutaRelativa = 'img/productos/' . $nombreImagen;
            $rutaAbsoluta = __DIR__ . '/../../' . $rutaRelativa;

            if (!file_exists(dirname($rutaAbsoluta))) {
                mkdir(dirname($rutaAbsoluta), 0777, true);
            }

            move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaAbsoluta);
            $datosProducto['imagen'] = $rutaRelativa;
        } else {
            // Si no se sube nueva imagen, puedes mantener la anterior (opcional)
            $productoActual = $this->modelo->obtenerProductoPorId($_GET['id']);
            $datosProducto['imagen'] = $productoActual['Imagen'];
        }


        $this->modelo->actualizarProducto($datosProducto);

        $this->gestionarProductos();
        exit();
    }
    public function agregarProducto()
    {
        // Aquí deberías implementar la lógica para agregar un nuevo producto
        // Por ejemplo, mostrar un formulario para ingresar los datos del nuevo producto
        include('../../Vista/Operadores/Gerente/agregar_producto.php');
        echo "Función de agregar producto no implementada.";
    }
    public function procesarAgregarProducto()
    {
        // ✅ Obtener los datos del formulario
        $descripcion = $_POST['descripcion'];
        $precio = $_POST['precio'];

        // ✅ Manejo de la imagen
        if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === 0) {
            $nombreImagen = $_FILES['imagen']['name'];
            $rutaRelativa = 'img/productos/' . $nombreImagen;
            $rutaAbsoluta = __DIR__ . '/../../' . $rutaRelativa;

            if (!file_exists(dirname($rutaAbsoluta))) {
                mkdir(dirname($rutaAbsoluta), 0777, true);
            }

            move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaAbsoluta);
        } else {
            $rutaRelativa = null; // o 'img/productos/default.jpg' si quieres imagen por defecto
        }

        // ✅ Guardar en la base de datos
        $this->modelo->insertarProducto($descripcion, $precio, $rutaRelativa);

        // ✅ Redirigir a la vista
        $this->gestionarProductos();
        exit();
    }
}

// Instancia del controlador
$controller = new GerenteController();

if (isset($_GET['accion'])) {
    $accion = $_GET['accion'];

    if (method_exists($controller, $accion)) {
        $controller->$accion();
    } else {
        echo "Función no encontrada.";
    }
} else {
    echo "Ninguna acción especificada.";
}
