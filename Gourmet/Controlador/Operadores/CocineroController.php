<?php
session_start();
require_once('../../Modelo/Operadores/cocinerModelo.php');

$mensaje = '';

class CocineroController
{
    private $modelo;

    public function __construct()
    {
        $this->modelo = new cocinerModelo();
    }

    public function index()
    {
        $comandas = $this->modelo->comandas();
        include('../../Vista/Operadores/Chef/inicio_chef.php');
        exit();
    }
    public function completar()
    {
        $this->modelo->completarComanda($_GET['idComanda']);
        $this->index();
        exit();
    }
    
}

// Instancia del controlador
$controller = new CocineroController();

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
