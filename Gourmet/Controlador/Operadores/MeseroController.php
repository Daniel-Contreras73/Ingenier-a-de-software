<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once('../../Modelo/Operadores/meseroModelo.php');

$mensaje = '';

class MeseroController
{
    private $modelo;

    public function __construct()
    {
        $this->modelo = new MeseroModelo();
    }

    public function crearComanda()
    {
        $productos = $this->modelo->obtenerProductos();
        include('../../Vista/Operadores/Mesero/generar_comanda.php');
        exit();
    }
    public function insertarComanda()
    {
        if (isset($_POST['carrito'])) {
            $productos = json_decode($_POST['carrito'], true); // esto es un array de productos, no ['productos' => ...]
            $total = 0;
            foreach ($productos as $producto) {
                $total += $producto['precio'] * $producto['cantidad'];
            }

            $datosComanda = [
                'idOperador' => $_SESSION['idUsuario'],
                'productos' => $productos,
                'total' => $total
            ];

            $this->modelo->insertarComanda($datosComanda);
        } else {
            echo "No se recibió carrito.";
        }
        header('Location: ../../Vista/Operadores/Mesero/mesero_inicio.php');
    }
    public function administrarComandas()
    {
        $comandas = $this->modelo->obtenerComandas($_SESSION['idUsuario']);

        include('../../Vista/Operadores/Mesero/admin_mesero.php');
        exit();
    }
    // public function gestionarMesas()
    // {
    //     // Aquí podrías implementar la lógica para gestionar mesas
    //     // Por ejemplo, mostrar un formulario para asignar mesas a comandas
    //     $mesas = $this->modelo->obtenerMesas(); // ✅ punto y coma corregido
    //     include('../../Vista/Operadores/Mesero/gestionar_mesas.php');
    //     exit();
    // }
}

// Instancia del controlador
$controller = new MeseroController();

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
